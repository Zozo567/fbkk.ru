<?php
$input_data = $_GET;
?>
<div style="margin-top: 40px; margin-left: 20px;">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <span style="font-size: 35px;">Результаты поиска</span>
    </div>

    <div class="col-md-12 col-lg-12 col-sm-12">
        <form id="search_posts_form">
            <i class="fa fa-search" 
                aria-hidden="true"
                style="    
                    right: -10px;
                    position: relative;
                    z-index: 2500;
                    float: left;
                    color: #ebebeb;
                    top: 25px;
                    "></i>
            <input class="form-control" 
                type="text" 
                name="search_value" 
                placeholder="Поиск" 
                autocomplete="off" 
                value="<?=isset($input_data['query']) && !empty($input_data['query']) ? $input_data['query'] : '' ?>"
                style="padding-left: 30px;">
        </form>
    </div>

    <div style="margin-top: 20px;" class="content">
        <?php 
        if( isset($input_data['query']) && !empty($input_data['query']) ){
            $search_results = get_posts( array( 's' => $input_data['query'], 'post_type' => 'post', 'fields' => 'all', 'order' => 'DESC', ) );
            if( !empty($search_results) ){
                foreach( $search_results as $key => $item ){ 

                    $category = get_the_category($item->ID);

                    if( strpos($category[0]->slug, '-') )
                        $url = 'competition';
                    else
                        $url = get_permalink($item);

                    if( $url == 'competition' ){
                        $competition_meta = get_post_meta($item->ID);
                        $competition_id_stat = json_decode(current($competition_meta['competition_id']), true);
                        foreach( $competition_id_stat as $year_born => $competition_id ){ 
                            $category_post_url = '/'. $url .'/'. $item->post_name .'/'. $item->ID .'/'. $year_born; ?>
                            <div class="col-md-12 col-lg-12 col-sm-12" style="margin-bottom: 20px;">
                                <span style="font-size: 25px;"><?=$item->post_title .' - '. $year_born?></span>
                            </div>
                            <div class="col-md-12 col-lg-12 col-sm-12" style="margin-bottom: 20px;">
                                <span><?=explode("<!--more-->",$item->post_content)[0]?></span>
                            </div>
                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <a href="<?=$category_post_url?>">Подробнее</a>
                            </div>
                            <hr>
                        <?php }
                        continue;
                    } else 
                        $category_post_url = '/'. $url .'/'. $item->ID;
                    ?>
                    <div class="col-md-12 col-lg-12 col-sm-12" style="margin-bottom: 20px;">
                        <span style="font-size: 25px;"><?=$item->post_title?></span>
                    </div>
                    <div class="col-md-12 col-lg-12 col-sm-12" style="margin-bottom: 20px;">
                        <?php 
                        $content = wp_strip_all_tags($item->post_content);
                        if( $content ){
                            $part_content = mb_substr($content, 0, 150,'UTF-8'); // заменить на substr, если будет ошибка, но появляется �
                            echo $part_content .'...';
                        }
                        ?>
                    </div>
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <a href="<?=$category_post_url?>">Подробнее</a>
                    </div>
                    <hr>
                <?php }
            } else { ?>
                <div class="col-md-12 col-lg-12 col-sm-12" style="text-align: center;">
                    <div class="col-md-12 col-lg-12 col-sm-12" style="">
                        <span style="font-size: 40px;">Упппс...ничего не найдено</span>
                    </div>
                    <div class="col-md-12 col-lg-12 col-sm-12" style="margin-top: 30px;">
                        <span style="font-size: 20px; color: gray;">По вашему запросу не было ничего найдено.</span>
                    </div>
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <span style="font-size: 20px; color: gray;">Пожалуйста повторите попытку.</span>
                    </div>
                    <div class="row justify-content-center align-items-center" style="margin-top: 30px; margin-bottom: 30px;">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <a class="all-news" href="/main"><button style="width:300px;" class="btn_learn_more">Перейти на главную</button></a>
                        </div>
                    </div>
                </div>
        <?php }
        } ?>
    </div>
</div>