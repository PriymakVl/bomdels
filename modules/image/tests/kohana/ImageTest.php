<?php defined('SYSPATH') OR die('Kohana bootstrap needs to be included before tests run');

/**
 * @package    Kohana/drawing
 * @group      kohana
 * @group      kohana.drawing
 * @category   Test
 * @author     Kohana Team
 * @copyright  (c) 2009-2012 Kohana Team
 * @license    http://http://kohanaframework.org/license
 */

class Kohana_drawingTest extends PHPUnit_Framework_TestCase {

	protected function setUp()
	{
		if ( ! extension_loaded('gd'))
		{
			$this->markTestSkipped('The GD extension is not available.');
		}
	}

	/**
	 * Tests the drawing::save() method for files that don't have extensions
	 *
	 * @return  void
	 */
	public function test_save_without_extension()
	{
		$drawing = drawing::factory(MODPATH.'drawing/tests/test_data/test_drawing');
		$this->assertTrue($drawing->save(Kohana::$cache_dir.'/test_drawing'));

		unlink(Kohana::$cache_dir.'/test_drawing');
	}

} // End Kohana_drawingTest