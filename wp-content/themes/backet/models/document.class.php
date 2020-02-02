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

        $documents_types = [
            'regulations' => 'Положения и регламенты',
            'constituent' => 'Учредительные',
            'dlya-sudey' => 'Для судей',
            'dlya-trenirov' => 'Для тренеров',
            'drugie' => 'Другие'
        ];

        $dosuments_arr = [];

        foreach( $Posts as $key => $post ) { 
            $dosuments_arr += [
                get_field('document_type', $post->ID) => get_field('documents_info', $post->ID)
            ];
        }
        
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
                    <?php foreach( $documents_types as $documents_key => $documents_val ){ ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $documents_key == 'regulations' ? 'active' : ''?>" id="<?=$documents_key?>-tab" data-toggle="tab" href="#<?=$documents_key?>" role="tab" aria-controls="<?=$documents_key?>" aria-selected="<?= $documents_key == 'regulations' ? 'true' : ''?>"><?=$documents_val?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>

        <div class="tab-content" id="myTabContent">

            <?php foreach( $documents_types as $documents_key => $documents_val ){ 
                
                $documents_val = !empty($dosuments_arr[$documents_key]) ? $dosuments_arr[$documents_key] : [];
                ?>
            <div class="tab-pane faden <?=$documents_key == 'regulations' ? 'show active in' : ''?>" id="<?=$documents_key?>" role="tabpanel" aria-labelledby="<?=$documents_key?>-tab">
                <div class="federation-wrapper">
                    <?php
                    if( isset($documents_val) && !empty($documents_val) ){ ?>
                        <table class="table">
                            <?php 
                        if( !empty($documents_val[0]['path']) ){    
                            foreach( $documents_val as $item ) { ?>
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
                                <?php 
                                echo Basket::getPlug( 'document' );
                                ?>
                            </div>
                        <?php } ?>
                        </table>
                    <?php } else { ?>
                        <div style="margin-top: 30px;">
                            <?php 
                            echo Basket::getPlug( 'document' );
                            ?>
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