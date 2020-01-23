<?php
class Media {

    static function getMedia( $offset = false ) {

        if( !$offset )
            $offset = !empty($_POST['offset']) ? $_POST['offset'] : 0;

        $arguments = [
            'numberposts' => 4,
            'offset' => $offset,
            'order' => 'DESC',
            'category_name' => 'media'
        ];

        $Posts = get_posts($arguments);
        $count_posts = count($Posts);

        ob_start(); 

        foreach( $Posts as $post ) { 
            $url = get_permalink($post);
            $post_meta = get_post_meta($post->ID);
            ?>

            <div class="col-md-12 col-lg-12 col-sm-12 par" style="padding-bottom: 20px;">
                <a href="<?=$url . $post->ID?>">
                    <div class="mouse-hover-class-check " style="margin-top:0px !important; width: 100%; margin-top: 20px; height: 300px; filter: brightness(50%); background-image: url(<?=get_the_post_thumbnail_url($post->ID, 'large')?>);">
                        <div class="gradient-hover-id"></div>
                    </div>
                
                    <div class="media-list-text-block">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 col-sm-12 text_center date-media-block">
                                <?php
                                $date_post = explode(' ', $post->post_date);
                                $date_day = explode('-', $date_post[0]);
                                $date_month = Basket::getRussianMonth( (int) $date_day[1]); ?>
                                <span class="date-media-day"><?=$date_day[2]?></span>
                                <br>
                                <span class="date-media-month"><?=strtolower($date_month)?></span>
                                <br>
                                <span class="date-media-time"><?=substr($date_post[1], 0, 5)?></span>
                            </div>

                            <div class="col-md-9 col-lg-9 col-sm-12 title-media-block" style="text-align: left;">
                                <p class="font-media-title"><?=$post->post_title?></p>
                                <br>
                                <span class="more">Подробнее</span>
                            </div>
                        </div>
                        <span class="photo_or_video_media_list">
                            <?php if( isset($post_meta['video']) && current($post_meta['video']) == 1 ) { ?>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" viewBox="0 0 30 30">
                                    <image id="noun_Video_1955876_1A1A1A" width="30" height="30" xlink:href="data:img/png;base64,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"/>
                                </svg>
                            <?php } else if( isset($post_meta['photo']) && current($post_meta['photo']) == 1 ) { ?>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" viewBox="0 0 30 28">
                                    <image id="noun_Photo_1900523_1A1A1A" width="30" height="28" xlink:href="data:img/png;base64,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"/>
                                </svg>
                            <?php } ?>
                        </span>
                    </div>
                </a>
            </div>

        <?php }

        $content = ob_get_contents();

        ob_end_clean();

        return ['status' => true, 'count_offset' => $count_posts, 'content' => $content, 'numberposts' => $arguments['numberposts']];
    }

    static function getGaleryPhotos( $post_id = false, $offset = false )
    {
        if( !$post_id )
            $post_id = isset($_POST['post_id']) && !empty($_POST['post_id']) ? $_POST['post_id'] : 0;

        if( !$offset )
            $offset = isset($_POST['offset']) && !empty($_POST['offset']) ? $_POST['offset'] : 0;

        if( $post_id == 0 )
            return ['status' => false, 'message' => 'Отсутствует ID поста'];

        $photos = get_field('photos', $post_id);

        if( $photos ) {

            // Если необходима парционный вывод фотографий, то поменяйте строчки местами
            // $photos_new = array_slice($photos, $offset, 9);
            $photos_new = $photos;

            ob_start();

            foreach( $photos_new as $photo ){ ?>

                <a href="<?=$photo['url']?>">
                    <img class="alignleft wp-image-83 size-thumbnail" data-src="<?=$photo['url']?>" alt="" width="150" height="150">
                    <!-- <div class="size-thumbnail" style="background-image: url(<?=$photo['url']?>);"></div> -->
                </a>

            <?php }

            $content = ob_get_contents();

            ob_end_clean();
        }

        return ['status' => true, 'content' => $content, 'count_offset' => $offset + 9, 'count_content' => count($photos_new)];
    }
}