<!-- <span class="page-header-text">События</span> -->
<!-- <span style="color: #fff; position: absolute; top: -50px; font-size: 250%;">События</span> -->
<div class="col-md-12 col-lg-12 col-sm-12 page-name-header-news col-main-block">
    <span>События</span>
</div>

<div class="container">
    <div class="row news-block body-block-news">
    <?php 
    $return = Events::getEvents(); 
    echo $return['content'];
    ?>
    </div>
    <?php if( $return['count_offset'] >= 5 ) { ?>
    <div class="col-md-12 col-lg-12 col-sm-12 news-mini-block-all" style="padding-left:20px; padding-right:0px !important;">
        <a class="all-news"><button class="more-news btn_learn_more btn_more_pag" data-url="<?php echo admin_url("admin-ajax.php") ?>" data-href="Events/getEvents" data-offset="5">Показать еще</button></a>
    </div>
    <?php } ?>
</div>