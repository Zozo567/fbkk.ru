<!-- <div class="header_news col-md-12 col-lg-12 col-sm-12"  style="background-image: url(<?php //echo get_template_directory_uri(); ?>/assets/images/Rectangle_1_copy_2.png);">
    <h2 style="color: #fff;">Новости</h2>
</div> -->

<!-- <span class="page-header-text">Новости</span> -->
<div class="col-md-12 col-lg-12 col-sm-12 page-name-header-news col-main-block">
    <span>Новости</span>
</div>
<div class="custom_container">
    <div class="row news-block body-block body-block-news">
    <?php
        $return = News::getNews(); 
        echo $News = $return['content']; ?>
    </div>
    <?php if( $return['count_offset'] >= 9 ) { ?>
    <!-- <div class="col-md-12 col-lg-12 col-sm-12 news-mini-block-all">
        <button class="btn btn-outline-primary initialism btn-href more-news" data-url="<?php echo admin_url("admin-ajax.php") ?>" data-href="News/getNews" data-offset="9">Показать еще</button>
    </div> -->
    <div class="col-md-12 col-lg-12 col-sm-12 news-mini-block-all">
        <a class="all-news"><button class="more-news btn_learn_more" data-url="<?php echo admin_url("admin-ajax.php") ?>" data-href="News/getNews" data-offset="9">Показать еще</button></a>
    </div>
    <?php } ?>
</div>