<?php

define('DIR_PATH', realpath(__DIR__.'/../'));
define('MODELS_PATH', DIR_PATH.'/models');
define('LIB_PATCH', DIR_PATH.'/libraries');
define('JSON_PATH', DIR_PATH.'/assets/json');


include_once 'basket.class.php';
include_once 'news.class.php';
include_once 'events.class.php';
include_once 'competition.class.php';
include_once 'federation.class.php';
include_once 'contact.class.php';
include_once 'guidance.class.php';
include_once 'document.class.php';
include_once 'projects.class.php';
include_once 'media.class.php';
include_once 'statistic.class.php';
include_once 'calendar.class.php';

$Basket = new Basket();
$Basket->autoload();