<?php
$page = explode('/', $_SERVER['REQUEST_URI']);
$note_id = $page[3];
$Post = get_post($note_id);

$category = get_the_category($Post->ID);
$post_meta = get_post_meta($Post->ID);

$NOneed_post_thumbnail_url = [
    'projects',
];

$social_networks = [
    'vk' => 'https://vk.com/',
    'facebook' => 'https://www.facebook.com/',
    'whatsapp' => 'https://www.whatsapp.com/',
];

$main_category = get_page_by_path('main');

foreach( $social_networks as $social_network => $social_network_item ){
    if( isset(get_post_meta($Post->ID)[$social_network]) )
        $social_url[$social_network] = current(get_post_meta($Post->ID)[$social_network]);
    else if( isset(get_post_meta($main_category->ID)[$social_network]) )
        $social_url[$social_network] = current(get_post_meta($main_category->ID)[$social_network]);
    else
        $social_url[$social_network] = $social_network_item;
}

?>
<div class="container">
    <div class="row news-block body-block body-block-news" style="padding-right:20px;">
        <div class="col-md-12 col-lg-12 col-sm-12 title-note col-main-block" style="padding-bottom:25px;">
            <span><?= $Post->post_title ?></span>
        </div>
        <?php
        if ( !in_array($category[0]->slug,$NOneed_post_thumbnail_url) )
        {?>
            <div class="col-md-12 col-lg-12 col-sm-12 date-social-note col-main-block">
                <div class="row">
            <!-- <div class="left"> -->
                    <div class="col-md-9 col-lg-9 col-sm-12 col-12">
                        <span>
                        <?php
                        
                        echo Basket::getCurrentDate($Post->post_date);

                        if( isset( $post_meta['place'] ) && $post_meta['place'][0] != "" )
                            echo ' <span class="place-event"><i class="fa fa-map-marker icon-pad" aria-hidden="true"></i> '. current($post_meta['place']) .'</span>';
                        else
                            echo '';
                        ?>
                        </span>
                    </div>
                    <?php 
                    $share_url = $_SERVER['REQUEST_SCHEME'] .'://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                    ?>
                    <div class="col-md-3 col-lg-3 col-sm-12 col-12 d-flex justify-content-end col-main-block">
                    <!-- <div class="right"> -->
                        <a href="https://vk.com/share.php?url=<?=$share_url?>&title=<?=$Post->post_title?>&image=<?=get_the_post_thumbnail_url($Post->ID)?>" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="30" viewBox="0 0 40 30">
                                <image id="vk-social-network-logo_copy_2" data-name="vk-social-network-logo copy 2" width="40" height="30" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAAA8CAYAAADxJz2MAAAEtUlEQVR4nO2ce2xTVRzHv/e2pVu7raVsDBiOKB3IZG74YhtmCH+obCMmIL5jzJA/TNT4h6Ixxgyj//iH8S9iDJEZ1MzgKwgCijogcwHFzFmckzkE58Z47MFot64vc+64rOu57WrPubcMz2dpun7vuafnfM/rd85dJlVvbuwC4IQgFQbNAOYBsAr7UsImA7BMw4JfLViIgUP/dxcYGJKnbdGvEoSBjAgDGREGMiIMZEQYyIgwkBFhICPCQEaEgYwIAxkRBjIiDGREGMiIWdfMTePtI0nkJcEkSRgZC1LpCJVL56PipgLkOW3IsVlhsZgQiUTgGw2gb8CLg62n8YOnm7ovHup3mmUZY8FQnFQc6kgpnNhSV4Ub5jkhS5JSEfJukiVc9Pnx1sdHcPyv8xOFMMmorXSjdGG+5pcXzXfhzpLr8ED9Z/COBKjriwtn4bn778AMiwyJ/KgNJktK3h1/96N++yHqPh7oNoTdBTPhys6EMysDDrsV2bYZsGVYMMeVhRcerpiUNhQO4+V3m/DOrp+pfKIpyM2mNMKm2jIU5ucoeee77Jg90670ZFdOJnLsViy9Po+6hxe6Gbjjaw+lqZDKkV6lEomM//Jl84m4Q5wQDIUpjeS1ZEEupUdz6JfTlMYL3Qw88NNJ+APx557H7ymhNEJfv5fSVEb9tLkbVi2htFg+SNCYrOhmIOkt+478Sekqtyyaowy5WMiioQVZUEZjGsRqMaGm3K2ReoKdTe3oHx6hdF7oGsY0fvcbpUWzsaaU0kLhCKWpejjm2pO1y6h00Zwd8KJhbxul80RXAy96/dh/tIvSVUjoQuawaCxm7SKRHh09B86dlYXq8oVUumjqGw5TGm+0S8uR9/cl7gHPrr990meyamoRiVlEXnq0UiPVBKTnnTqj/xNb3Q0c8vqxu+UEpauQubCqtPDK5zyHjUpDyLCYlXCH8ODqYiVMikf7qfPK3GcEuu5EVBq+asOa5W4lsNXixUcqEAiFkevIjDuESXD82N0lOHPhUtwVnBAIhrHFgKF7pVzVmxv7AcRvTk6sX3kj6qrpRYM3W784hj0tnbp/z2UGtJtbBz49+LuyKupN86/J75d5YOhpzBs7mimNNw+tLjaySsYa2PnPAD4/3EHpPFm7oggb7pp6d8ILw88Dt+1uRfe5YUrnyRNrbsa6qsWG1CctB6qvbGuitGTpuXApqZQba8pw7/LEgTYP0mLguUFfSqFGa2cfNr25B89v/Za6psUz625DWZH2GSMv0nakf7S9B6//x0Vl5/fjwTEJlF99L7kD0tfqVsKeqd8f4ab1mUiLpxtPv70fJ3sHqWta9EYN32Mdvcp8OhUkeH/qvlunSJU6aX+oRMwjJn504HjcoywVn3/ydbKif5LElm3VsgWUxgtDtnLJ8OE3Huxq/gPlxQUodedjritL2daFIxHlIMHTdRbDvjEqp+1725TwaO2KRZjttClbwhB5XT7+CgRD+LGjl7qPF4Zt5a5RjNvKXasIAxkRBjIiDGREGMiIMJARYSAjwkBGhIGMCAMZEQYyIgxkRBjIiDCQEWEgI8JARoiBjmldg/TiIAYmfhAhSESAPBPpEf/6KUWAwX8BDFpKe6DYx7MAAAAASUVORK5CYII="/>
                            </svg>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?=$share_url?>&picture=<?=get_the_post_thumbnail_url($Post->ID)?>&title=<?=$Post->post_title?>&caption=fbkk.ru" target="_blank" style="padding-right:10px; padding-left:10px;">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="30" viewBox="0 0 40 30">
                                <image id="facebook" width="40" height="30" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAAA8CAYAAADxJz2MAAAClUlEQVR4nO3cy2oTcRTH8d9MZhKb9Eq9xFSsC1G8g6IWuhBUEJcuBN0KorjQVTc+QHHbF/AhxCfQheLCla6EagtWYk2ayaW5mY78uygdzoSGHDpzBs9nUcjJFP79NjOZTNJaN5+8WQYwCTWMigOgACCj+YaStQG4CVy4FK4J6P3vFRg8O7FLF0IDMmlAJg3IpAGZNCCTBmTSgEwakEkDMjlJWOT8pTxuXClg9ugoxnNppFJW4P6VtRoWlj6S74uC+ICvns/h6tlDZL5b2kmRWVRE78IvH13eM56xXmmSWVTEBswfzOLWtRkyl0ZswLnzR8isn/x0ts89+0/sMXDmcP8o31Y9fF0uo9Pdgm1bKFVaZJuoiA2YGwm/UP79ZxVPF9+ReVzE7sKWZZGZ8eNXjcziJPdZ2PfJyHBjPGUJIzZgtdElM6PRDJ/HRcwx8O78cUyNZ+D7/vaD7+KpabKNcXp2Eg/unITZwy1sf0G13sHb9ytk2yiICfjs/jlkD+y9nBOFMTy+dyYwqzW6sQUUswsXS5tkNihzShMXMQHDnzIGU/baUS41QEzA0T7nfYPw6p0olxog5hj4p9LCWM7dOXtJuzacFP399rZ8tDu9ndvmyWS1WCfbRUVMwIWlD7B3nTy/eHgBt68fI9t9+vIbi68/B2bN9l+yXVTEBGy1e4Hbm63wKObR1+++ONB9RIi0G/6Kw3FkLVnfE2HSgEwakEkDMmlAJg3IpAGZNCCTBmTSgEwakElswJFM+GvhQS77R0nsG+vrGy2UPPqJg2J5+Ev/+8H8taZ5Q2FK1KqSY0OPgUwakEkDMmlAJg3IpAGZNCCTBmTSgEwakMkEnEj0TxCvCRNQ1mdmk6Vrrsas6b9+GhJQ+Qe1xIH+lbIOAgAAAABJRU5ErkJggg=="/>
                            </svg>
                        </a>
                        <a href="https://api.whatsapp.com://send?text=<?=$Post->post_title ." \n ". $share_url?>" target="_blank" data-action="share/whatsapp/share">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="30" viewBox="0 0 40 30">
                                <image id="whatsapp" width="40" height="30" xlink:href="data:img/png;base64,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"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
        
        <div class="col-md-12 col-lg-12 col-sm-12 col-12 content popup-gallery col-main-block note-content-text">
            <?php
            $more = explode("<!--more-->", $Post->post_content);
            if( !empty($more[1]) )
                $content = $more[1];
            else
                $content = apply_filters( 'the_content', $Post->post_content );

            echo $content;
            ?>

            <br>

            <?php
            if( $page[1] == 'media' ){
                $photos = get_field('photos', $Post->ID);
                if( $photos ){ ?>
                    <div class="get_more_photo_media">
                        <?=Media::getGaleryPhotos( $Post->ID, 0 )['content'] ?>
                    </div>
                    <!-- <div class="col-md-12 col-lg-12 col-sm-12 news-mini-block-all media-more col-main-block">
                        <a class="all-news"><button class="more-news more-photos-media-galery btn_learn_more" data-url="<?php echo admin_url("admin-ajax.php") ?>" data-href="Media/getGaleryPhotos" data-offset="9" data-post-id="<?=$Post->ID?>">Показать еще</button></a>
                    </div> -->
                <?php } 
            }?>
        </div>
        <div class="col-md-12 col-lg-12 col-sm-12 col-12 content col-main-block popup-gallery">
            <?php $post_meta = get_post_meta($Post->ID); 

            if( isset( $post_meta['qoute_0_text'] ) ){

                $i = 0;

                while( isset( $post_meta['qoute_'.$i.'_text'] ) && $post_meta['qoute_'.$i.'_text'] != ""  ){ ?>

                    <div class="quote shadow p-3 mb-5 bg-white rounded">
                        <div class="quote_content">
                            <div class="q_icon">
                                <svg class="q_icon_icon" xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" id="quote" x="997" y="943"><title>quote</title><path d="M9.568 10.096L15.712.16l3.36 1.824-4.176 8.112 4.176 8.112-3.36 1.872-6.144-9.984zm-9.072 0L6.64.16 10 1.984l-4.224 8.112L10 18.208 6.64 20.08.496 10.096z" fill="rgb(235, 23, 139)" fill-rule="evenodd"/></svg>
                            </div>
                            <div class="row">
                                <?php 
                                $_autor_photo = false;

                                if( isset( $post_meta['qoute_'.$i.'_author_photo'] ) ){ 
                                     
                                    $phhoto = get_field( 'qoute_'.$i.'_author_photo' , $Post->ID)['url'];
                                    
                                    if( $phhoto != null ){
                                        $_autor_photo = true; ?>
                                        <div class="col-lg-3 col-md-12 col-sm-12 col-12 b-content-citate__photo">
                                            <div class="b-content-citate__photo_inner">
                                                <img class="" src="<?=$phhoto?>" alt="Изображение записи" width="128" height="128">
                                            </div>
                                        </div>
                                    <?php }
                                } 
                                
                                $b_class = 12;

                                if( $_autor_photo )
                                    $b_class = 9; ?>

                                <div class="col-lg-<?=$b_class;?> col-md-12 col-sm-12 col-12">
                                    <div class="row">
                                        <?php if( isset( $post_meta['qoute_'.$i.'_text'] ) ){ ?>
                                            
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 qoute_text_block">
                                                <span class="qoute_text"><?= $post_meta['qoute_'.$i.'_text'][0]?></span>
                                            </div>
                                        <?php } ?>
                                        <?php if( isset( $post_meta['qoute_'.$i.'_author_position'] ) ){ ?>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 qoute_position">
                                            <span class=""><?= $post_meta['qoute_'.$i.'_author_position'][0]?></span>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php $i++;
                }

            }
        
            $mini_gallery = get_field('mini_gallery', $Post->ID);
            if( $mini_gallery ){ ?>
                <div class="col-md-12 col-lg-12 col-sm-12 col-main-block">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner" style="height: 100%;">
                            <?php foreach( $mini_gallery as $key => $photo ){ ?>
                                <div class="carousel-item carousel-content text_center <?=$key == 0 ? 'active' : ''?>">
                                    <img class="d-block mini-gallery-img" src="<?=$photo['url']?>">
                                </div>
                            <?php } ?>
                        </div>
                        <a class="carousel-control-prev-custom" href="#carouselExampleIndicators" role="button" data-slide="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                        <a class="carousel-control-next-custom" href="#carouselExampleIndicators" role="button" data-slide="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
</div>

<script>
    jQuery('img').each(function(i,v){
        var img_href = jQuery(v).parent('a').attr('href');
        jQuery(v).attr('href', img_href);
    });
    jQuery('.get_more_photo_media a div').each(function(i,v){
        var img_href = jQuery(v).attr('src');
        jQuery(v).attr('href', img_href);
    });
    $('.popup-gallery').magnificPopup({
        delegate: 'img',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1] // Will preload 0 - before current, and 1 after the current image
        },
        image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            titleSrc: function(item) {
                return item.el.attr('title');
            }
        }
    });
</script>

<style>


.carousel-control-prev-custom {
    position: absolute;
    top: 0;
    bottom: 0;
    z-index: 1;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: center;
    justify-content: center;
    width: 20px;
    color: black;
    text-align: center;
    opacity: .5;
    transition: opacity .15s ease;
    left: 0;
}

.carousel-control-next-custom {
    position: absolute;
    top: 0;
    bottom: 0;
    z-index: 1;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: center;
    justify-content: center;
    width: 20px;
    color: black;
    text-align: center;
    opacity: .5;
    transition: opacity .15s ease;
    right: 0;
}

</style>