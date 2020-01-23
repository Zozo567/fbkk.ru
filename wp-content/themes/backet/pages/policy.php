<?php
$url = $_SERVER['REQUEST_URI'];
$url = explode('/', $url);
$page = get_page_by_path( $url[1] );
?>
<div class="col-md-12 col-lg-12 col-sm-12 title-note" style="padding-bottom:25px;">
    <span><?= $Post->post_title ?></span>
</div>
<div class="col-md-12 col-lg-12 col-sm-12">
    <?php $content = apply_filters( 'the_content', $Post->post_content ); ?>
    <span><?=$content ?></span>
</div>