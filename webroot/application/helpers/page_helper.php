<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function get_page_path($raw_name, &$ext)
{
	/*
	{URL} -> {File}
	/pages/share/openapi -> /page_repository/share/openapi.(html or md)
	/pages/search/example -> /page_repository/search/example.(html or md)
	*/

	$raw_name = substr($raw_name,6);
	$file_name = str_replace('/','_',$raw_name);
	
	$cat_index = strpos($file_name,'_');
	if($cat_index === false) return null;
	$cat = substr($file_name,0,$cat_index); 
	$file_name = substr($file_name,$cat_index+1); 

	$path = PAGE_DIR.'/'.$cat.'/'.$file_name;

	$ext = '';
	if(file_exists('.'.$path.'.html')) $ext = 'html';
	else if(file_exists('.'.$path.'.php')) $ext = 'php';
    else if(file_exists('.'.$path.'.content')) $ext = 'content';
    else if(file_exists('.'.$path.'.md')) $ext = 'md';
    else if(file_exists('.'.$path.'.url')) $ext = 'url';
    else return null;

    return $path.'.'.$ext;
}