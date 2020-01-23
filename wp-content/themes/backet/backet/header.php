<?php
$version = strtotime(date("Y-m-d-H"));
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Федерация баскетбола Краснодарского края</title>
    
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css?<?=$version?>"/>
    
    <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i,600|Montserrat:200,300,400" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/bootstrap.css?<?=$version?>">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/ionicons/css/ionicons.min.css?<?=$version?>">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/law-icons/font/flaticon.css?<?=$version?>">

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/fontawesome/css/font-awesome.min.css?<?=$version?>">

    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css?<?=$version?>"> -->
    <!-- Bootstrap core CSS -->
    <link href="<?php echo get_template_directory_uri(); ?>/assets/css/bootstrap.min.css?<?=$version?>" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="<?php echo get_template_directory_uri(); ?>/assets/css/mdb.min.css?<?=$version?>" rel="stylesheet">

    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/style.css?<?=$version?>">

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css?<?=$version?>">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/assets/slick/slick.css?<?=$version?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/assets/slick/slick-theme.css?<?=$version?>"/>

    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/bootstrap.js?<?=$version?>"></script>

    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery-3.4.1.min.js?<?=$version?>"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js?<?=$version?>"> </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js?<?=$version?>"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css?<?=$version?>"/>

    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/bootstrap.min.js?<?=$version?>"></script>
   
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.waypoints.min.js?<?=$version?>"></script>
    <!-- <script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.easing.1.3.js?<?=$version?>"></script> -->
    <!-- <script type="text/javascript" src="<?php echo get_template_directory_uri();?>/assets/slick/slick.min.js?<?=$version?>"></script> -->

    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/mdb.min.js?<?=$version?>"></script>

    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/magnific-popup.css?<?=$version?>">

    <!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.magnific-popup.min.js?<?=$version?>"></script>

    <!-- Magnific Popup core JS file -->
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.magnific-popup.js?<?=$version?>"></script>

    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/server.js?<?=$version?>"></script>

    <script src="https://reg.infobasket.ru/Widgets/Scripts/Widgets.js?<?=$version?>" type="text/javascript"></script>

    <!-- <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/assets/slick/slick.css?<?=$version?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/assets/slick/slick-theme.css?<?=$version?>"/> -->

    <script type="text/javascript" src="<?php echo get_template_directory_uri();?>/assets/slick/slick.js?<?=$version?>"></script>
    <!-- <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js?<?=$version?>"></script> -->

    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/jqlight.lazyloadxt.min.js?<?=$version?>"></script>

    <?php wp_head(); ?> 
				
</head>

<body <?php body_class(); ?> data-spy="scroll" data-target="#pb-navbar" data-offset="200">

<div class="navbar fixed-top white scrolling-navbar check-top">
    <div class="info-block-head">
        <div class="header_menu">
            <div class="container h-100" >
				<div class="row h-100 justify-content-center align-items-center">
				    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="left_top_header">
                            <a href="/federation" class="pb_font-9">
                                Узнать больше о Федерации
                            </a>
                            <?php 
                            $social_networks = [
                                'vk' => 'https://vk.com/',
                                'instagram' => 'https://www.instagram.com/',
                                'youtube' => 'https://www.youtube.com/',
                            ];
                            
                            $main_category = get_page_by_path('main');
                            
                            foreach( $social_networks as $social_network => $social_network_item ){
                                if( isset(get_post_meta($main_category->ID)[$social_network]) )
                                    $social_url[$social_network] = current(get_post_meta($main_category->ID)[$social_network]);
                                else
                                    $social_url[$social_network] = $social_network_item;
                            }
                            ?>
                            <a href="<?=$social_url['vk']?>" class="p-2 top_header"><i class="fa fa-vk"></i></a>
                            <a href="<?=$social_url['instagram']?>" class="p-2 top_header"><i class="fa fa-instagram"></i></a>
                            <a href="<?=$social_url['youtube']?>" class="p-2 top_header"><i class="fa fa-youtube"></i></a>
                            <div class="a_hover_svg" style="display:inline-block;">
                                <a class="base_icon" href="https://russiabasket.ru/" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="72" height="24" viewBox="0 0 36 12" style="padding-top:5px;">
                                        <image id="logo" width="15" height="8" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEgAAAAYCAYAAABZY7uwAAAEaklEQVRYhb2YW2wWVRCAv0qFWjFeUFEbJV6iVqjFCwQR5UHBB7APBo0SETSV6ItP6pPG+KImXhM10cQHTTQqAR7QRCSCQbykUaqUIl4IETBRiwGVEk2xjhl2fnvYObv//rs/fsn5dzNnzuzZ+c+ZmbMtItIFnAd0AscDE4Dj7L4NGA+MAgeBfcAwsB7YAvxBdeYCb0asPAC84aT1uR5YBPxTcmYtdn0M2IOIbJNyDInIMyIyWUSo0GZnPH1pSZt3OUvlmKr2dAW9DCx3fizOr8AdwHsFR0wBLgGuAqYBHcBMpwVbgR3ATmCT3W9zWp45pl+FIdtVB9XjDzfJ49Mj/2bY5ovIahE54EYWZ6OI9EZsh21KxWcoa2v29GeR6y7HpshktXWIyKomPaPGZhGZFXlWrfW7EY2xomar1bZIjCeAj4AR4C/gbOByYClwekR/jm2ZwUCmW2kDMNlpV0Pn8ZkF41URSyNOAp8AzwPHWMuiHfjyvz4RmZfh28NBKtJOE5HtTjthcaB/koj85jSaT3dkjp9HnvJsRK9uy/PkmU6SsBd4zUkTOoJ7Df4nOo0x3gZuBx50PQlPAbcCrwB/ut4x3nKSOG1RaR3yHJTH+IzOUbteBNziehO2A1fYy2uds85pJPSZE++2rfuh00i4GLjBST0TgVOt3rvSsugM4BynGdDqJGPsdpIEjUXLnDRhl117XE/Cz1YY7g1kZzithEnBvab664CvgEudJiwA3nfSI7kJmGfxsyXoGTb7+r4rgRXhis1bQfrPqcFu8/pC4CFgADjXaSf02XWa60l4MuWcRhDg0Qz92U7iabdk0ZLqmWhO1/d71eqvhbXOvBV0vzVscmnDaXQ7/GiyTtebkLWdiqLbbD9wcko/d5s0yPnAO8BtGt/yVlBIPefoGe0+J/WUPR/VONQEG0XR8+FZeSuoKLstBgwFA76xAJhmFvC1kxanOxWbavzgJJ4RO66M2h8utoOyVrvSWzaLKQeAFywjDab6spygJ/RxTlqcRzI0P3USz2pgqsWbLrtqITvdCsgY1+StoC8s60wyT+vy/t1iwBqb1B43KuFd4HEnTVKyVtZ3WubAnhFjXyDTmPO0JY0YayKyNPudJGGLhYdO+1QS0pXnoHvNSWUYtEB3Y2TstXYq1wLvg1RxGTLTtoJel2Qcb7AX3OCknglOciRbIw4al+egE5ykMXotPsUm1ma1VFY9RZBB67G4Tn+NYScZoz3jz/w2z0FVYgUWtOfav9vueptDT068S6Px5zIL0qMWpE+xFa0r9AI3AvrzHNQM+iwIvpgTP8qgW/8eYHMDY7US73fSfArXQVX4HpgP3GxfHQ9VsPWxVfgzGnROGV7XRHS0V1DISmsXWrvaDrX1Prlqptxo9wNO6+jNdcnhu5wvij0VP8YXbc3+aK/tF2etGAMisjy01Wop9yULWjU0vX73P/1bxwI/ReR/V7D5nK1OfT/NmJpJ9apNk4++n9rXRKIrVL+qrnVlDfAvUdC/nLiifQYAAAAASUVORK5CYII="/>
                                    </svg>
                                </a>
                                <a class="hover_icon" style="display:none;" href="https://russiabasket.ru/" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="72" height="24" viewBox="0 0 36 12" style="padding-top:5px;">
                                        <image id="logo" width="15" height="8" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEgAAAAYCAYAAABZY7uwAAAEgklEQVRYhb2ZWWwWVRTHf60NNE1dUdAQNUaDUDY3iICBB7cHFSNBg0ZRE030xcS4PBmNT2oqvKgPLjEaNaIiD0g0GsSIiqmAWlo3QMIiidJEXHBJsWJO73/sOGfmzvfNFH/JZL6ee+7MnXPPPefc25aBCd1nAqcDk4AOYCzQrt92HwMMAb8BPwEHgPVAP/Ar9ZkHPJPzlPuB15y0nAXAlcDfFUfWovtyYG8bsAI4y6mVMwC8CDwC/FDDTIeAyU4aJqgKNtl31hhPwrOJgXoqGugEDeQGYCnwltPI51SgC5gDTAMm5mrBXfKEHcAHwHbgC6fl2eokzbMP2Gm9zEDf1nzY8cCbwNnA5651hEuA24CLgU7X6pmuCxkLLe0XCpZkwh6FgUbeUcRnCim0At8UKDXLYwUdzENeB94Grqo58PnA08Bm4HzXGtgFbHPS5vgl0TYP+rGg68OasUHgT+Bk4BzgRmC804YLtGT6UzJbSuuACU67HjaOj4HFMn6WQSeBjzSJrbqK6JAH/WugtgJFC8DZNW8BvVuGywusM1IGOgbYABzttEaPlYqfvZknHpHzho3AK05aQsySJzlJwLLX804aSAfcJ0uMY4O9HrjXtQQeBZYo3vzhWkdY4ST5tOdKS4gZKMaYgsYh3a22usa1Br4CztXHvwS84zQCPTLirVq67zmNgHnypU7q6VRCmQKcpyw6CzjFaaYoWl7GbicJWCy6yUkDu3Rf6FoC36uQG0jJTnRagXGp35bqL1SWnOE04TIlgRiLlEHHp4pBlPF26Httyb6a9tiYB9nM2QNnyuqXA/cBW4DTnHagR/dpriXQnTFOM1hB+WCB/lwn8XQoWbRkWjpldPu+54A+/R4m5kF360KDyz44iy2H7ySb4loDRcupUWyZ7QeOzehHl0mTWCX+BnCtxbeYB6UpM46VCnc4qafq/ijh4Cg8o1FetuUf86BG2a0YsC/V4WsFwCxW3H3ppI0zMxObEnY6iWdQ25UhTfghraAibzeWVs1iaCf/uDJSf6atyAj3FNQojfJAgd4GJ/GsAqYq3kzXvUt1VNEuYE7MgzYp64yTpc29f1YMWK1B7XG9AmuAh5w0pGSrrG9W5kDvyCNd4VvMWaakkcfqHFmW/U4S6FV4ME+6KNPWFTPQ7TJSFfoV6K7I6TtfFboVeGsju/nZWgqzdWKQt71BH7jOST1jneS/9OUYqDVmoCOdpDluUXzKG1i7aqmieopUBi3jupL2hANOMkJHwWRujxmoTqxAQXuBZrfq4VcZCyPxLstUHckM6bIgfZw82jz0DNcDemMGGg2Sw7gnIvGjCpt0trS5ib5WiX/qpHFW1clijbJNh2VX69TxYI1nfagKf1aTxqmCnWZ8EjvuGG1W6pqka542tRMViLP0qW6xTPm+fm9xWodvrLbsho1zlGsOHK64sVXXGv09V4dZWZZFjlXKqLr16FNt91QiaNOsLFfQSmjRscT/gb3LKu8sv9d4uZ2GWtC170v+dWV3y6iWfOydf2njvFc117vpk8RhgH8AtuzYwSlpvOwAAAAASUVORK5CYII="/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="top-menu">
        <div class="container">
            <div class = "row">
                <div class="col-lg-3 col-md-12 col-sm-12 desctop-lg-head">
                    <a class="navbar-brand head-logo" href="/"><img class=" img-fluid" src="<?=get_template_directory_uri()?>/assets/images/logo.png" style="width: 50px; height: 50px;" alt="Logo">
                        <ul class="dop_ul">
                            <li class="first">Федерация баскетбола</li>
                            <li class="second">Краснодарского края</li>
                        </ul>  
                    </a>
                </div>
                <!-- <div class="col-sm-2 col-md-2 col-lg-2 desctop-md-head">
                    <a class="navbar-brand head-logo" href="/"><img class=" img-fluid" src="<?=get_template_directory_uri()?>/assets/images/logo.png" style="width: 50px; height: 50px;" alt="Logo">  
                    </a>
                </div> -->

                <div class="col-lg-9 col-md-12 col-sm-12 nav-head-menu desctop-lg-head">
                    <!-- <div class="container"> -->
                        <div class="row justify-content-center align-items-center">
                            <ul class="nav-menu">
                                <?php wp_nav_menu( array(
                                    'menu_class'=>'',
                                    'theme_location'=>'top',       
                                    'menu' => 'top-menu-mega'
                                ) ); ?>
                            </ul>
                        </div>
                    <!-- </div> -->
                </div>
                <div class="col-md-12 col-lg-12 col-sm-12 nav-head-menu desctop-md-head">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-sm-1">
                            <a class="navbar-brand head-logo" href="/"><img src="<?=get_template_directory_uri()?>/assets/images/logo.png" style="width: 50px; height: 50px;" alt="Logo"></a>
                        </div>
                        <div class="col-lg-11 col-md-11 col-sm-11">
                            <div class="row justify-content-center align-items-center">
                                <ul class="nav-menu">
                                    <?php wp_nav_menu( array(
                                        'menu_class'=>'navbar mr-auto',
                                        'theme_location'=>'top',       
                                        'menu' => 'top-menu-mega'
                                    ) ); ?>
                                    <li class="helper"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mobile-header">
                    <div class="row mobile-block-head">
                        <a id="click-menu" class="icon" href="#">&#9776;</a>
                        <a class="navbar-brand head-logo" style="padding-top: 0px !important;" href="/"><img class=" img-fluid" src="<?=get_template_directory_uri()?>/assets/images/logo.png" style="width: 50px; height: 50px;" alt="Logo">
                            <ul class="dop_ul">
                                <li class="pb_font-11">Федерация баскетбола</li>
                                <li class="pb_font-11">Краснодарского края</li>
                            </ul>  
                        </a>
                    </div>
                    <div class="vary" id ="myTopNav">
                        <ul class="mobile-menu">
                            <?php wp_nav_menu( array(
                                'menu_class'=>'navbar mr-auto',
                                'theme_location'=>'top',       
                                'menu' => 'top-menu-mega'
                            ) ); ?>
                            <li class="helper"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- <?php wp_nav_menu( array(
	'menu_class'=>'navbar mr-auto',
    'theme_location'=>'top',       
	'menu' => 'top-menu'
) ); ?> -->

