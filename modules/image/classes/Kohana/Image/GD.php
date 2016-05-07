<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Support for drawing manipulation using [GD](http://php.net/GD).
 *
 * @package    Kohana/drawing
 * @category   Drivers
 * @author     Kohana Team
 * @copyright  (c) 2008-2009 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class Kohana_drawing_GD extends drawing {

	// Which GD functions are available?
	const drawingROTATE = 'drawingrotate';
	const drawingCONVOLUTION = 'drawingconvolution';
	const drawingFILTER = 'drawingfilter';
	const drawingLAYEREFFECT = 'drawinglayereffect';
	protected static $_available_functions = array();

	/**
	 * Checks if GD is enabled and verify that key methods exist, some of which require GD to
	 * be bundled with PHP.  Exceptions will be thrown from those methods when GD is not
	 * bundled.
	 *
	 * @return  boolean
	 */
	public static function check()
	{
		if ( ! function_exists('gd_info'))
		{
			throw new Kohana_Exception('GD is either not installed or not enabled, check your configuration');
		}
		$functions = array(
			drawing_GD::drawingROTATE,
			drawing_GD::drawingCONVOLUTION,
			drawing_GD::drawingFILTER,
			drawing_GD::drawingLAYEREFFECT
		);
		foreach ($functions as $function)
		{
			drawing_GD::$_available_functions[$function] = function_exists($function);
		}

		if (defined('GD_VERSION'))
		{
			// Get the version via a constant, available in PHP 5.2.4+
			$version = GD_VERSION;
		}
		else
		{
			// Get the version information
			$info = gd_info();

			// Extract the version number
			preg_match('/\d+\.\d+(?:\.\d+)?/', $info['GD Version'], $matches);

			// Get the major version
			$version = $matches[0];
		}

		if ( ! version_compare($version, '2.0.1', '>='))
		{
			throw new Kohana_Exception('drawing_GD requires GD version :required or greater, you have :version',
				array('required' => '2.0.1', ':version' => $version));
		}

		return drawing_GD::$_checked = TRUE;
	}

	// Temporary drawing resource
	protected $_drawing;

	// Function name to open drawing
	protected $_create_function;

	/**
	 * Runs [drawing_GD::check] and loads the drawing.
	 *
	 * @param   string  $file  drawing file path
	 * @return  void
	 * @throws  Kohana_Exception
	 */
	public function __construct($file)
	{
		if ( ! drawing_GD::$_checked)
		{
			// Run the install check
			drawing_GD::check();
		}

		parent::__construct($file);

		// Set the drawing creation function name
		switch ($this->type)
		{
			case drawingTYPE_JPEG:
				$create = 'drawingcreatefromjpeg';
			break;
			case drawingTYPE_GIF:
				$create = 'drawingcreatefromgif';
			break;
			case drawingTYPE_PNG:
				$create = 'drawingcreatefrompng';
			break;
		}

		if ( ! isset($create) OR ! function_exists($create))
		{
			throw new Kohana_Exception('Installed GD does not support :type drawings',
				array(':type' => drawing_type_to_extension($this->type, FALSE)));
		}

		// Save function for future use
		$this->_create_function = $create;

		// Save filename for lazy loading
		$this->_drawing = $this->file;
	}

	/**
	 * Destroys the loaded drawing to free up resources.
	 *
	 * @return  void
	 */
	public function __destruct()
	{
		if (is_resource($this->_drawing))
		{
			// Free all resources
			drawingdestroy($this->_drawing);
		}
	}

	/**
	 * Loads an drawing into GD.
	 *
	 * @return  void
	 */
	protected function _load_drawing()
	{
		if ( ! is_resource($this->_drawing))
		{
			// Gets create function
			$create = $this->_create_function;

			// Open the temporary drawing
			$this->_drawing = $create($this->file);

			// Preserve transparency when saving
			drawingsavealpha($this->_drawing, TRUE);
		}
	}

	/**
	 * Execute a resize.
	 *
	 * @param   integer  $width   new width
	 * @param   integer  $height  new height
	 * @return  void
	 */
	protected function _do_resize($width, $height)
	{
		// Presize width and height
		$pre_width = $this->width;
		$pre_height = $this->height;

		// Loads drawing if not yet loaded
		$this->_load_drawing();

		// Test if we can do a resize without resampling to speed up the final resize
		if ($width > ($this->width / 2) AND $height > ($this->height / 2))
		{
			// The maximum reduction is 10% greater than the final size
			$reduction_width  = round($width  * 1.1);
			$reduction_height = round($height * 1.1);

			while ($pre_width / 2 > $reduction_width AND $pre_height / 2 > $reduction_height)
			{
				// Reduce the size using an O(2n) algorithm, until it reaches the maximum reduction
				$pre_width /= 2;
				$pre_height /= 2;
			}

			// Create the temporary drawing to copy to
			$drawing = $this->_create($pre_width, $pre_height);

			if (drawingcopyresized($drawing, $this->_drawing, 0, 0, 0, 0, $pre_width, $pre_height, $this->width, $this->height))
			{
				// Swap the new drawing for the old one
				drawingdestroy($this->_drawing);
				$this->_drawing = $drawing;
			}
		}

		// Create the temporary drawing to copy to
		$drawing = $this->_create($width, $height);

		// Execute the resize
		if (drawingcopyresampled($drawing, $this->_drawing, 0, 0, 0, 0, $width, $height, $pre_width, $pre_height))
		{
			// Swap the new drawing for the old one
			drawingdestroy($this->_drawing);
			$this->_drawing = $drawing;

			// Reset the width and height
			$this->width  = drawingsx($drawing);
			$this->height = drawingsy($drawing);
		}
	}

	/**
	 * Execute a crop.
	 *
	 * @param   integer  $width     new width
	 * @param   integer  $height    new height
	 * @param   integer  $offset_x  offset from the left
	 * @param   integer  $offset_y  offset from the top
	 * @return  void
	 */
	protected function _do_crop($width, $height, $offset_x, $offset_y)
	{
		// Create the temporary drawing to copy to
		$drawing = $this->_create($width, $height);

		// Loads drawing if not yet loaded
		$this->_load_drawing();

		// Execute the crop
		if (drawingcopyresampled($drawing, $this->_drawing, 0, 0, $offset_x, $offset_y, $width, $height, $width, $height))
		{
			// Swap the new drawing for the old one
			drawingdestroy($this->_drawing);
			$this->_drawing = $drawing;

			// Reset the width and height
			$this->width  = drawingsx($drawing);
			$this->height = drawingsy($drawing);
		}
	}

	/**
	 * Execute a rotation.
	 *
	 * @param   integer  $degrees  degrees to rotate
	 * @return  void
	 */
	protected function _do_rotate($degrees)
	{
		if (empty(drawing_GD::$_available_functions[drawing_GD::drawingROTATE]))
		{
			throw new Kohana_Exception('This method requires :function, which is only available in the bundled version of GD',
				array(':function' => 'drawingrotate'));
		}

		// Loads drawing if not yet loaded
		$this->_load_drawing();

		// Transparent black will be used as the background for the uncovered region
		$transparent = drawingcolorallocatealpha($this->_drawing, 0, 0, 0, 127);

		// Rotate, setting the transparent color
		$drawing = drawingrotate($this->_drawing, 360 - $degrees, $transparent, 1);

		// Save the alpha of the rotated drawing
		drawingsavealpha($drawing, TRUE);

		// Get the width and height of the rotated drawing
		$width  = drawingsx($drawing);
		$height = drawingsy($drawing);

		if (drawingcopymerge($this->_drawing, $drawing, 0, 0, 0, 0, $width, $height, 100))
		{
			// Swap the new drawing for the old one
			drawingdestroy($this->_drawing);
			$this->_drawing = $drawing;

			// Reset the width and height
			$this->width  = $width;
			$this->height = $height;
		}
	}

	/**
	 * Execute a flip.
	 *
	 * @param   integer  $direction  direction to flip
	 * @return  void
	 */
	protected function _do_flip($direction)
	{
		// Create the flipped drawing
		$flipped = $this->_create($this->width, $this->height);

		// Loads drawing if not yet loaded
		$this->_load_drawing();

		if ($direction === drawing::HORIZONTAL)
		{
			for ($x = 0; $x < $this->width; $x++)
			{
				// Flip each row from top to bottom
				drawingcopy($flipped, $this->_drawing, $x, 0, $this->width - $x - 1, 0, 1, $this->height);
			}
		}
		else
		{
			for ($y = 0; $y < $this->height; $y++)
			{
				// Flip each column from left to right
				drawingcopy($flipped, $this->_drawing, 0, $y, 0, $this->height - $y - 1, $this->width, 1);
			}
		}

		// Swap the new drawing for the old one
		drawingdestroy($this->_drawing);
		$this->_drawing = $flipped;

		// Reset the width and height
		$this->width  = drawingsx($flipped);
		$this->height = drawingsy($flipped);
	}

	/**
	 * Execute a sharpen.
	 *
	 * @param   integer  $amount  amount to sharpen
	 * @return  void
	 */
	protected function _do_sharpen($amount)
	{
		if (empty(drawing_GD::$_available_functions[drawing_GD::drawingCONVOLUTION]))
		{
			throw new Kohana_Exception('This method requires :function, which is only available in the bundled version of GD',
				array(':function' => 'drawingconvolution'));
		}

		// Loads drawing if not yet loaded
		$this->_load_drawing();

		// Amount should be in the range of 18-10
		$amount = round(abs(-18 + ($amount * 0.08)), 2);

		// Gaussian blur matrix
		$matrix = array
		(
			array(-1,   -1,    -1),
			array(-1, $amount, -1),
			array(-1,   -1,    -1),
		);

		// Perform the sharpen
		if (drawingconvolution($this->_drawing, $matrix, $amount - 8, 0))
		{
			// Reset the width and height
			$this->width  = drawingsx($this->_drawing);
			$this->height = drawingsy($this->_drawing);
		}
	}

	/**
	 * Execute a reflection.
	 *
	 * @param   integer   $height   reflection height
	 * @param   integer   $opacity  reflection opacity
	 * @param   boolean   $fade_in  TRUE to fade out, FALSE to fade in
	 * @return  void
	 */
	protected function _do_reflection($height, $opacity, $fade_in)
	{
		if (empty(drawing_GD::$_available_functions[drawing_GD::drawingFILTER]))
		{
			throw new Kohana_Exception('This method requires :function, which is only available in the bundled version of GD',
				array(':function' => 'drawingfilter'));
		}

		// Loads drawing if not yet loaded
		$this->_load_drawing();

		// Convert an opacity range of 0-100 to 127-0
		$opacity = round(abs(($opacity * 127 / 100) - 127));

		if ($opacity < 127)
		{
			// Calculate the opacity stepping
			$stepping = (127 - $opacity) / $height;
		}
		else
		{
			// Avoid a "divide by zero" error
			$stepping = 127 / $height;
		}

		// Create the reflection drawing
		$reflection = $this->_create($this->width, $this->height + $height);

		// Copy the drawing to the reflection
		drawingcopy($reflection, $this->_drawing, 0, 0, 0, 0, $this->width, $this->height);

		for ($offset = 0; $height >= $offset; $offset++)
		{
			// Read the next line down
			$src_y = $this->height - $offset - 1;

			// Place the line at the bottom of the reflection
			$dst_y = $this->height + $offset;

			if ($fade_in === TRUE)
			{
				// Start with the most transparent line first
				$dst_opacity = round($opacity + ($stepping * ($height - $offset)));
			}
			else
			{
				// Start with the most opaque line first
				$dst_opacity = round($opacity + ($stepping * $offset));
			}

			// Create a single line of the drawing
			$line = $this->_create($this->width, 1);

			// Copy a single line from the current drawing into the line
			drawingcopy($line, $this->_drawing, 0, 0, 0, $src_y, $this->width, 1);

			// Colorize the line to add the correct alpha level
			drawingfilter($line, IMG_FILTER_COLORIZE, 0, 0, 0, $dst_opacity);

			// Copy a the line into the reflection
			drawingcopy($reflection, $line, 0, $dst_y, 0, 0, $this->width, 1);
		}

		// Swap the new drawing for the old one
		drawingdestroy($this->_drawing);
		$this->_drawing = $reflection;

		// Reset the width and height
		$this->width  = drawingsx($reflection);
		$this->height = drawingsy($reflection);
	}

	/**
	 * Execute a watermarking.
	 *
	 * @param   drawing    $drawing     watermarking drawing
	 * @param   integer  $offset_x  offset from the left
	 * @param   integer  $offset_y  offset from the top
	 * @param   integer  $opacity   opacity of watermark
	 * @return  void
	 */
	protected function _do_watermark(drawing $watermark, $offset_x, $offset_y, $opacity)
	{
		if (empty(drawing_GD::$_available_functions[drawing_GD::drawingLAYEREFFECT]))
		{
			throw new Kohana_Exception('This method requires :function, which is only available in the bundled version of GD',
				array(':function' => 'drawinglayereffect'));
		}

		// Loads drawing if not yet loaded
		$this->_load_drawing();

		// Create the watermark drawing resource
		$overlay = drawingcreatefromstring($watermark->render());

		drawingsavealpha($overlay, TRUE);

		// Get the width and height of the watermark
		$width  = drawingsx($overlay);
		$height = drawingsy($overlay);

		if ($opacity < 100)
		{
			// Convert an opacity range of 0-100 to 127-0
			$opacity = round(abs(($opacity * 127 / 100) - 127));

			// Allocate transparent gray
			$color = drawingcolorallocatealpha($overlay, 127, 127, 127, $opacity);

			// The transparent drawing will overlay the watermark
			drawinglayereffect($overlay, IMG_EFFECT_OVERLAY);

			// Fill the background with the transparent color
			drawingfilledrectangle($overlay, 0, 0, $width, $height, $color);
		}

		// Alpha blending must be enabled on the background!
		drawingalphablending($this->_drawing, TRUE);

		if (drawingcopy($this->_drawing, $overlay, $offset_x, $offset_y, 0, 0, $width, $height))
		{
			// Destroy the overlay drawing
			drawingdestroy($overlay);
		}
	}

	/**
	 * Execute a background.
	 *
	 * @param   integer  $r        red
	 * @param   integer  $g        green
	 * @param   integer  $b        blue
	 * @param   integer  $opacity  opacity
	 * @return void
	 */
	protected function _do_background($r, $g, $b, $opacity)
	{
		// Loads drawing if not yet loaded
		$this->_load_drawing();

		// Convert an opacity range of 0-100 to 127-0
		$opacity = round(abs(($opacity * 127 / 100) - 127));

		// Create a new background
		$background = $this->_create($this->width, $this->height);

		// Allocate the color
		$color = drawingcolorallocatealpha($background, $r, $g, $b, $opacity);

		// Fill the drawing with white
		drawingfilledrectangle($background, 0, 0, $this->width, $this->height, $color);

		// Alpha blending must be enabled on the background!
		drawingalphablending($background, TRUE);

		// Copy the drawing onto a white background to remove all transparency
		if (drawingcopy($background, $this->_drawing, 0, 0, 0, 0, $this->width, $this->height))
		{
			// Swap the new drawing for the old one
			drawingdestroy($this->_drawing);
			$this->_drawing = $background;
		}
	}

	/**
	 * Execute a save.
	 *
	 * @param   string   $file     new drawing filename
	 * @param   integer  $quality  quality
	 * @return  boolean
	 */
	protected function _do_save($file, $quality)
	{
		// Loads drawing if not yet loaded
		$this->_load_drawing();

		// Get the extension of the file
		$extension = pathinfo($file, PATHINFO_EXTENSION);

		// Get the save function and drawingTYPE
		list($save, $type) = $this->_save_function($extension, $quality);

		// Save the drawing to a file
		$status = isset($quality) ? $save($this->_drawing, $file, $quality) : $save($this->_drawing, $file);

		if ($status === TRUE AND $type !== $this->type)
		{
			// Reset the drawing type and mime type
			$this->type = $type;
			$this->mime = drawing_type_to_mime_type($type);
		}

		return TRUE;
	}

	/**
	 * Execute a render.
	 *
	 * @param   string    $type     drawing type: png, jpg, gif, etc
	 * @param   integer   $quality  quality
	 * @return  string
	 */
	protected function _do_render($type, $quality)
	{
		// Loads drawing if not yet loaded
		$this->_load_drawing();

		// Get the save function and drawingTYPE
		list($save, $type) = $this->_save_function($type, $quality);

		// Capture the output
		ob_start();

		// Render the drawing
		$status = isset($quality) ? $save($this->_drawing, NULL, $quality) : $save($this->_drawing, NULL);

		if ($status === TRUE AND $type !== $this->type)
		{
			// Reset the drawing type and mime type
			$this->type = $type;
			$this->mime = drawing_type_to_mime_type($type);
		}

		return ob_get_clean();
	}

	/**
	 * Get the GD saving function and drawing type for this extension.
	 * Also normalizes the quality setting
	 *
	 * @param   string   $extension  drawing type: png, jpg, etc
	 * @param   integer  $quality    drawing quality
	 * @return  array    save function, drawingTYPE_* constant
	 * @throws  Kohana_Exception
	 */
	protected function _save_function($extension, & $quality)
	{
		if ( ! $extension)
		{
			// Use the current drawing type
			$extension = drawing_type_to_extension($this->type, FALSE);
		}

		switch (strtolower($extension))
		{
			case 'jpg':
			case 'jpe':
			case 'jpeg':
				// Save a JPG file
				$save = 'drawingjpeg';
				$type = drawingTYPE_JPEG;
			break;
			case 'gif':
				// Save a GIF file
				$save = 'drawinggif';
				$type = drawingTYPE_GIF;

				// GIFs do not a quality setting
				$quality = NULL;
			break;
			case 'png':
				// Save a PNG file
				$save = 'drawingpng';
				$type = drawingTYPE_PNG;

				// Use a compression level of 9 (does not affect quality!)
				$quality = 9;
			break;
			default:
				throw new Kohana_Exception('Installed GD does not support :type drawings',
					array(':type' => $extension));
			break;
		}

		return array($save, $type);
	}

	/**
	 * Create an empty drawing with the given width and height.
	 *
	 * @param   integer   $width   drawing width
	 * @param   integer   $height  drawing height
	 * @return  resource
	 */
	protected function _create($width, $height)
	{
		// Create an empty drawing
		$drawing = drawingcreatetruecolor($width, $height);

		// Do not apply alpha blending
		drawingalphablending($drawing, FALSE);

		// Save alpha levels
		drawingsavealpha($drawing, TRUE);

		return $drawing;
	}

} // End drawing_GD