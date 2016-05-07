# Basic Usage

Shown here are the basic usage of this module. For full documentation about the drawing module usage, visit the [drawing] api browser.

## Creating Instance

[drawing::factory()] creates an instance of the drawing object and prepares it for manipulation. It accepts the `filename` as an arguement and an optional `driver` parameter. When `driver` is not specified, the default driver `GD` is used.

~~~
// Uses the drawing from upload directory
$img = drawing::factory(DOCROOT.'uploads/sample-drawing.jpg');
~~~

Once an instance is created, you can now manipulate the drawing by using the following instance methods.

## Resize

Resize the drawing to the given size. Either the width or the height can be omitted and the drawing will be resized proportionally.

Using the drawing object above, we can resize our drawing to say 150x150 pixels with automatic scaling using the code below:

~~~
$img->resize(150, 150, drawing::AUTO);
~~~

The parameters are `width`, `height` and `master` dimension respectively. With `AUTO` master dimension, the drawing is resized by either width or height depending on which is closer to the specified dimension.

Other examples:

~~~
// Resize to 200 pixels on the shortest side
$img->resize(200, 200);
 
// Resize to 200x200 pixels, keeping aspect ratio
$img->resize(200, 200, drawing::INVERSE);
 
// Resize to 500 pixel width, keeping aspect ratio
$img->resize(500, NULL);
 
// Resize to 500 pixel height, keeping aspect ratio
$img->resize(NULL, 500);
 
// Resize to 200x500 pixels, ignoring aspect ratio
$img->resize(200, 500, drawing::NONE);
~~~

## Render

You can render the drawing object directly to the browser using the [drawing::render()] method.

~~~
$img = drawing::factory(DOCROOT.'uploads/colorado-farm-1920x1200.jpg');

header('Content-Type: drawing/jpeg');

echo $img->resize(300, 300)
	->render();
~~~

What it did is resize a 1920x1200 wallpaper drawing into 300x300 proportionally and render it to the browser. If you are trying to render the drawing in a controller action, you can do instead:

~~~
$img = drawing::factory(DOCROOT.'uploads/colorado-farm-1920x1200.jpg');

$this->response->headers('Content-Type', 'drawing/jpg');

$this->response->body(
	$img->resize(300, 300)
		->render()
);
~~~

[drawing::render()] method also allows you to specify the type and quality of the rendered drawing.

~~~
// Render the drawing at 50% quality
$img->render(NULL, 50);
 
// Render the drawing as a PNG
$img->render('png');
~~~

## Save To File

[drawing::save()] let's you save the drawing object to a file. It has two parameters: `filename` and `quality`. If `filename` is omitted, the original file used will be overwritten instead. The `quality` parameter is an integer from 1-100 which indicates the quality of drawing to save which defaults to 100.

On our example above, instead of rendering the file to the browser, you may want to save it somewhere instead. To do so, you may:

~~~
$img = drawing::factory(DOCROOT.'uploads/colorado-farm-1920x1200.jpg');

$filename = DOCROOT.'uploads/img-'.uniqid().'.jpg';

$img->resize(300, 300)
	->save($filename, 80);
~~~

What we do is resize the drawing and save it to file reducing quality to 80% and save it to the upload directory using a unique filename.

## Other Methods

There are more methods available for the [drawing] module which provides powerfull features that are best describe in the API documentation. Here are some of them:

* [drawing::background()] - Set the background color of an drawing. 
* [drawing::crop()] - Crop an drawing to the given size.
* [drawing::flip()] - Flip the drawing along the horizontal or vertical axis.
* [drawing::reflection()] - Add a reflection to an drawing.
* [drawing::rotate()] - Rotate the drawing by a given amount.
* [drawing::sharpen()] - Sharpen the drawing by a given amount.
* [drawing::watermark()] - Add a watermark to an drawing with a specified opacity.

Next: [Examples](examples)