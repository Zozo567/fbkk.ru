<?php
class Federation {

    static function getFederation( $offset = false ) {

        if( !$offset )
            $offset = !empty($_POST['offset']) ? $_POST['offset'] : 0;

        $arguments = [
            'numberposts' => 9,
            'offset' => $offset,
            'order' => 'DESC',
            'category_name' => 'federation'
        ];

        // $Post = get_posts($arguments);
        // $count_posts = count($Posts);

        $post = get_post();

        ob_start(); 

        // foreach( $Posts as $post ) {
        ?>

        <div class="col-md-12 col-lg-12 col-sm-12 content">
        <?= apply_filters( 'the_content', $post->post_content )?>
        </div>

        <?php
        // }

        $content = ob_get_contents();

        ob_end_clean();

        return ['status' => true, 'count_offset' => $count_posts, 'content' => $content, 'numberposts' => $arguments['numberposts']];
    }
}