<?php
/**
 * @package Donosti_Blogs
 * @version 0.1.2
 */
/*
Plugin Name: Donostiblogs
Plugin URI: http://www.donostiblogs.com
Description: Este es un plugin para mostrar la barra de Donostiblogs.
Author: Ignacio Caballero
Version: 0.1.2
Author URI: http://www.tellodibujo.com
*/


function dibujar_barra() {
  $url="http://dl.dropbox.com/u/2778128/donostiblogs.html";  //automaticamente se actualiza con mi archivo y aparecen los nuevos blogs
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_HEADER, 0);  // ignore any headers
  ob_start();  // use output buffering so the contents don't get sent directly to the browser
  curl_exec($curl);  // get the file
  curl_close($curl);
  $file = ob_get_contents();  // save the contents of the file into $file
  ob_end_clean();  // turn output buffering back off
  echo $file;
	}

function dblogs_admin() {  
   include('donostiblogs_admin.php');  
}  
  
function dblogs_admin_actions() {  
    add_options_page("Donostiblogs", "Donostiblogs", 1, "Donostiblogs", "dblogs_admin");  
}  
  
add_action('admin_menu', 'dblogs_admin_actions');  



// Hacemos que la funcion se active cuando la accion se llama al wp_footer de la web
add_action('wp_head', 'dibujar_barra');

// Adjuntamos el archivo css, con la situacion de la barra y la estetica.
function styleblanco() {

	echo "
	<link rel='stylesheet' href='";
	bloginfo( 'url' );
	echo "/wp-content/plugins/donostiblogs/styleblanco.css'>
	";
}
function stylegris() {

	echo "
	<link rel='stylesheet' href='";
	bloginfo( 'url' );
	echo "/wp-content/plugins/donostiblogs/stylegris.css'>
	";
}
function styleazul() {

	echo "
	<link rel='stylesheet' href='";
	bloginfo( 'url' );
	echo "/wp-content/plugins/donostiblogs/styleazul.css'>
	";
}

//add_action('wp_head', 'donostiblogs_css');

//add_action('activate_donostiblogs/donostiblogs.php','saludo_instala');
//add_action('deactivate_donostiblogs/donostiblogs.php', 'saludo_desinstala');

add_action('admin_init', 'donostiblogs_opciones_init' );

function donostiblogs_opciones_init(){
    register_setting( 'donostiblogs_opciones_options', 'dblog_sample', 'donostiblogs_opciones_validate' );
}
 
// Sanitize and validate input. Accepts an array, return a sanitized array.
function donostiblogs_opciones_validate($input) {
    // Our first value is either 0 or 1
    //$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );
   
    // Say our second option must be safe text with no HTML tags
    $input['sometext'] =  wp_filter_nohtml_kses($input['sometext']);
   
    return $input;
}
$options = get_option('dblog_sample');
if ( $options['option1'] == "1" ){
   add_action('wp_head', 'stylegris');
}
 elseif ($options['option1'] == "2") {
   add_action('wp_head', 'styleazul');
}
 else {
   add_action('wp_head', 'styleblanco');
}
?>