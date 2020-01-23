<?php
class News {

    static function getNews( $offset = false ) {

        if( !$offset )
            $offset = !empty($_POST['offset']) ? $_POST['offset'] : 0;

        $arguments = [
            'numberposts' => 9,
            'offset' => $offset,
            'order' => 'DESC',
            'category_name' => 'news'
        ];

        $Posts = get_posts($arguments);
        $count_posts = count($Posts);

        ob_start(); 

        foreach( $Posts as $post ) {
            $url = get_permalink($post);
            
            $date_post = explode(' ', $post->post_date);
                
            $date_day = explode('-', $date_post[0]);
            $date_month = Basket::getRussianMonth( (int) $date_day[1]);
        ?>

        <div class="col-md-6 col-lg-4 col-sm-12 main-page-content">
            <div class="one-news-block mouse-class-main-news-hover">
                <a href="<?=$url . $post->ID?>">
                    <div class="mouse-hover-class-main-news litle-news-block" style=" filter: brightness(100%) !important; background-image: url(<?=get_the_post_thumbnail_url($post->ID, 'medium')?>);">
                        <div class="gradient-hover-id" ></div>
                    </div>
                    <div class="main-page-content-date" style="margin-top: 10px; padding-bottom:5px;">
                        <span class="date-event-time" style="color: rgb(170, 170, 170);"><?=$date_day[2] .' '. strtolower($date_month) .' '. $date_day[0] .', '. substr($date_post[1], 0, 5) ?></span>
                    </div>
                    <div class="one-block-title-news">
                        <span class="title-16"><?=$post->post_title?></span>
                    </div>
                    <div class="" style="margin-top: 10px;">
                        <span class="learn-more">Читать далее</span>
                    </div>
                </a>
            </div>
        </div>

        <?php
        }

        $content = ob_get_contents();

        ob_end_clean();

        return ['status' => true, 'count_offset' => $count_posts, 'content' => $content, 'numberposts' => $arguments['numberposts']];
    }
}