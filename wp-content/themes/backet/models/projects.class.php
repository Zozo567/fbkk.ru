<?php
class Projects {

    static function getProjects( $offset = false ) {

        if( !$offset )
            $offset = !empty($_POST['offset']) ? $_POST['offset'] : 0;

        $arguments = [
            'numberposts' => 9,
            'offset' => $offset,
            'order' => 'DESC',
            'category_name' => 'projects'
        ];

        $Posts = get_posts($arguments);
        $count_posts = count($Posts);

        ob_start(); 

        foreach( $Posts as $post ) {
            $url = get_permalink($post);
            $post_meta = get_post_meta($post->ID);
        ?>

        <div class="desctop-project">
            <div class="col-md-12 col-lg-12 col-sm-12 projects-main">
                <div class="mouse-hover-class-one-event-right">
                    <a class="test-hover" href="<?=$url?>">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <img class="img-fluid more_width_full" src="<?=get_the_post_thumbnail_url($post->ID, 'large') ?>" alt="Изображение записи">
                            </div>
                            
                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <div class="row">
                                    <?php if( isset($post_meta['logo_project']) ){ 

                                        $photo_url = get_field('logo_project', $post->ID)['url']; ?>

                                        <div class="col-md-3 col-lg-3 col-sm-3 logo-project">
                                            <img class="img-fluid" src="<?=$photo_url?>" alt="Логотип проекта">
                                        </div>
                                    <?php }?>

                                    <div class="col-md-9 col-lg-9 col-sm-9 title-block-project">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12 col-sm-12 title-note-project">
                                                <span><?= $post->post_title ?></span>
                                            </div>

                                            <?php if( isset($post_meta['description']) ){ 

                                                $description = current($post_meta['description']); ?>

                                            <div class="col-md-12 col-lg-12 col-sm-12">
                                                <span class="preview"><?=$description?></span>
                                            </div>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 col-lg-9 col-sm-9 projects-more offset-3">
                                <span class="learn-more">Узнать больше</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="mobile-project">
            <div class="col-md-12 col-lg-12 col-sm-12 projects-main">
                <a href="<?=$url?>">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <img class="img-fluid" src="<?=get_the_post_thumbnail_url($post->ID) ?>" alt="Изображение записи">
                        </div>
                        <?php if( isset($post_meta['logo_project']) ){ 

                            $photo_url = get_field('logo_project', $post->ID)['url']; ?>

                            <div class="col-md-12 col-lg-12 col-sm-12 logo-project text-center">
                                <img class="img-fluid" src="<?=$photo_url?>" alt="Логотип проекта">
                            </div>
                        <?php }?>

                        <div class="col-md-12 col-lg-12 col-sm-12 title-block-project title-note">
                            <span><?= $post->post_title ?></span>
                        </div>

                        <?php if( isset($post_meta['description']) ){ 

                            $description = current($post_meta['description']); ?>

                        <div class="col-md-12 col-lg-12 col-sm-12 preview-block-project">
                            <span class="preview"><?=$description?></span>
                        </div>
                        <?php }?>

                        <div class="col-md-3 col-lg-3 col-sm-3 projects-more">
                            <span>Узнать больше</span>
                        </div>
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

    static function getHeadProjects( $offset = false ) {

        if( !$offset )
            $offset = !empty($_POST['offset']) ? $_POST['offset'] : 0;

        $arguments = [
            'numberposts' => 9,
            'offset' => 0,
            'order' => 'DESC',
            'category_name' => 'projects'
        ];

        $Posts = get_posts($arguments);
        $count_posts = count($Posts);

        ob_start();
        
        foreach( $Posts as $post ) {

            $url = get_permalink($post);
            $title = $post->post_title ?>

            <a href="<?=$url?>"> <?=$title?></a>

        <?php } 
        $content_head = ob_get_contents();

        ob_end_clean();
        
        return [ 'status' => true, 'content' => $content_head ];
    }
    
}