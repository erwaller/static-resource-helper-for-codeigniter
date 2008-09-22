<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/*
|--------------------------------------------------------------------------
| Static Resource Library
|--------------------------------------------------------------------------
|
| Some simple code to help manage/serve static
| files efficiently.
|
*/

function include_js ($includes) {
  $config = get_config();
  $files = explode(',', preg_replace('/\s+/', '', $includes));
  foreach($files as $file){
    $uri = $config['static_resource_url'].'js/'.auto_version($file, 'js/').'/'.$file;
    echo '<script type="text/javascript" src="'.$uri.'"></script>';
  }
}

function include_css ($includes) {
  $config = get_config();
  $files = explode(',', preg_replace('/\s+/', '', $includes));
  foreach($files as $file){
    $uri = $config['static_resource_url'].'css/'.auto_version($file, 'css/').'/'.$file;
    echo '<link rel="stylesheet" type="text/css" media="all" href="'.$uri.'"></link>';
  }
}

/*  
 *  This obviously won't work if files are being served by s3 
 *  but it's helpful even just to not have to jump through hoops
 *  in ff3 to get a true refresh.
 *  
 *  This'll have to get incorporated into a more complete build
 *  process for s3 -- ie possibly generating some php to tell this
 *  function the current version number
 */
function auto_version($filename, $path){
    $config = get_config();
    $base_dir = getcwd().$config['static_resource_path'];
    return filemtime($base_dir.$path.$filename);
}


?>
