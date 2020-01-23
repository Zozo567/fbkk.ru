<!-- <div class="header_news col-md-12 col-lg-12 col-sm-12"  style="background-image: url(<?php //echo get_template_directory_uri(); ?>/assets/images/Rectangle_1_copy_2.png);">
    <h2 style="color: #fff;">Новости</h2>
</div> -->
    <!-- <div class="adap-header-federation">
        <span class="page-header-text-federation"><a href="/federation">О федерации</a></span>

        <div class="page-nav-federation">
            <a href="/guidance"> Руководство</a>
            <a href="/document">Документы</a>
            <a href="/contact">Контакты</a>
        </div>
    </div> -->
<!-- <div class="test-block">
    <div class="row">
        <div class=" col-md-12 col-lg-12 col-sm-12">
            <span style="text-align:center;" class="page-header-text">О федерации</span>
        </div>
    </div>
</div> -->


<div class="container">
    <div class="row body-block body-block-news">
    <?php
        $return = Federation::getFederation(); 
        echo $News = $return['content']; ?>
    </div>
</div>