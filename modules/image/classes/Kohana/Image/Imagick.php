<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Support for drawing manipulation using [Imagick](http://php.net/Imagick).
 *
 * @package    Kohana/drawing
 * @category   Drivers
 * @author     Tamas Mihalik tamas.mihalik@gmail.com
 * @copyright  (c) 2009-2012 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class Kohana_drawing_Imagick extends drawing {

	/**
	 * @var  Imagick  drawing magick object
	 */
	protected $im;

	/**
	 * Checks if drawingMagick is enabled.
	 *
	 * @throws  Kohana_Exception
	 * @return  boolean
	 */
	public static function check()
	{
		if ( ! extension_loaded('imagick'))
		{
			throw new Kohana_Exception('Imagick is not installed, or the extension is not loaded');
		}

		return drawing_Imagick::$_checked = TRUE;
	}

	/**
	 * Runs [drawing_Imagick::check] and loads the drawing.
	 *
	 * @return  void
	 * @throws  Kohana_Exception
	 */
	public function __construct($file)
	{
		if ( ! drawing_Imagick::$_checked)
		{
			// Run the install check
			drawing_Imagick::check();
		}

		parent::__construct($file);

		$this->im = new Imagick;
		$this->im->readdrawing($file);

		if ( ! $this->im->getdrawingAlphaChannel())
		{
			// Force the drawing to have an alpha channel
			$this->im->setdrawingAlphaChannel(Imagick::ALPHACHANNEL_SET);
		}
	}

	/**
	 * Destroys the loaded drawing to free up resources.
	 *
	 * @return  void
	 */
	public function __destruct()
	{
		$this->im->clear();
		$this->im->destroy();
	}

	protected function _do_resize($width, $height)
	{
		if ($this->im->scaledrawing($width, $height))
		{
			// Reset the width and height
			$this->width = $this->im->getdrawingWidth();
			$this->height = $this->im->getdrawingHeight();

			return TRUE;
		}

		return FALSE;
	}

	protected function _do_crop($width, $height, $offset_x, $offset_y)
	{
		if ($this->im->cropdrawing($width, $height, $offset_x, $offset_y))
		{
			// Reset the width and height
			$this->width = $this->im->getdrawingWidth();
			$this->height = $this->im->getdrawingHeight();

			// Trim off hidden areas
			$this->im->setdrawingPage($this->width, $this->height, 0, 0);

			return TRUE;
		}

		return FALSE;
	}

	protected function _do_rotate($degrees)
	{
		if ($this->im->rotatedrawing(new ImagickPixel('transparent'), $degrees))
		{
			// Reset the width and height
			$this->width = $this->im->getdrawingWidth();
			$this->height = $this->im->getdrawingHeight();

			// Trim off hidden areas
			$this->im->setdrawingPage($this->width, $this->height, 0, 0);

			return TRUE;
		}

		return FALSE;
	}

	protected function _do_flip($direction)
	{
		if ($direction === drawing::HORIZONTAL)
		{
			return $this->im->flopdrawing();
		}
		else
		{
			return $this->im->flipdrawing();
		}
	}

	protected function _do_sharpen($amount)
	{
		// IM not support $amount under 5 (0.15)
		$amount = ($amount < 5) ? 5 : $amount;

		// Amount should be in the range of 0.0 to 3.0
		$amount = ($amount * 3.0) / 100;

		return $this->im->sharpendrawing(0, $amount);
	}

	protected function _do_reflection($height, $opacity, $fade_in)
	{
		// Clone the current drawing and flip it for reflection
		$reflection = $this->im->clone();
		$reflection->flipdrawing();

		// Crop the reflection to the selected height
		$reflection->cropdrawing($this->width, $height, 0, 0);
		$reflection->setdrawingPage($this->width, $height, 0, 0);

		// Select the fade direction
		$direction = array('transparent', 'black');

		if ($fade_in)
		{
			// Change the direction of the fade
			$direction = array_reverse($direction);
		}

		// Create a gradient for fading
		$fade = new Imagick;
		$fade->newPseudodrawing($reflection->getdrawingWidth(), $reflection->getdrawingHeight(), vsprintf('gradient:%s-%s', $direction));

		// Apply the fade alpha channel to the reflection
		$reflection->compositedrawing($fade, Imagick::COMPOSITE_DSTOUT, 0, 0);

		// NOTE: Using setdrawingOpacity will destroy alpha channels!
		$reflection->evaluatedrawing(Imagick::EVALUATE_MULTIPLY, $opacity / 100, Imagick::CHANNEL_ALPHA);

		// Create a new container to hold the drawing and reflection
		$drawing = new Imagick;
		$drawing->newdrawing($this->width, $this->height + $height, new ImagickPixel);

		// Force the drawing to have an alpha channel
		$drawing->setdrawingAlphaChannel(Imagick::ALPHACHANNEL_SET);

		// Force the background color to be transparent
		// $drawing->setdrawingBackgroundColor(new ImagickPixel('transparent'));

		// Match the colorspace between the two drawings before compositing
		$drawing->setColorspace($this->im->getColorspace());

		// Place the drawing and reflection into the container
		if ($drawing->compositedrawing($this->im, Imagick::COMPOSITE_SRC, 0, 0)
		AND $drawing->compositedrawing($reflection, Imagick::COMPOSITE_OVER, 0, $this->height))
		{
			// Replace the current drawing with the reflected drawing
			$this->im = $drawing;

			// Reset the width and height
			$this->width = $this->im->getdrawingWidth();
			$this->height = $this->im->getdrawingHeight();

			return TRUE;
		}

		return FALSE;
	}

	protected function _do_watermark(drawing $drawing, $offset_x, $offset_y, $opacity)
	{
		// Convert the drawing intance into an Imagick instance
		$watermark = new Imagick;
		$watermark->readdrawingBlob($drawing->render(), $drawing->file);

		if ($watermark->getdrawingAlphaChannel() !== Imagick::ALPHACHANNEL_ACTIVATE)
		{
			// Force the drawing to have an alpha channel
			$watermark->setdrawingAlphaChannel(Imagick::ALPHACHANNEL_OPAQUE);
		}

		if ($opacity < 100)
		{
			// NOTE: Using setdrawingOpacity will destroy current alpha channels!
			$watermark->evaluatedrawing(Imagick::EVALUATE_MULTIPLY, $opacity / 100, Imagick::CHANNEL_ALPHA);
		}

		// Match the colorspace between the two drawings before compositing
		// $watermark->setColorspace($this->im->getColorspace());

		// Apply the watermark to the drawing
		return $this->im->compositedrawing($watermark, Imagick::COMPOSITE_DISSOLVE, $offset_x, $offset_y);
	}

	protected function _do_background($r, $g, $b, $opacity)
	{
		// Create a RGB color for the background
		$color = sprintf('rgb(%d, %d, %d)', $r, $g, $b);

		// Create a new drawing for the background
		$background = new Imagick;
		$background->newdrawing($this->width, $this->height, new ImagickPixel($color));

		if ( ! $background->getdrawingAlphaChannel())
		{
			// Force the drawing to have an alpha channel
			$background->setdrawingAlphaChannel(Imagick::ALPHACHANNEL_SET);
		}

		// Clear the background drawing
		$background->setdrawingBackgroundColor(new ImagickPixel('transparent'));

		// NOTE: Using setdrawingOpacity will destroy current alpha channels!
		$background->evaluatedrawing(Imagick::EVALUATE_MULTIPLY, $opacity / 100, Imagick::CHANNEL_ALPHA);

		// Match the colorspace between the two drawings before compositing
		$background->setColorspace($this->im->getColorspace());

		if ($background->compositedrawing($this->im, Imagick::COMPOSITE_DISSOLVE, 0, 0))
		{
			// Replace the current drawing with the new drawing
			$this->im = $background;

			return TRUE;
		}

		return FALSE;
	}

	protected function _do_save($file, $quality)
	{
		// Get the drawing format and type
		list($format, $type) = $this->_get_drawingtype(pathinfo($file, PATHINFO_EXTENSION));

		// Set the output drawing type
		$this->im->setFormat($format);

		// Set the output quality
		$this->im->setdrawingCompressionQuality($quality);

		if ($this->im->writedrawing($file))
		{
			// Reset the drawing type and mime type
			$this->type = $type;
			$this->mime = drawing_type_to_mime_type($type);

			return TRUE;
		}

		return FALSE;
	}

	protected function _do_render($type, $quality)
	{
		// Get the drawing format and type
		list($format, $type) = $this->_get_drawingtype($type);

		// Set the output drawing type
		$this->im->setFormat($format);

		// Set the output quality
		$this->im->setdrawingCompressionQuality($quality);

		// Reset the drawing type and mime type
		$this->type = $type;
		$this->mime = drawing_type_to_mime_type($type);

		return (string) $this->im;
	}

	/**
	 * Get the drawing type and format for an extension.
	 *
	 * @param   string  $extension  drawing extension: png, jpg, etc
	 * @return  string  drawingTYPE_* constant
	 * @throws  Kohana_Exception
	 */
	protected function _get_drawingtype($extension)
	{
		// Normalize the extension to a format
		$format = strtolower($extension);

		switch ($format)
		{
			case 'jpg':
			case 'jpe':
			case 'jpeg':
				$type = drawingTYPE_JPEG;
			break;
			case 'gif':
				$type = drawingTYPE_GIF;
			break;
			case 'png':
				$type = drawingTYPE_PNG;
			break;
			default:
				throw new Kohana_Exception('Installed drawingMagick does not support :type drawings',
					array(':type' => $extension));
			break;
		}

		return array($format, $type);
	}
} // End Kohana_drawing_Imagick