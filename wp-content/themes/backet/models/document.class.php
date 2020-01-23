<?php
class Document {

    static function getDocuments( $offset = false, $category_name = false ) {

        if( !$offset )
            $offset = !empty($_POST['offset']) ? $_POST['offset'] : 0;

        $all_categories = get_categories([
            'hide_empty' => 0,
            'order' => 'DESC',
        ]);

        foreach( $all_categories as $item ){
            if( strpos($item->name, '/') )
                $season_categories[] = $item;
        }

        if( !$season_categories ){
            $category = 'document';

            $content =  Basket::getPlug( $category );

            return [ 'status' => true, 'content' => $content ];
        }

        if( !$category_name )
            $category_name = isset($_POST['season']) && !empty($_POST['season']) ? $_POST['season'] : $season_categories[0]->slug; // slug рубрики (по умолчанию последний сезон)

        $sorevnovaniya_id = get_category_by_slug('document')->term_id;
        $category_name_id = get_category_by_slug($category_name)->term_id;

        $arguments = [
            'category__and' => [
                $sorevnovaniya_id,$category_name_id
            ],
            'posts_per_page' => 5,
            'offset' => $offset,
            'order' => 'DESC',
        ];

        $Posts = query_posts($arguments);
        $count_posts = count($Posts);
        
        ob_start();
        if( !isset($_POST['offset']) || empty($_POST['offset']) ) { ?>
        <div class="col-lg-3 col-md-3 col-sm-3 col-main-block" style="padding-bottom:10px;">
            <div class="icon-select">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="0.247cm" height="0.141cm">
                    <path fill-rule="evenodd"  fill="rgb(17, 17, 17)" d="M7.000,1.000 L6.000,1.000 L6.000,2.000 L5.000,2.000 L5.000,3.000 L4.000,3.000 L4.000,4.000 L3.000,4.000 L3.000,3.000 L2.000,3.000 L2.000,2.000 L1.000,2.000 L1.000,1.000 L-0.000,1.000 L-0.000,-0.000 L7.000,-0.000 L7.000,1.000 Z"/>
                </svg>
            </div>
            <select class="change_season_games change_conclusion_team" data-url="<?php echo admin_url("admin-ajax.php") ?>" data-href="Document/getDocuments">
                <?php foreach( $season_categories as $value ){ ?>
                    <option class="change_season_competition" <?=$category_name == $value->slug ? 'selected' : ''?> value="<?=$value->slug?>"><?=$value->name?></option>
                <?php } ?>
            </select>
        </div>
        <?php } ?>

        <div class="competition-type-menu-wraper">
            <div class="competition-type-menu">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="constituent-tab" data-toggle="tab" href="#constituent" role="tab" aria-controls="constituent" aria-selected="true">Учредительные</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="dlya-sudey-tab" data-toggle="tab" href="#dlya-sudey" role="tab" aria-controls="dlya-sudey" aria-selected="false">Для судей</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="dlya-trenirov-tab" data-toggle="tab" href="#dlya-trenirov" role="tab" aria-controls="dlya-trenirov" aria-selected="false">Для тренеров</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="drugie-tab" data-toggle="tab" href="#drugie" role="tab" aria-controls="drugie" aria-selected="false">Другие</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="tab-content" id="myTabContent">

            <?php foreach( $Posts as $key => $post ) { 
                
                $post_meta['documents_info'] = get_field('documents_info', $post->ID);
                $post_meta['document_type'] = get_field('document_type', $post->ID); ?>

            <div class="tab-pane faden <?=$post_meta['document_type'] == 'constituent' ? 'show active in' : ''?>" id="<?=$post_meta['document_type']?>" role="tabpanel" aria-labelledby="<?=$post_meta['document_type']?>-tab">
                <div class="federation-wrapper">
                    <?php
                    if( isset($post_meta['documents_info']) && !empty($post_meta['documents_info']) ){ ?>
                        <table class="table">
                            <?php 
                         if( !empty($post_meta['documents_info'][0]['path']) ){    
                            foreach( $post_meta['documents_info'] as $item ) { ?>
                            <tr>
                                <td width="80%" class="col-main-block">
                                    <?php
                                    $date_post = explode(' ', $item['date']);
                                    $date_day = explode('-', $date_post[0]);
                                    $date_month = Basket::getRussianMonth( (int) $date_day[1]);
                                    ?>
                                    <span class="document_date_label"><?=$date_day[2] .' '. strtolower($date_month) .' '. $date_day[0] .', '. substr($date_post[1], 0, 3) . '00' ?></span>
                                    <br><br>
                                    <span class="document_name_label"><?=$item['name']?></span>
                                    <br><br>
                                    <span class="document_type_label"><?=explode('/', $item['path']['mime_type'])[1]?></span>
                                </td>
                                <!-- <td><a class="btn btn_print_document" href="<?=$item['path']['url']?>" target="_blank">Скачать</a></td> -->
                                <td>
                                    <a class="all-news" href="<?=$item['path']['url']?>" target="_blank">
                                        <button class="btn_learn_more">
                                            Скачать
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            <?php }
                         } else { ?>
<div style="margin-top: 30px;">
<?php $category = 'document';

echo Basket::getPlug( $category );?>

</div>
<?php } ?>
                        </table>
                    <?php } else { ?>
                        <div style="margin-top: 30px;">
                            <!-- <span class="document_name_label">Документов не загружено</span> -->
                            <?php $category = 'document';

                            echo Basket::getPlug( $category );?>

                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php
        $content = ob_get_contents();

        ob_end_clean();

        return ['status' => true, 'count_offset' => $count_posts, 'content' => $content, 'numberposts' => $arguments['numberposts']];
    }
}