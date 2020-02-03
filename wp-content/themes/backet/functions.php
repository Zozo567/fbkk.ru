<?php

register_nav_menus(array(
	'top'    => 'Верхнее меню',
	'bottom' => 'Нижнее меню'
));

add_theme_support('menus');
 
add_theme_support('post-thumbnails');
set_post_thumbnail_size(360, 500, true);

add_action( 'wp_ajax_basket', 'function_call' );
add_action( 'wp_ajax_nopriv_basket', 'function_call' );

function function_call(){

	$data = $_POST;

	if( !empty($_POST['href']) )
		$action = explode('/', $_POST['href']);
	else
		die('Нечего вызывать');

	include_once 'models/'.strtolower($action[0]).'.class.php';
	include_once 'models/basket.class.php';

	switch( $data['href'] ) {
		case "News/getNews" :
			$return = News::getNews();
			break;
		case "Events/getEvents" :
			$return = Events::getEvents();
			break;
		case "Competition/getCompetition" :
			$return = Competition::getCompetition();
			break;
		case "Contact/sendMessage" :
			$return = Contact::sendMessage();
			break;
		case "Media/getMedia" :
			$return = Media::getMedia();
			break;
		case "Document/getDocuments" :
			$return = Document::getDocuments();
			break;
		case "Competition/getCompetitionDocuments" :
			$return = Competition::getCompetitionDocuments();
			break;
		case "Statistic/getStatisticAll" :
			$return = Statistic::getStatisticAll();
			break;
		case "Competition/getCompetitionShedule" :
			$return = Competition::getCompetitionShedule();
			break;
		case "Calendar/getCalendar" :
			$return = Calendar::getCalendar();
			break;
		case "Media/getGaleryPhotos" :
			$return = Media::getGaleryPhotos();
			break;
		case "Competition/addToRequestListToCompetition" :
			$return = Competition::addToRequestListToCompetition();
			break;
		case "Competition/changeStatusRequest" :
			$return = Competition::changeStatusRequest();
			break;
		case "Competition/deleteRequest" :
			$return = Competition::deleteRequest();
			break;
	}

	echo json_encode($return);

	die();
}

function add_help_menu() {
    add_menu_page(
        'Заявки',
        'Заявки',
        'edit_posts',
        'admin_help',
        'request_list_page',
        'dashicons-editor-help',
        '10'
    );
}
add_action('admin_menu', 'add_help_menu');

function request_list_page() {

	include_once 'models/competition.class.php';
	include_once 'models/basket.class.php';

	// array requests list
	$data = Competition::getRequestListToCompetition();

	ob_start();

	require_once __DIR__ .'/pages/request.php';

	$return = ob_get_contents();

	ob_end_clean();

    echo $return;
}