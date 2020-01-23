<div class="mobile">
    <div class="container">
        <div class="row footer-partner">
            <div class="col-md-12 col-lg-12 col-sm-12" style="margin-top: 20px;">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" style="background-color: black;" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" style="background-color: black;" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" style="background-color: black;" data-slide-to="2"></li>
                        <li data-target="#carouselExampleIndicators" style="background-color: black;" data-slide-to="3"></li>
                    </ol>
                    <div class="carousel-inner" style="text-align: center; height: 170px; vertical-align: middle;">
                        <div class="carousel-item active" style="margin-top: 10px;">
                            <a href="https://lokobasket.com" target="_blank">
                                <img class="img-fluid" src="<?=get_template_directory_uri()?>/assets/images/partners/1_loko@2x.png" width=200px; height=200px; alt="Logo">
                            </a>
                        </div>
                        
                       
                            <div class="carousel-item" style="margin-top: 15px;">
                            <a href="http://russiabasket.ru" target="_blank">
                                <img class="img-fluid" src="<?=get_template_directory_uri()?>/assets/images/partners/2_rfb@2x.png" width=200px; height=200px; alt="Logo">
                            </a>
                            </div>
                        
                        
                            <div class="carousel-item" style="margin-top: 10px;">
                            <a href="https://admkrai.krasnodar.ru/" target="_blank">
                                <img class="img-fluid" src="<?=get_template_directory_uri()?>/assets/images/partners/3_adminkr@2x.png" width=200px; height=200px; alt="Logo">
                                </a>
                            </div>
                        
                        
                            <div class="carousel-item" style="margin-top: 10px;">
                            <a href="https://kubansport.krasnodar.ru/" target="_blank">
                                <img class="img-fluid" src="<?=get_template_directory_uri()?>/assets/images/partners/4_minsportkrai@2x.png" width=200px; height=200px; alt="Logo">
                                </a>
                            </div>
                        
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev"></a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next"></a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="container">
        <div class = "row">
            <div class="col-md-12 col-lg-12 col-sm-12 info-block">
                    <span class="">© 2019 Федерация баскетбола</span><br>
                    <span class="">Краснодарского края. Все права защищены</span>
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 info-block">
                <a href="/policy">Политика в отношении обработки персональных данных | </a> 
                <a href="/cookie">Cookie-файлы</a>
            </div>
        </div>
    </div>
</div>

<div class="desctop">
    <footer class="" role="contentinfo">
        <div class="container">
            <div class="row footer-partner">
                <div class="col-md-3 col-lg-3 col-sm-3">
                    <a href="https://lokobasket.com" target="_blank">
                        <div class="container-fluid">
                            <div class="row-fluid">
                                <div class="centering">
                                    <img class="img-fluid" src="<?=get_template_directory_uri()?>/assets/images/partners/1_loko.png"  alt="Logo">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- test commit-->
                <div class="col-md-3 col-lg-3 col-sm-3">
                    <a href="http://russiabasket.ru" target="_blank">
                        <div class="container-fluid">
                            <div class="row-fluid">
                                <div class="centering">
                                    <img class="img-fluid" src="<?=get_template_directory_uri()?>/assets/images/partners/2_rfb.png"  alt="Logo">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3">
                    <a href="https://admkrai.krasnodar.ru/" target="_blank">
                        <div class="container-fluid">
                            <div class="row-fluid">
                                <div class="centering">
                                    <img class="img-fluid" src="<?=get_template_directory_uri()?>/assets/images/partners/3_adminkr.png"  alt="Logo">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3">
                    <a href="https://kubansport.krasnodar.ru/" target="_blank">
                        <div class="container-fluid">
                            <div class="row-fluid">
                                <div class="centering">
                                    <img class="img-fluid" src="<?=get_template_directory_uri()?>/assets/images/partners/4_minsportkrai.png"  alt="Logo">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <hr>
        <div class="container">
            <div class = "row footer-container">

                <div class="col-md-2 col-lg-2 col-sm-2">
                    <div class="container-fluid">
                        <div class="row-fluid">
                            <div class="centering logo-block">
                                <img class="img-fluid " src="<?=get_template_directory_uri()?>/assets/images/Logo_FBKR.png" style="width: 80px; height: 80px;" alt="Logo">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 col-lg-2 col-sm-2">
                <?php wp_nav_menu( array(
                    'theme_location'=>'bottom',       
                    'menu' => 'footer-menu-left'
                ) ); ?>
                </div>
                
                <div class="col-md-2 col-lg-2 col-sm-2">
                    <?php wp_nav_menu( array(
                        'theme_location'=>'bottom',       
                        'menu' => 'footer-menu-center'
                    ) ); ?>
                </div>

                <div class="col-md-2 col-lg-2 col-sm-2">
                    <?php wp_nav_menu( array(
                        'theme_location'=>'bottom',       
                        'menu' => 'footer-menu-right'
                    ) ); ?>
                </div>

                <div class="col-md-4 col-lg-4 col-sm-4">
                    <div class="container info-block">
                        <div class="row">
                            <span class="">350900, Россия г. Краснодар,</span>
                            <span class="">ул. Яхонтовая/им. Соколова М.Е., 2/74,</span>
                            <span class="">2 этаж,офис 2</span>
                        </div>
                        <br>
                        <div class="row">
                            <div class="container">
                                <div class="row">
                                    <span>8(861)273-98-09</span>
                                    <span>info@fbkk.ru</span>
                                </div>
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
                                <div class="row">
                                    <a href="<?=$social_url['vk']?>" class="footer-icon-social"><i class="fa fa-vk"></i></a> 
                                    <a href="<?=$social_url['instagram']?>" class="footer-icon-social"><i class="fa fa-instagram"></i></a> 
                                    <a href="<?=$social_url['youtube']?>" class="footer-icon-social"><i class="fa fa-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="container">
            <div class="left info-block">
                <span class="">© 2019 Федерация баскетбола</span>
                <span class="">Краснодарского края. Все права защищены</span>
            </div>
            <div class="right info-block">
                <a href="/policy">Политика в отношении обработки персональных данных | </a> 
                <a href="/cookie">Cookie-файлы</a>
            </div>
        </div> -->
        <div class="footer-politic-block">
            <div class="container h-100">
                <div class="row h-100 justify-content-center align-items-center">
                    <div class="col-md-6 col-lg-6 col-sm-6 left">
                        <span class="foot-desctop-span-info">© 2019 Федерация баскетбола</span>
                        <span class="foot-desctop-span-info">Краснодарского края. Все права защищены</span>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-6 right">
                        <a class="foot-desctop-span-info" href="/policy">Политика в отношении обработки персональных данных | </a> 
                        <a class="foot-desctop-span-info" href="/cookie">Cookie-файлы</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>
    
    <!--<loader 
    <div id="pb_loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#FDA04F"/></svg></div> -->

<?php wp_footer(); ?>

</body>
</html>