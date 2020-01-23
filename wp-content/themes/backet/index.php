<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Basket
 * @since 1.0
 * @version 1.0
 */

$url = explode('/', $_SERVER['REQUEST_URI']);

if( stristr($_SERVER['REQUEST_URI'], '.pdf') ){

    $file = file_get_contents($_SERVER['REQUEST_URI']);
    die($file);

} elseif( $url[1] == 'rfb' && !empty($url[2]) ){

    if( stripos($url[2], '?') )
        $url[2] = explode('?', $url[2])[0];

    ob_start();

    include_once 'rfb/'. $url[2];

    $data = ob_get_contents();

    ob_end_clean();

    $body = str_replace('{{DIR_URI}}', get_template_directory_uri(), $data);

    echo $body;
    
    die();

} else {

    get_header();

    // require_once 'menu.php';
    include_once 'models/settings.php';

    get_footer();
}
?>