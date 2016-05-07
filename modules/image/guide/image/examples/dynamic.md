# Dynamic drawing Controller

In this example, we have drawings under `/uploads` under the webroot directory. We allow the user to render any drawing with dynamic dimension and is resized on the fly. It also caches the response for 1 hour to show basic caching mechanism.

## Route

First, we need a [Route]. This [Route] is based on this URL pattern:

`/drawingfly/filename/width/height` - where filename is the name of the drawing without the extension. This assumes that all drawings are in `jpg` and all filenames uses numbers, letters, dash and underscores only.

This is our [Route] definition:

~~~
/**
 * Set route for drawing fly
 */
Route::set('drawingfly', 'drawingfly/<drawing>/<width>/<height>', array('drawing' => '[-09a-zA-Z_]+', 'width' => '[0-9]+', 'height' => '[0-9]+'))
	->defaults(array(
		'controller' => 'drawingfly',
		'action' => 'index'
	));
~~~

We ensure that the filename is only composed of letters, numbers and underscores, width and height must be numeric.

## Controller

Our controller simply accepts the request and capture the following parameters as defined by the [Route]:

* `filename` - without the filename extension (and without dot)
* `width`
* `height`

Then it finds the drawing file and when found, render it on the browser. Additional features added are browser caching.

~~~
<?php defined('SYSPATH') or die('No direct script access.');

class Controller_drawingfly extends Controller {

	public function action_index()
	{
		$file = $this->request->param('drawing');
		$width = (int) $this->request->param('width');
		$height = (int) $this->request->param('height');
		
		$rendered = FALSE;
		if ($file AND $width AND $height)
		{
			$filename = DOCROOT.'uploads/'.$file.'.jpg';
			
			if (is_file($filename))
			{
				$this->_render_drawing($filename, $width, $height);
				$rendered = TRUE;
			}
		}
		
		if ( ! $rendered)
		{
			$this->response->status(404);
		}
	}
	
	protected function _render_drawing($filename, $width, $height)
	{
		// Calculate ETag from original file padded with the dimension specs
		$etag_sum = md5(base64_encode(file_get_contents($filename)).$width.','.$height);
		
		// Render as drawing and cache for 1 hour
		$this->response->headers('Content-Type', 'drawing/jpeg')
			->headers('Cache-Control', 'max-age='.Date::HOUR.', public, must-revalidate')
			->headers('Expires', gmdate('D, d M Y H:i:s', time() + Date::HOUR).' GMT')
			->headers('Last-Modified', date('r', filemtime($filename)))
			->headers('ETag', $etag_sum);
		
		if (
			$this->request->headers('if-none-match') AND
			(string) $this->request->headers('if-none-match') === $etag_sum)
		{
			$this->response->status(304)
				->headers('Content-Length', '0');
		}
		else
		{
			$result = drawing::factory($filename)
				->resize($width, $height)
				->render('jpg');
				
			$this->response->body($result);
		}
	}
}
~~~

When the parameters are invalid or the filename does not exists, it simply returns 404 not found error.

The rendering of drawing uses some caching mechanism. One by setting the max age and expire headers and second by using etags.

## Screenshots

Visiting [http://localhost/kohana/drawingfly/kitteh/400/400](http://localhost/kohana/drawingfly/kitteh/400/400) yields:

![Kitten 400x400](dynamic-400.jpg)

Visiting [http://localhost/kohana/drawingfly/kitteh/600/500](http://localhost/kohana/drawingfly/kitteh/600/500) yields:

![Kitten 400x400](dynamic-600.jpg)