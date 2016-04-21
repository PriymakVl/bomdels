<?php defined('SYSPATH') OR die('No direct script access.');

class HTML extends Kohana_HTML {
    
    	/**
	 * Creates a style sheet link element.
	 *
	 *     echo HTML::less('style.less');
	 *
	 * @param   string  $file       file name
	 * @param   string  $pass       the pass to the file
	 * @return  string
	 */
	public static function less($file, $pass = NULL)
	{
        if(!isset($file)) return false;
        $pass = isset($pass) ? $pass : '/media/css/';
		// Set the stylesheet link
		$href = $pass.$file;

		return "<link rel= 'stylesheet/less' href='{$href}' />";
	}
    
       	/**
	 * Creates a style sheet link element.
	 *
	 *     echo HTML::css('style.less');
	 *
	 * @param   string  $file       file name
	 * @param   string  $pass       the pass to the file
	 * @return  string
	 */
	public static function css($file, $pass = NULL)
	{
        if(!isset($file)) return false;
        $pass = isset($pass) ? $pass : '/media/css/';
		// Set the stylesheet link
		$href = $pass.$file;

		return "<link rel= 'stylesheet' href='{$href}' />";
	}
    
    	/**
	 * Creates a script link.
	 *
	 *     echo HTML::script('jquery.js');
	 *
	 * @param   string  $file       file name
	 * @param   string  $pass       the pass to the file
	 * @return  string
	 */
	public static function js($file, $pass = NULL)
	{
        if(!isset($file)) return false;
		$pass = isset($pass) ? $pass : '/media/js/';
		// Set the script source
		$src = $pass.$file;

		return "<script src='{$src}'></script>";
	}
}
