<?php 

$page_url = explode('/', $_SERVER['REQUEST_URI']);

// $page_id = get_post(); // подставить свой id страницы "Главная"

$page = $page_url[1];

if( $page == "" )
    $page = 'main';

// $post_category_type = [
//     5 => 'events',
//     4 => 'news',
//     9 => 'media',
//     8 => 'events',
//     3 => 'news',
// ];

// страницы, на которых будет отображаться правый блок событий
// $right_events = [
//     'federation' => 'О Федерации',
//     'contact' => 'Контакты',
//     'guidance' => 'Руководство',
//     'document' => 'Документы',
//     'news' => 'Новости',
//     'events' => 'События',
//     'note' => '',
//     'competition' => 'Соревнования',
//     'competition_page' => 'Соревнования',
//     'calendar' => 'Календарь',
//     'projects' => 'Проекты',
//     'search' => 'Поиск',
//     'media' => 'Медиа',
// ];

// странице, на которых будет вверхнее изображение
// $top_img = [
//     '' => '/assets/images/Rectangle_1_copy_2.png',
//     'news' => '/assets/images/Rectangle_1_copy_2.png',
//     'events' => '/assets/images/Rectangle_1_copy_2.png',
//     'note' => '/assets/images/Rectangle_1_copy_2.png',
//     'competition' => '/assets/images/Rectangle_1_copy_2.png',
//     'federation' => '/assets/images/federation.png',
//     'contact' => '/assets/images/federation.png',
//     'guidance' => '/assets/images/federation.png',
//     'document' => '/assets/images/federation.png',
//     'calendar' => '/assets/images/Rectangle_1_copy_2.png',
//     'projects' => '/assets/images/Rectangle_1_copy_2.png',
//     'media' => '/assets/images/Rectangle_1_copy_2.png',
// ];

if( isset($page_url[3]) )
    $page_data = get_post($page_url[3]);
else
    $page_data = get_page_by_path($page);

$page_data_meta = get_post_meta($page_data->ID);
?>

<!-- Поиск по записям -->
<div class="seach_posts_div" style="float: left;"></div>

<!-- отображение верхнего изображения -->
<?php if( get_the_post_thumbnail_url($page_data->ID) && isset($page_data_meta['top_img']) && current($page_data_meta['top_img']) == 1 ) { 
    $isset_top_img = 1;?>
    <div class="header-news">
    <div class="header-news-img" style="background-image: url(<?=get_the_post_thumbnail_url($page_data->ID, 'full')?>);"></div>
        <?php if( $page == 'federation' || $page == 'document' || $page == 'guidance' || $page == 'contact' ) { ?>
            <div class="container">
                <div class="mobile-head-news">
                    <div class="adap-header-federation">
                        <div class="row row-block row-main-block">
                            <div class="col-md-12 col-lg-12 col-sm-12" style="text-align:center; padding-bottom: 20px;">
                                <span class="page-header-text-federation"><a href="/federation">О федерации</a></span>
                            </div>

                            <div class="col-md-12 col-lg-12 col-sm-12" style="text-align:center;">
                                <div class="page-nav-federation">
                                    <a href="/guidance"> Руководство</a>
                                    <a href="/document">Документы</a>
                                    <a href="/contact">Контакты</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="desctop-head-news">
                    <div class="row row-block col-main-block" style="padding-top: 80px;">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-main-block" style="text-align:left; padding-bottom: 20px;">
                            <span class="page-header-text-federation"><a href="/federation">О федерации</a></span>
                        </div>

                        <div class="col-md-12 col-lg-12 col-sm-12 col-main-block" style="text-align:left;">
                            <div class="page-nav-federation">
                                <a href="/guidance">Руководство</a>
                                <a href="/document">Документы</a>
                                <a href="/contact">Контакты</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if( $page == 'projects' || $page == 'loko-start' || $page == 'nba-junior' ) { ?>
            <div class="container">
                <div class="mobile-head-news">
                    <div class="adap-header-federation">
                        <div class="row row-block col-main-block">
                            <div class="col-md-12 col-lg-12 col-sm-12 col-main-block" style="text-align:center; padding-bottom: 20px;">
                                <span class="page-header-text-federation"><a href="/projects">Проекты</a></span>
                            </div>

                            <div class="col-md-12 col-lg-12 col-sm-12 col-main-block" style="text-align:center;">
                                <div class="page-nav-federation">
                                    <a href="/projects/loko-start">Локостарт</a>
                                    <a href="/projects/nba-junior/">Junior NBA</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="desctop-head-news">
                    <div class="container col-main-block">
                        <div class="row row-block col-main-block" style="padding-top: 80px;">
                            <div class="col-md-12 col-lg-12 col-sm-12 col-main-block" style="text-align:left; padding-bottom: 20px;">
                                <span class="page-header-text-federation"><a href="/projects">Проекты</a></span>
                            </div>

                            <div class="col-md-12 col-lg-12 col-sm-12 col-main-block" style="text-align:left;">
                                <div class="page-nav-federation">
                                    <a href="/projects/loko-start">Локостарт</a>
                                    <a href="/projects/nba-junior/">Junior NBA</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } else { 
    $isset_top_img = 0;?>
    <div class="none-top-img" style="height: 250px;"></div>
<?php } ?>

<!-- Хлебные крошки -->
<?php if( $page != 'main' ) { 
    // название отдельной записи для хлебных крошек
    if( isset($page_url[3]) && !empty($page_url[3]) ){

        $post_bread_name = $page_url[4] ? $page_data->post_title .' - '. $page_url[4] : $page_data->post_title; // заголовок поста
        
        $bread = '<a class="color-white" href="/">Главная</a> '.
        '<svg class="bread-padd" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="0.106cm" height="0.176cm">
            <path fill-rule="evenodd"  fill="rgb(187, 187, 187)"  d="M2.000,3.000 L2.000,4.000 L1.000,4.000 L1.000,5.000 L-0.000,5.000 L-0.000,3.000 L-0.000,3.000 L-0.000,2.000 L-0.000,2.000 L-0.000,-0.000 L1.000,-0.000 L1.000,1.000 L2.000,1.000 L2.000,2.000 L3.000,2.000 L3.000,3.000 L2.000,3.000 Z"/>
        </svg>' .
        '<a class="color-white" href="/'. $page_url[1] .'/"> '. get_the_category($page_data->ID)[0]->name .'</a> '.
        '<svg class="bread-padd" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="0.106cm" height="0.176cm">
            <path fill-rule="evenodd"  fill="rgb(187, 187, 187)"  d="M2.000,3.000 L2.000,4.000 L1.000,4.000 L1.000,5.000 L-0.000,5.000 L-0.000,3.000 L-0.000,3.000 L-0.000,2.000 L-0.000,2.000 L-0.000,-0.000 L1.000,-0.000 L1.000,1.000 L2.000,1.000 L2.000,2.000 L3.000,2.000 L3.000,3.000 L2.000,3.000 Z"/>
        </svg>'. $post_bread_name;
    } else
        $bread = '<a class="color-white" href="/">Главная</a>'.
        '<svg class="bread-padd" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="0.106cm" height="0.176cm">
            <path fill-rule="evenodd"  fill="rgb(187, 187, 187)"  d="M2.000,3.000 L2.000,4.000 L1.000,4.000 L1.000,5.000 L-0.000,5.000 L-0.000,3.000 L-0.000,3.000 L-0.000,2.000 L-0.000,2.000 L-0.000,-0.000 L1.000,-0.000 L1.000,1.000 L2.000,1.000 L2.000,2.000 L3.000,2.000 L3.000,3.000 L2.000,3.000 Z"/>
        </svg>'.
        '<a class="color-white" href="/'. $page_url[1] .'/">'. $page_data->post_title .'</a>';
    ?>
    <div class="container bread-container">
        <div class="bread_crumbs">
            <span class="color-white"><?=$bread?></span>
        </div>
    </div>
<?php } ?>

<!-- слайдбар с последними событиями на главной странице -->
<?php if( $page == 'main' ) { ?>
    <div class="desctop carousel-desctop">
        <div class="">
            <div class="col-md-12 col-lg-12 col-sm-12 carousel-events-main">
            <?php
            // $arguments = [
            //     'numberposts' => -1,
            //     'offset' => 0,
            //     'order' => 'DESC',
            //     'category_name' => 'events'
            // ];
            // $all_posts = get_posts($arguments);
            $all_posts = Events::getEvents(false, true);
            $count_post = count($all_posts);
                if( $count_post > 3 ){ ?>
                <div id="carouselExample" class="carousel slide container-partner container" data-ride="carousel" data-interval="9000">
                    <div class="carousel-inner mx-auto container-partner container" role="listbox">
                        <?php 
                        $part_posts = array_chunk($all_posts, 3);
                        foreach( $part_posts as $part_posts_key => $Posts ) {
                        ?>
                                <div class="carousel-item <?=$part_posts_key == 0 ? 'active' : ''?> carousel-content">
                                    <div class="row">
                                    <?php 
                                    foreach( $Posts as $post ){ 
                                        $url = get_permalink( $post );
                                        $post_meta = get_post_meta($post->ID); ?>
                                        <div class="col-md-4 col-lg-4 col-sm-4">
                                            <?php
                                            $date_start_post = explode(' ', current($post_meta['date_start_event']));
                                            $date_start_day = explode('-', $date_start_post[0]);
                                            $date_start_month = Basket::getRussianMonth( (int) $date_start_day[1]);
                                            $period_date = false;

                                            if( isset($post_meta['date_end_event']) && $post_meta['date_end_event'][0] != "" ){
                                                $date_end_post = explode(' ', current($post_meta['date_end_event']));
                                                $date_end_day = explode('-', $date_end_post[0]);
                                                $date_end_month = Basket::getRussianMonth( (int) $date_end_day[1]);
                                                $period_date = true;
                                            }

                                            if( $period_date ){ ?>
                                                <p class="date-event-time"><?=$date_start_day[2]?> <?=$date_start_month?> <i class="fa fa-minus" aria-hidden="true"></i> <?=$date_end_day[2]?> <?=$date_end_month?></p>
                                            <?php }else{ ?>
                                                <p class="date-event-time"><?=$date_start_day[2]?> <?=$date_start_month?> </p>
                                            <?php }

                                            if( isset( $post_meta['place'] ) ){ ?>
                                            <p class="date-event-place" style="padding-top:10px;">
                                            <span style="padding-right: 10px;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="12" height="15" viewBox="0 0 12 15">
                                                <image id="noun_Map_2339479_1A1A1A_copy" data-name="noun_Map_2339479_1A1A1A copy" width="12" height="15" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAeCAYAAAA2Lt7lAAAB+ElEQVRIia2W30sUURTHP24L2suq5YOw0UOCYBBlWo8i+NCDmX9CUP9YWFAIBpHYSyLSD0GUrBelSFR20yDzR1BPtnLgjPfOnHvHwfUDF5bvPfd8Z2fOzDktjUaDHC4B14Cq/r6oof+A30AN+A7sx1LEDC4Dw8ANsxPmMzAXMgoZDACjQCmYKs4R8BpYyTMY1tUMs8C75Lx/lQPnkFwYAfqzBh3AmAk9O+NAxTd4UDDXX11FEBPKQKeWYh5fgEXgJyAPrRu4A9zMOdMjpS0GfWYrzVvgfUar6doB7pkTjuslfYlibASS+ywA60Z1VEv6gGN8iOg+H43iaBeDNiM79oxi2TWKo7Wkb2CM1ojuk3eBR2JwYGTHLaNY+o3i+CMGP4zskFK8alTHFeCuUR3bYrBq5DSPgEHggqfKudvAYxOdZrWstfwL6DLbjvvAkMaiL1rFRKWRflFPPhVvzLZFEvbqOi35Sc7EQLrSpgk5O3XgG5nP9dQ5GkwmP3yDQ+1IzTLjl362LS4Da00YfNWv7gmhvvsi1LwLIHfgeTYsZCA8Af4bNU5Dz5gJImYg/2DCqHGead0bYgZoL3hlVMu0lnmQPAPhEzBvVIeMJ0tG9SgyXMnEJkZZpE/LDJRL0elNbpXcsoQt4GWRg6cNv6lY4KFWytNCVQYcA9QsZuDq9HktAAAAAElFTkSuQmCC"/>
                                            </svg></span>
                                                <?=current($post_meta['place'])?>
                                        </p>
                                        <?php } ?>
                                            <p class="carousel-title"><?=$post->post_title?></p>
                                        </div>
                                    <?php } ?>
                                    </div>
                                </div>
                        <?php } ?>
                        </div>
                    <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev"style="width: 50px; padding-bottom:50px; padding-right:50px;"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
                    <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next"style="width: 50px; padding-bottom:50px; padding-left:50px;"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                </div>
                <?php } else { ?>
                    <div class="container">
                        <div class="row">
                        <?php 
                        foreach( $all_posts as $post ){ 
                            $url = get_permalink( $post );
                            $post_meta = get_post_meta($post->ID); ?>
                            <div class="col-md-4 col-lg-4 col-sm-4">
                            <?php
                                $date_start_post = explode(' ', current($post_meta['date_start_event']));
                                $date_start_day = explode('-', $date_start_post[0]);
                                $date_start_month = Basket::getRussianMonth( (int) $date_start_day[1]);
                                $period_date = false;

                                if( isset($post_meta['date_end_event']) && $post_meta['date_end_event'][0] != "" ){
                                    $date_end_post = explode(' ', current($post_meta['date_end_event']));
                                    $date_end_day = explode('-', $date_end_post[0]);
                                    $date_end_month = Basket::getRussianMonth( (int) $date_end_day[1]);
                                    $period_date = true;
                                }

                                if( $period_date ){ ?>
                                    <p class="date-event-time"><?=$date_start_day[2]?> <?=$date_start_month?> <i class="fa fa-minus" aria-hidden="true"></i> <?=$date_end_day[2]?> <?=$date_end_month?></p>
                                <?php }else{ ?>
                                    <p class="date-event-time"><?=$date_start_day[2]?> <?=$date_start_month?> </p>
                                <?php }
                            if( isset( $post_meta['place'] ) ){ ?>
                                <p class="date-event-place" style="padding-top:10px;">
                                <span style="padding-right: 10px;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="12" height="15" viewBox="0 0 12 15">
                                    <image id="noun_Map_2339479_1A1A1A_copy" data-name="noun_Map_2339479_1A1A1A copy" width="12" height="15" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAeCAYAAAA2Lt7lAAAB+ElEQVRIia2W30sUURTHP24L2suq5YOw0UOCYBBlWo8i+NCDmX9CUP9YWFAIBpHYSyLSD0GUrBelSFR20yDzR1BPtnLgjPfOnHvHwfUDF5bvPfd8Z2fOzDktjUaDHC4B14Cq/r6oof+A30AN+A7sx1LEDC4Dw8ANsxPmMzAXMgoZDACjQCmYKs4R8BpYyTMY1tUMs8C75Lx/lQPnkFwYAfqzBh3AmAk9O+NAxTd4UDDXX11FEBPKQKeWYh5fgEXgJyAPrRu4A9zMOdMjpS0GfWYrzVvgfUar6doB7pkTjuslfYlibASS+ywA60Z1VEv6gGN8iOg+H43iaBeDNiM79oxi2TWKo7Wkb2CM1ojuk3eBR2JwYGTHLaNY+o3i+CMGP4zskFK8alTHFeCuUR3bYrBq5DSPgEHggqfKudvAYxOdZrWstfwL6DLbjvvAkMaiL1rFRKWRflFPPhVvzLZFEvbqOi35Sc7EQLrSpgk5O3XgG5nP9dQ5GkwmP3yDQ+1IzTLjl362LS4Da00YfNWv7gmhvvsi1LwLIHfgeTYsZCA8Af4bNU5Dz5gJImYg/2DCqHGead0bYgZoL3hlVMu0lnmQPAPhEzBvVIeMJ0tG9SgyXMnEJkZZpE/LDJRL0elNbpXcsoQt4GWRg6cNv6lY4KFWytNCVQYcA9QsZuDq9HktAAAAAElFTkSuQmCC"/>
                                </svg></span>
                                    <?=current($post_meta['place'])?>
                            </p>
                            <?php } ?>
                                <p class="carousel-title"><?=$post->post_title?></p>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="mobile carousel-mobile">
        <div class="footer-partner">
            <div class="col-md-12 col-lg-12 col-sm-12 carousel-events-main">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" style="background-color: black;" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" style="background-color: black;" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" style="background-color: black;" data-slide-to="2"></li>
                        <li data-target="#carouselExampleIndicators" style="background-color: black;" data-slide-to="3"></li>
                    </ol>
                    <div class="carousel-inner" style="height: 170px;">
                        <?php 
                        $arguments = [
                            'numberposts' => 4,
                            'offset' => 0,
                            'order' => 'DESC',
                            'category_name' => 'events'
                        ];

                        $Posts = get_posts($arguments);
                        foreach( $Posts as $key => $post ){ 
                            $url = get_permalink( $post );
                            $post_meta = get_post_meta($post->ID); ?>
                            <div class="carousel-item carousel-content <?=$key == 0 ? 'active' : ''?>">
                                <?php
                                $date_start_post = explode(' ', current($post_meta['date_start_event']));
                                $date_start_day = explode('-', $date_start_post[0]);
                                $date_start_month = Basket::getRussianMonth( (int) $date_start_day[1]);
                                $period_date = false;

                                if( isset($post_meta['date_end_event']) && $post_meta['date_end_event'][0] != "" ){
                                    $date_end_post = explode(' ', current($post_meta['date_end_event']));
                                    $date_end_day = explode('-', $date_end_post[0]);
                                    $date_end_month = Basket::getRussianMonth( (int) $date_end_day[1]);
                                    $period_date = true;
                                }

                                if( $period_date ){ ?>
                                    <p class="date-event-time"><?=$date_start_day[2]?> <?=$date_start_month?> <i class="fa fa-minus" aria-hidden="true"></i> <?=$date_end_day[2]?> <?=$date_end_month?></p>
                                <?php }else{ ?>
                                    <p class="date-event-time"><?=$date_start_day[2]?> <?=$date_start_month?> </p>
                                <?php }
                                if( isset( $post_meta['place'] ) || $post_meta['place'] != "" ){ ?>
                                    <p class="date-event-place-mobile" style="padding-top:10px;">
                                    <span style="padding-right: 10px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="12" height="15" viewBox="0 0 12 15">
                                            <image id="noun_Map_2339479_1A1A1A_copy" data-name="noun_Map_2339479_1A1A1A copy" width="12" height="15" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAeCAYAAAA2Lt7lAAAB+ElEQVRIia2W30sUURTHP24L2suq5YOw0UOCYBBlWo8i+NCDmX9CUP9YWFAIBpHYSyLSD0GUrBelSFR20yDzR1BPtnLgjPfOnHvHwfUDF5bvPfd8Z2fOzDktjUaDHC4B14Cq/r6oof+A30AN+A7sx1LEDC4Dw8ANsxPmMzAXMgoZDACjQCmYKs4R8BpYyTMY1tUMs8C75Lx/lQPnkFwYAfqzBh3AmAk9O+NAxTd4UDDXX11FEBPKQKeWYh5fgEXgJyAPrRu4A9zMOdMjpS0GfWYrzVvgfUar6doB7pkTjuslfYlibASS+ywA60Z1VEv6gGN8iOg+H43iaBeDNiM79oxi2TWKo7Wkb2CM1ojuk3eBR2JwYGTHLaNY+o3i+CMGP4zskFK8alTHFeCuUR3bYrBq5DSPgEHggqfKudvAYxOdZrWstfwL6DLbjvvAkMaiL1rFRKWRflFPPhVvzLZFEvbqOi35Sc7EQLrSpgk5O3XgG5nP9dQ5GkwmP3yDQ+1IzTLjl362LS4Da00YfNWv7gmhvvsi1LwLIHfgeTYsZCA8Af4bNU5Dz5gJImYg/2DCqHGead0bYgZoL3hlVMu0lnmQPAPhEzBvVIeMJ0tG9SgyXMnEJkZZpE/LDJRL0elNbpXcsoQt4GWRg6cNv6lY4KFWytNCVQYcA9QsZuDq9HktAAAAAElFTkSuQmCC"/>
                                        </svg>
                                    </span>
                                    <?=current($post_meta['place'])?>
                                    </p>
                                <?php } ?>
                                <p class="carousel-title"><?=$post->post_title?></p>
                            </div>
                        <?php } ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev"></a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next"></a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<div class="container">
    <div class="row">
        <div class="main-block">
            <?php if( isset($page_data_meta['right_block']) && current($page_data_meta['right_block']) == 1 ) { ?>
                <div class="row row-block">
                    <div class="col-md-12 col-lg-9 col-sm-12 col-block">
                        {{body}}
                    </div>
                    <div class="col-md-3 col-lg-3 events-right-block">
                        <div class="col-md-12 col-lg-12 col-sm-12 news-mini-block">
                            <?php if( $page == 'events' )
                                echo '<span class="right-block-name">Новости</span>';
                            else
                                echo '<span class="right-block-name">События</span>';
                            ?>
                        </div>
                        <?php
                        if( $page == 'events' ){

                            $Posts = get_posts(['category_name' => 'news']);?>

                            <div class="events-list">
                                <?php foreach( $Posts as $post ){ 
                                    $url = get_permalink($post); 
                                    $post_meta = get_post_meta($post->ID); ?>
                                    <div class="col-md-12 col-lg-12 col-sm-12 news-mini-block-one mouse-hover-class-one-event-right">
                                        <a href="<?=$url . $post->ID?>">
                                            <p class="date-event-right"><?=Basket::getCurrentDate($post->post_date) ?></p>
                                            <p class="place-event"><i class="fa fa-map-marker" aria-hidden="true"></i> <?= isset($post_meta['place']) ? current($post_meta['place']) : '-' ?></p>
                                            <p class="font-right-title"><?=$post->post_title?></p>
                                            <?php if( $page == 'events' ) { ?>
                                                <span class="learn-more">Подробнее</span>
                                            <?php } ?>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } 
                            
                        else{
                            $Posts = get_posts(['category_name' => 'events']); ?>

                            <div class="events-list">
                                <?php foreach( $Posts as $post ){ 
                                    $url = get_permalink($post);  

                                    $post_meta = get_post_meta($post->ID); ?>
                                    <div class="col-md-12 col-lg-12 col-sm-12 news-mini-block-one mouse-hover-class-one-event-right">
                                        <div>
                                            <?php
                                            $date_start_post = explode(' ', current($post_meta['date_start_event']));
                                            $date_start_day = explode('-', $date_start_post[0]);
                                            $date_start_month = Basket::getRussianMonth( (int) $date_start_day[1]);
                                            $period_date = false;

                                            if( isset($post_meta['date_end_event']) && $post_meta['date_end_event'][0] != "" ){
                                                $date_end_post = explode(' ', current($post_meta['date_end_event']));
                                                $date_end_day = explode('-', $date_end_post[0]);
                                                $date_end_month = Basket::getRussianMonth( (int) $date_end_day[1]);
                                                $period_date = true;
                                            }

                                            if( $period_date ){ ?>
                                                <p class="date-event-right"><?=$date_start_day[2]?> <?=$date_start_month?> <i class="fa fa-minus" aria-hidden="true"></i> <?=$date_end_day[2]?> <?=$date_end_month?></p>
                                            <?php }else{ ?>
                                                <p class="date-event-right"><?=$date_start_day[2]?> <?=$date_start_month?> </p>
                                            <?php } ?>
                                            <p class="place-event"><i class="fa fa-map-marker" aria-hidden="true"></i> <?= isset($post_meta['place']) ? current($post_meta['place']) : '-' ?></p>
                                            <p class="font-right-title"><?=$post->post_title?></p>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php }?>
                            

                        <div class="col-md-12 col-lg-12 col-sm-12 more_margin_top col-main-block btn_more_pag">
                            <a class="all-news" href="/<?=$page == 'events' ? 'news' : 'events'?>/"><button class="btn_learn_more">Все <?=$page == 'events' ? 'новости' : 'события'?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button></a>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-md-12 col-lg-12 col-sm-12">
                    {{body}}
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- aaa -->