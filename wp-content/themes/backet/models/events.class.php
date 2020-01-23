<?php
class Events {

    static function getEvents( $offset = false, $array_last_events = false ) {

        if( !$offset )
            $offset = !empty($_POST['offset']) ? $_POST['offset'] : 0;

        $numberposts = 5;

        $arguments = [
            'numberposts' => -1,
            // 'offset' => $offset,
            'order' => 'DESC',
            'category_name' => 'events'
        ];

        $Posts = get_posts($arguments);
        // $count_posts = count($Posts);

        ob_start(); 

        // Сортировка событий по дате начала события
        foreach( $Posts as $post ){

            $post_meta = get_post_meta($post->ID);

            $post->date_start_event = strtotime(current($post_meta['date_start_event']));

            if( strtotime(current($post_meta['date_end_event'])) < time() ){
                $oldPost[] = $post;
                continue;
            }

            $newPost[] = $post;
        }

        $allPosts = [
            'new' => !empty($newPost) ? $newPost : [],
            'old' => !empty($oldPost) ? $oldPost : []
        ];

        foreach( $allPosts as $keyPost => $valuePost ) {
            for ($j = 0; $j < count($allPosts[$keyPost]) - 1; $j++){
                for ($i = 0; $i < count($allPosts[$keyPost]) - $j - 1; $i++){
                    if( $keyPost == 'new' ){

                        if ($allPosts[$keyPost][$i]->date_start_event > $allPosts[$keyPost][$i + 1]->date_start_event){
                            $tmp_var = $allPosts[$keyPost][$i + 1];
                            $allPosts[$keyPost][$i + 1] = $allPosts[$keyPost][$i];
                            $allPosts[$keyPost][$i] = $tmp_var;
                        }

                    } else if( $keyPost == 'old' ){

                        if ($allPosts[$keyPost][$i]->date_start_event < $allPosts[$keyPost][$i + 1]->date_start_event){
                            $tmp_var = $allPosts[$keyPost][$i + 1];
                            $allPosts[$keyPost][$i + 1] = $allPosts[$keyPost][$i];
                            $allPosts[$keyPost][$i] = $tmp_var;
                        }

                    }
                }
            }
        }

        if( $array_last_events )
            return $allPosts['new'];

        $allPostsArray = array_merge($allPosts['new'], $allPosts['old']);

        $allPostsArray = array_slice($allPostsArray, $offset, $numberposts);

        $count_posts = count($allPostsArray);

        // foreach( $allPosts as $keyPost => $valuePost ) {
            foreach( $allPostsArray as $post ) {
                $url = get_permalink($post); 
                $post_meta = get_post_meta($post->ID);
                ?>

            <div class="col-md-12 col-lg-12 col-sm-12 event-block">
                <!-- <div class=""> -->
                    <!-- <a href="<?=$url . $post->ID?>"> -->
                        <div class="row" style="<?= strtotime(current($post_meta['date_end_event'])) < time() ? 'background-color: #ededed' : '' ?>">
                            <div class="col-md-4 col-lg-4 col-sm-4 col-4 date-event-block" style="text-align: center; margin-bottom: 20px;">
                                <?php
                                $date_start_post = explode(' ', current($post_meta['date_start_event']));
                                $date_start_day = explode('-', $date_start_post[0]);
                                $date_start_month = Basket::getRussianMonth( (int) $date_start_day[1]);

                                if( isset($post_meta['date_end_event']) && $post_meta['date_end_event'][0] != "" ){
                                    $date_end_post = explode(' ', current($post_meta['date_end_event']));
                                    $date_end_day = explode('-', $date_end_post[0]);
                                    $date_end_month = Basket::getRussianMonth( (int) $date_end_day[1]); ?>
                                    <div class="row">
                                        <div class="col-md-5 col-lg-5 col-sm-5 col-5 col-main-block">
                                            <span class="date-event-day"><?=$date_start_day[2]?></span>
                                            <br>
                                            <span class="date-event-month"><?=strtolower($date_start_month)?></span>
                                            <br>
                                            <!-- <span class="date-event-time"><?=substr($date_star_post[1], 0, 5)?></span> -->
                                        </div>
                                        <div class="col-md-2 col-lg-2 col-sm-2 col-2 col-main-block">
                                            <span class="date-event-month"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="col-md-5 col-lg-5 col-sm-5 col-5 col-main-block">
                                            <span class="date-event-day"><?=$date_end_day[2]?></span>
                                            <br>
                                            <span class="date-event-month"><?=strtolower($date_end_month)?></span>
                                            <br>
                                            <!-- <span class="date-event-time"><?=substr($date_end_post[1], 0, 5)?></span> -->
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <span class="date-event-day"><?=$date_start_day[2]?></span>
                                    <br>
                                    <span class="date-event-month"><?=strtolower($date_start_month)?></span>
                                    <br>
                                    <!-- <span class="date-event-time"><?=substr($date_start_post[1], 0, 5)?></span> -->
                                <?php } ?>
                            </div>

                            <!-- <div class="col-md-4 col-lg-4 col-sm-8 col-9">
                                <div class="mouse-hover-class-event litle-news-block" style="background-image: url(<?=get_the_post_thumbnail_url($post->ID, 'medium')?>);">
                                    <div class="gradient-hover-id" ></div>
                                </div>
                            </div> -->

                            <div class="col-md-8 col-lg-8 col-sm-8 col-8 event-description">
                                <?php if( isset($post_meta['place']) ){ 
                                    $place = current($post_meta['place']);
                                } else {
                                    $place = '-';
                                } ?>
                                <p class="place-event"><i class="fa fa-map-marker" aria-hidden="true" style="padding-right:8px;"></i> <?=$place?></p>
                                <br>
                                <p class="font-event-title"><?=$post->post_title?></p>
                                
                                <!-- <p><a class="initialism more" href="<?=$url . $post->ID ?>">Узнать больше</a></p> -->
                                <!-- <div class="">
                                    <span class="learn-more" style="text-align:left;">Узнать больше</span>
                                </div> -->
                            </div>
                        </div>
                    <!-- </a> -->
                <!-- </div> -->
                <hr>
            </div>

            <?php }
        // }

        $content = ob_get_contents();

        ob_end_clean();

        return ['status' => true, 'count_offset' => $count_posts, 'content' => $content, 'numberposts' => $numberposts];
    }
}