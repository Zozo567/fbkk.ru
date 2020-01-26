<?php
class Competition {

    static $gender_type = [
        'boy' => 'Ю',
        'girl' => 'Д'
    ];

    static function getCompetition( $offset = false, $category_name = false )
    {
        if( !$offset )
            $offset = !empty($_POST['offset']) ? $_POST['offset'] : 0;

        $arguments = [
            'category_name' => 'competition',
            'numberposts' => 5,
            'offset' => $offset,
            'order' => 'DESC',
        ];

        $page_data = get_page_by_path( 'competition');
        $interseasonal = ( get_field( 'interseasonal', $page_data->ID ) == "1" ) ? true : false;

        $Posts = get_posts($arguments);
        $count_posts = count($Posts);

        if( $count_posts == 0 || $interseasonal ){

            $category = 'competition';

            $content = Basket::getPlug( $category );

            return ['status' => true, 'interseasonal' => 1, 'content' => $content];

        }

        ob_start();

        foreach( $Posts as $key => $post ) {

            $url = get_permalink( $post );
            $url = explode("/", $url);
            $url = '/competition/'. $url[4] .'/'. $post->ID .'/';

            $post_meta_gender = current(get_post_meta($post->ID)['gender']); ?>
            <div class="col-md-12 col-lg-12 col-sm-12 col-12 one-competition">
                <div class="col-md-12 col-lg-12 col-sm-12 col-12" style="padding-bottom:10px;">
                    <span class="gender <?=$post_meta_gender == 'boy' ? 'gender_boy' : 'gender_girl'?> <?=$post_meta_gender?>"><?=self::$gender_type[$post_meta_gender]?></span> <span class="title_competition"><?=$post->post_title?></span>
                </div>
                <div class="desctop">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="row">
                            <?php
                            $post_meta_competition_id = get_field('competition_id', $post->ID);
                            $count_post_meta_competition_id = count($post_meta_competition_id);
                            $sm = 12;
                            $md = 3;
                            $lg = 3;

                            if( $count_post_meta_competition_id > 4 ){ ?>
                                <div class="container-fluid">
                                    <div id="carouselExample-<?=$key?>" class="carousel slide" data-ride="carousel" data-interval="9000">
                                        <div class="carousel-inner row w-100 mx-auto" role="listbox">
                                        <?php foreach( $post_meta_competition_id as $post_meta_key => $post_meta_value ){ ?>
                                            <div class="carousel-item <?=$post_meta_key == 0 ? 'active' : ''?> col-md-3">
                                                <div class="block_year_born">
                                                    <span class="year_born"><?=$post_meta_value['year_born']?></span>
                                                    <br>
                                                    <span class="text_year_born">год рождения</span>
                                                    <br><br>
                                                    <a class="text_more" href="<?=$url . $post_meta_value['year_born']?>">Подробнее</a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        </div>
                                        <a class="carousel-control-prev-custom" href="#carouselExample-<?=$key?>" role="button" data-slide="prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
                                        <a class="carousel-control-next-custom text-faded" href="#carouselExample-<?=$key?>" role="button" data-slide="next"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            <?php } else { 
                                foreach( $post_meta_competition_id as $post_meta_key => $post_meta_value ){ ?>
                                    <div class="col-md-<?=$md?> col-lg-<?=$lg?> col-sm-<?=$sm?>">
                                        <div class="block_year_born">
                                            <span class="year_born"><?=$post_meta_value['year_born']?></span>
                                            <br>
                                            <span class="text_year_born">год рождения</span>
                                            <br><br>
                                            <a class="text_more" href="<?=$url . $post_meta_value['year_born']?>">Подробнее</a>
                                        </div>
                                    </div>
                            <?php } 
                            }?>
                        </div>
                    </div>
                </div>
                <div class="mobile">
                    <div class="footer-partner">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-block">
                            <div id="carouselExampleIndicatorsMedia" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <?php $count_post_meta_competition_id = count($post_meta_competition_id);
                                    for( $i = 0; $i < $count_post_meta_competition_id; $i++ ) { ?>
                                    <li data-target="#carouselExampleIndicatorsMedia" style="background-color: black;" data-slide-to="<?=$i?>" class="<?= $i == 0 ? 'active' : '' ?>"></li>
                                    <?php } ?>
                                </ol>
                                <div class="carousel-inner carousel-competition-mobile">
                                <?php foreach( $post_meta_competition_id as $post_meta_key => $post_meta_value ){ ?>
                                    <div class="carousel-item <?=$post_meta_key == 0 ? 'active' : ''?>">
                                        <div class="block_year_born">
                                            <span class="year_born"><?=$post_meta_value['year_born']?></span>
                                            <br>
                                            <span class="text_year_born">год рождения</span>
                                            <br><br>
                                            <a class="text_more" href="<?=$url . $post_meta_value['year_born']?>">Подробнее</a>
                                        </div>
                                    </div>
                                <?php } ?>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicatorsMedia" role="button" data-slide="prev"></a>
                                <a class="carousel-control-next" href="#carouselExampleIndicatorsMedia" role="button" data-slide="next"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php
        $content = ob_get_contents();

        ob_end_clean();

        return ['status' => true, 'count_offset' => $count_posts, 'content' => $content, 'numberposts' => $arguments['numberposts']];
    }

    static function getMetaCompetition( $competition_id )
    {
        if( !$competition_id )
            die("Системная ошибка!");

        global $wpdb;
        
        $basket_competition_meta = $wpdb->get_results("SELECT * FROM `basket_competition_meta` WHERE `Cid` = $competition_id");

        foreach( $basket_competition_meta as $item ){
            $meta[] = [
                'ID' => $item->ID,
                $item->Name => $item->Value,
            ];
        }

        return $meta;
    }

    static function getCompetitionDocuments( $documents_data = false )
    {
        $input_data = $_POST;

        if( !$documents_data && isset($input_data['competition_id']) )
            $documents_data = get_field('competition_documents', $input_data['competition_id']);

        $season = isset($input_data['season']) && !empty($input_data['season']) ? $input_data['season'] : $documents_data[0]['years_documents']; 
        
        ob_start();
        ?>

        <div class="row">
            <?php foreach( $documents_data as $key => $value ) { 
                if( $value['years_documents'] == $season ) {
                    foreach( $value['season_competition'] as $val ){
                        $date_document = isset($val['date']) && !empty($val['date']) ? Basket::getCurrentDate($val['date']) : '-';
                        ?>
                        
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="desctop-competition-doc">
                                <div class="row">
                                    <div class="col-lg-9 col-md-9 col-sm-9">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <span class="document_date_label"><?=$date_document ?></span>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <span class="document_name_label"><?=$val['name']?></span>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <span class="document_type_label"><?=explode('/', $val['path']['mime_type'])[1] ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="align-self-center">
                                            <!-- <a class="btn btn_print_document" href="<?=$val['path']['url']?>" target="_blank">Скачать</a> -->
                                            <a class="all-news" href="<?=$val['path']['url']?>" target="_blank"><button class="btn_learn_more">Скачать</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="mobile-competition-doc">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <span class="document_date_label"><?=$date_document ?></span>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <span class="document_name_label"><?=$val['name']?></span>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="row">
                                            <div class="col-lg-7 col-md-7 col-sm-7 col-7">
                                                <span class="document_type_label"><?=explode('/', $val['path']['mime_type'])[1] ?></span>
                                            </div>
                                            <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                                <a class="all-news" href="<?=$val['path']['url']?>" target="_blank"><button class="btn_learn_more">Скачать</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php   }
                }
            }?>
        </div>

        <?php
        $content = ob_get_contents();

        ob_end_clean();

        return ['status' => true, 'content' => $content];
    }

    static function getCompetitionShedule( $comp_id = false )
    {
        $input_data = $_POST;

        if( !$comp_id )
            $comp_id = $input_data['competition_id'];

        ob_start(); 
        ?>

        <iframe id="competiton_shedule" width="100%" src="/rfb/comp.html?compId=<?=$comp_id?>&apiUrl=https://reg.infobasket.ru&lang=ru"></iframe>

        <?php
        $content = ob_get_contents();

        ob_end_clean();

        return ['status' => true, 'content' => $content];
    }

    static function OLDgetCompetitionShedule( $comp_id = false )
    {
        $input_data = $_POST;

        if( !$comp_id )
            $comp_id = $input_data['competition_id'];

        $shedule = @file_get_contents('https://reg.infobasket.ru/Widget/CalendarCarousel/'. $comp_id .'?format=json&max=1000&lang=ru&tab=0&from=&to=&dateFormat=dd.MM.yyyy&region=0&arena=0&team=0');
        $shedule_data_all = json_decode($shedule, true);

        $empty = 0; // если ничего не найдено

        if( !empty($shedule_data_all) ) {

            $offset = isset($input_data['offset']) && !empty($input_data['offset']) ? $input_data['offset'] : 0;

            $date_to = current(array_slice($shedule_data_all, -1, 1))['GameDate'];
            $date_from = current(array_slice($shedule_data_all, 0, 1))['GameDate'];

            // Фильтр по играм
            foreach( $shedule_data_all as $item ){

                $GameDate = strtotime($item['GameDate']);
                    
                $stages_id = isset($input_data['stages_id']) && !empty($input_data['stages_id']) ? $input_data['stages_id'] : $item['CompNameRu'];
                $teams_a_id = isset($input_data['team_id']) && !empty($input_data['team_id']) ? $input_data['team_id'] : $item['TeamAid'];
                $teams_b_id = isset($input_data['team_id']) && !empty($input_data['team_id']) ? $input_data['team_id'] : $item['TeamBid'];
                $date_competition = isset($input_data['date_competition']) && !empty($input_data['date_competition']) ? strtotime($input_data['date_competition']) : $GameDate;
                $games_status = isset($input_data['games_status']) && ($input_data['games_status'] != "") ? $input_data['games_status'] : $item['GameStatus'];

                if( isset($input_data['date_competition']) && !empty($input_data['date_competition']) ){
                    $date_competition = explode('-',$input_data['date_competition']);
                    $date_competition_from = strtotime($date_competition[0]);
                    $date_competition_to = strtotime($date_competition[1]);
                } else {
                    $date_competition_from = $GameDate;
                    $date_competition_to = $GameDate;
                }

                if( ($item['CompNameRu'] == $stages_id) && ($item['TeamAid'] == $teams_a_id || $item['TeamBid'] == $teams_b_id) && ($item['GameStatus'] == $games_status) && ($GameDate >= $date_competition_from) && ($GameDate <= $date_competition_to) ) {

                    $shedule_data[] = $item;
                    $empty++; // подсчет количества игр
                }
            }

            $shedule_data = array_slice($shedule_data, $offset, 5);

            // Разделение по месяцам
            foreach( $shedule_data as $item ) {
                foreach( Basket::$months as $month_number => $month_name ){
                    $time = strtotime($item['GameDate']);
                    $year = date("Y", $time);
                    $month_games = Basket::$months[$month_number] .' '. $year; 
                    if( $month_number == date("m", $time) )
                        $shedule_data_new[$month_games][] = $item;
                }
            }

            // Все этапы
            $stages = [];
            foreach( $shedule_data_all as $item ) {
                if( !isset($stages[$item['CompNameRu']]) )
                    $stages[$item['CompNameRu']] = $item['CompNameRu'];
            }

            // Все команды
            $teams = [];
            foreach( $shedule_data_all as $item ) {
                if( !isset($teams[$item['TeamAid']]) )
                    $teams[$item['TeamAid']] = $item['ShortTeamNameAru'];

                if( !isset($teams[$item['TeamBid']]) )
                    $teams[$item['TeamBid']] = $item['ShortTeamNameBru'];
            }

            ob_start(); ?>

            <?php if( !isset($input_data['stages_id']) && !isset($input_data['team_id']) && !isset($input_data['date_from']) && !isset($input_data['date_to']) && !isset($input_data['games_status']) && !isset($input_data['offset']) ) { ?>
            <form>
                <div class="col-md-12 col-lg-12 col-sm-12 col-12 div_change_conclusion_team">
                    <div class="row">
                        <div class="col-md-6 col-lg-3 col-sm-12 select_change_conclusion_team">
                        <div class="icon-select">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="0.247cm" height="0.141cm">
                                <path fill-rule="evenodd"  fill="rgb(17, 17, 17)" d="M7.000,1.000 L6.000,1.000 L6.000,2.000 L5.000,2.000 L5.000,3.000 L4.000,3.000 L4.000,4.000 L3.000,4.000 L3.000,3.000 L2.000,3.000 L2.000,2.000 L1.000,2.000 L1.000,1.000 L-0.000,1.000 L-0.000,-0.000 L7.000,-0.000 L7.000,1.000 Z"/>
                            </svg>
                        </div>
                            <select class="change_conclusion_team schedule_change" name="stages_id" data-url="<?php echo admin_url("admin-ajax.php") ?>" data-href="Competition/getCompetitionShedule" data-comp-id="<?=$comp_id?>">
                                <option value="" selected>Все этапы</option>
                                <?php foreach( $stages as $stages_id => $stages_name ){ ?>
                                <option value="<?=$stages_id?>"><?=$stages_name?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-3 col-sm-12 select_change_conclusion_team">
                            <div class="icon-select">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="0.247cm" height="0.141cm">
                                    <path fill-rule="evenodd"  fill="rgb(17, 17, 17)" d="M7.000,1.000 L6.000,1.000 L6.000,2.000 L5.000,2.000 L5.000,3.000 L4.000,3.000 L4.000,4.000 L3.000,4.000 L3.000,3.000 L2.000,3.000 L2.000,2.000 L1.000,2.000 L1.000,1.000 L-0.000,1.000 L-0.000,-0.000 L7.000,-0.000 L7.000,1.000 Z"/>
                                </svg>
                            </div>
                            <select class="change_conclusion_team schedule_change" name="team_id" data-url="<?php echo admin_url("admin-ajax.php") ?>" data-href="Competition/getCompetitionShedule" data-comp-id="<?=$comp_id?>">
                                <option value="" selected>Выберите команду</option>
                                <?php foreach( $teams as $team_id => $team_name ){ ?>
                                <option value="<?=$team_id?>"><?=$team_name?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-3 col-sm-12 select_change_conclusion_team">
                            <input class="change_conclusion_team schedule_change date-field-competition calendar-field" type="text" name="date_competition" data-url="<?php echo admin_url("admin-ajax.php") ?>" data-href="Competition/getCompetitionShedule" data-comp-id="<?=$comp_id?>">
                            <div class="icon-calendar">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14" height="14" viewBox="0 0 16 16">
                                    <image id="noun_Calendar_920172_000000" width="16" height="16" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAABgElEQVRYhe2Xzy4EQRDGfzM7exhk18ZBOBAn4i7iQDyVRCQubsQjiXgAidMi4SCuIv4Ti5bK1khvt5mV0LMO89165quqr6u7uqujVqtFHywD20AEbAB7xXRWlC9YB/Y9hoV+AhLgCmjq+AVoAB2P2UUduAZGdPwIjAJvHlMRe196IYZDjqC84Og/m18vCp45tFEDUh0bncmzOkIzMAHceZ66kOw8WRkQ/jjwoEuI+nvPDLIlmAG2gFXL2KhRwzI2Gtx4odVfAT/7JstyAGwCZyJgEji1ApcFycRsLU3TXWCp5ODoso7FWmaDwmL8g0oIiSjuU1ah0XHL0Oguzdvlv4VUwrBVEd45IDtzHrixSX8EoyfqiYr4VsAHcBkw7fca4wvuBoz07A6FppvZQVZAJaASUAmoBFQC/qcAo1dxKNy6vUZi9fyZoCklhkDTmXSSOPezPEraJXREPRk4AubyCIHRlofJNHBsPcnKwqu0f5KBC+0D14CFEoRI33kI7ADnn3XXRMjMnbp8AAAAAElFTkSuQmCC"/>
                                </svg>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 col-sm-12 select_change_conclusion_team">
                            <div class="icon-select">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="0.247cm" height="0.141cm">
                                    <path fill-rule="evenodd"  fill="rgb(17, 17, 17)" d="M7.000,1.000 L6.000,1.000 L6.000,2.000 L5.000,2.000 L5.000,3.000 L4.000,3.000 L4.000,4.000 L3.000,4.000 L3.000,3.000 L2.000,3.000 L2.000,2.000 L1.000,2.000 L1.000,1.000 L-0.000,1.000 L-0.000,-0.000 L7.000,-0.000 L7.000,1.000 Z"/>
                                </svg>
                            </div>
                            <select class="change_conclusion_team schedule_change" name="games_status" data-url="<?php echo admin_url("admin-ajax.php") ?>" data-href="Competition/getCompetitionShedule" data-comp-id="<?=$comp_id?>">
                                <option value="" selected>Все игры</option>
                                <option value="0">Запланированные</option>
                                <option value="1">Результаты</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <?php } ?>

            <div id="competition_games_block" class="text_center">

            <?php
            foreach( $shedule_data_new as $month_number => $month_games ) { 
                $month_this_competition = isset($input_data['month_this']) && !empty($input_data['month_this']) ? $input_data['month_this'] : '';
                ?>

                <?php if( $month_this_competition != $month_number ) {
                    //if( empty($input_data['stages_id']) && empty($input_data['team_id']) && empty($input_data['date_competition']) && empty($input_data['games_status']) ) { ?>
                    <div class="col-md-12 col-lg-12 col-sm-12 col-12 indent_top">
                        <span class="month_games">
                        <?=$month_number?>
                        </span>
                    </div>
                    <?php } 
                // }
                $month_this_competition = $month_number;
                ?>

                <?php foreach( $month_games as $item ) { ?>

                <div class="indent_top <?=$item['GameStatus'] == 0 ? 'future_game' : 'game_block' ?>">
                    <div class="<?=$item['GameStatus'] == 0 ? 'game_block_hr_top_disabled' : 'game_block_hr_top' ?>"></div>
                    <div class="col-md-12 col-lg-12 col-sm-12 col-12 indent_top">
                        <span class="game_block_date">
                        <?php
                        $time = strtotime($item['GameDate']);
                        $day_week = Basket::getRussianWeekDayShort(date("N", $time));
                        $date = Basket::getCurrentDate($time, true, false);
                        $date_time = $item['GameTimeMsk'];
                        echo $day_week .', '. $date .', '. $date_time .' <i class="fa fa-map-marker" aria-hidden="true"></i> '. $item['RegionRu']; ?>
                        </span>
                    </div>

                    <div class="col-md-12 col-lg-12 col-sm-12 col-12 indent_top">
                        <span class="game_block_competition">
                            <?=$item['CompNameRu'] ?>
                        </span>
                    </div>

                    <div class="col-md-12 col-lg-12 col-sm-12 col-12 indent_top">
                        <div class="row">
                            <div class="col-md-4 col-lg-4 col-sm-4 col-4 indent_bottom">
                                <span class="game_block_team_a">
                                <?=$item['TeamNameAru']?>
                                </span>
                                <span class="game_block_team_a_city">
                                <br>
                                <?='«'. $item['RegionTeamNameAru'] .'»'?>
                                </span>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4 col-4 indent_bottom">
                                <span class="<?=$item['GameStatus'] == 0 ? 'game_block_score_disabled' : 'game_block_score' ?>">
                                <?php
                                $score_a = isset($item['ScoreA']) && !empty($item['ScoreA']) ? $item['ScoreA'] : 0;
                                $score_b = isset($item['ScoreB']) && !empty($item['ScoreB']) ? $item['ScoreB'] : 0;
                                ?>
                                <?=$score_a .' : '. $score_b ?>
                                </span>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4 col-4 indent_bottom">
                                <span class="game_block_team_b">
                                <?=$item['TeamNameBru']?>
                                <br>
                                </span>
                                <span class="game_block_team_b_city">
                                <?='«'. $item['RegionTeamNameBru'] .'»'?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            <?php 
                }
            } ?>
            <?php if( !isset($input_data['offset']) && $empty >= 5 ) { ?>
                <div class="col-md-12 col-lg-12 col-sm-12 news-mini-block-all pagination-competition more_margin_top more_margin_bottom col-main-block">
                    <a class="all-news"><button class="more-shedule btn_learn_more btn_more_pag" data-url="<?php echo admin_url("admin-ajax.php") ?>" data-href="Competition/getCompetitionShedule" data-offset="5" data-comp-id="<?=$comp_id?>" data-month-this="<?=$month_this_competition?>">Показать еще</button></a>
                </div>
            <?php } ?>
            </div>
            <?php

            $content = ob_get_contents();

            ob_end_clean();
        }

        if( $empty == 0 ) {

            $category = 'competition';

            $content = Basket::getPlug( $category );

            return ['status' => true, 'content' => $content];
        }
            

        return ['status' => true, 'content' => $content, 'count_offset' => $offset + 5, 'month_this' => $month_this_competition, 'date_from' => $date_from, 'date_to' => $date_to];
    }

    static function getRequestToCompetition()
    {
        $value = 'hey';

        ob_start();

        require_once __DIR__ .'/../pages/request.php';

        $data = ob_get_contents();

        ob_end_clean();

        return $data;
    }
}