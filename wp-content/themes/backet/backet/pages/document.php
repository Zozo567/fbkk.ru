<!-- <div class="header_news col-md-12 col-lg-12 col-sm-12"  style="background-image: url(<?php //echo get_template_directory_uri(); ?>/assets/images/Rectangle_1_copy_2.png);">
    <h2 style="color: #fff;">Новости</h2>
</div> -->
<!-- 
<div class="adap-header-federation">
    <span class="page-header-text-federation"><a href="/federation">О федерации</a></span>

    <div class="page-nav-federation">
        <a href="/guidance"> Руководство</a>
        <a class="federation-active" href="/document">Документы</a>
        <a href="/contact">Контакты</a>
    </div>
</div> -->

<div class="container">
    <div class="season_games competition_document_season body-block-news">
        <?php
        $return = Document::getDocuments(); 
        echo $return['content']; 
        ?>
    </div>
</div>