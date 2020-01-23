<?php
class Guidance {

    static function getGuidance( $offset = false ) {

        if( !$offset )
            $offset = !empty($_POST['offset']) ? $_POST['offset'] : 0;

        $arguments = [
            'numberposts' => 9,
            'offset' => $offset,
            'order' => 'DESC',
            'category_name' => 'guidance'
        ];

        $Posts = get_posts($arguments);
        $count_posts = count($Posts);

        $post = get_post();

        ob_start(); 

        $posts_meta = [];

        foreach( $Posts as $post ){
            $_meta = get_post_meta($post->ID);
            $posts_meta[$_meta['position'][0]] = $_meta; 
            $posts_meta[$_meta['position'][0]]['post_id'] = $post->ID; 
        }

        ksort( $posts_meta );

        foreach( $posts_meta as $post_meta ){ ?>
            <div class="col-md-12 col-lg-12 col-sm-12 federation-wrapper">
                <div class="guidance-wrap">
                    <div class ="row">
                        <?php if( isset($post_meta['guidance_photo']) ){ ?>
                            <div class ="col-md-5 col-lg-5 col-sm-5">
                                <img src="<?= get_field('guidance_photo', $post_meta['post_id'])['url'] ?>" alt="" width="350" height="250" class="alignnone size-full wp-image-108 img-fluid" />
                            </div>
                        <?php }?>
                        <div class ="col-md-7 col-lg-7 col-sm-7 align-self-center" style="padding-top:10px;">
                            <?php if( isset($post_meta['guidance_name']) ){ ?>
                                <h6><?= get_field('guidance_name', $post_meta['post_id']) ?></h6>
                            <?php }?>

                            <?php if( isset($post_meta['guidance_role']) ){ ?>
                                <p class="guidance-info"><?= get_field('guidance_role', $post_meta['post_id']) ?></p>
                            <?php }?>
                            <?php if( isset($post_meta['guidance_phone']) ){ ?>
                                <p class="guidance-phone"><?= get_field('guidance_phone', $post_meta['post_id']) ?></p>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        <?php }

           

        $content = ob_get_contents();

        ob_end_clean();

        return ['status' => true, 'count_offset' => $count_posts, 'content' => $content, 'numberposts' => $arguments['numberposts']];
    }
}