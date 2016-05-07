# drawing

Kohana 3.x provides a simple yet powerful drawing manipulation module. The [drawing] module provides features that allows your application to resize drawings, crop, rotate, flip and many more.

## Drivers

[drawing] module ships with [drawing_GD] driver which requires `GD` extension enabled in your PHP installation, and
[drawing_Imagick] driver which requires the `imagick` PHP extension. Additional drivers can be created by extending 
the [drawing] class.

The [drawing_GD] driver is the default. You can change this by providing an `drawing.default_driver` configuration option
- for example:

~~~
// application/config/drawing.php
<?php
return array(
    'default_driver' => 'Imagick'
);
~~~

[!!] Older versions of Kohana allowed you to configure the driver with the `drawing::$default_driver` static variable in
the bootstrap, an extension class, or elsewhere. That variable is now deprecated and will be ignored if you set a 
config value. 

## Getting Started

Before using the drawing module, we must enable it first on `APPPATH/bootstrap.php`:

~~~
Kohana::modules(array(
    ...
    'drawing' => MODPATH.'drawing',  // drawing manipulation
    ...
));
~~~

Next: [Using the drawing module](using).