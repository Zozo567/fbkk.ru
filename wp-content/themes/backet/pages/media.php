<!-- <span class="page-header-text">Медиа</span> -->
<span style="color: #fff; position: absolute; top: -50px; font-size: 250%;">Медиа</span>

<div class="container">
    <div class="row news-block body-block body-block-news">
    <?php 
    $return = Media::getMedia();
    echo $return['content'];
    ?>
    </div>
    <?php if( $return['count_offset'] >= 4 ) { ?>
    <div class="col-md-12 col-lg-12 col-sm-12 news-mini-block-all media-more">
        <a class="all-news"><button class="more-news btn_learn_more" data-url="<?php echo admin_url("admin-ajax.php") ?>" data-href="Media/getMedia" data-offset="4">Показать еще</button></a>
    </div>
    <?php } ?>
</div>