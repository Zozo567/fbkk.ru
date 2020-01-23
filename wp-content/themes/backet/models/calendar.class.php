<?php
class Calendar {

    static function getCalendar( $comp_id_data = false, $interseasonal = false ) 
    {
        $input_data = $_POST;

        if( !$comp_id_data ) {
            $page = 'calendar';
            $page_data = get_page_by_path($page);
            $comp_id_data = get_field('competition_id', $page_data->ID);
        }

        if( $interseasonal ){

            $category = 'calendar';

            $content = Basket::getPlug( $category );

            return ['status' => true, 'interseasonal' => 1, 'content' => $content];
        }

        // $comp_id_data = json_decode($comp_id, true);

        $seasons_data = [];
        $year_born_data = [];

        foreach( $comp_id_data as $season_years => $comp_id_one ){

            if( !isset($seasons_data[$comp_id_one['season_competition']]) )
                $seasons_data[$comp_id_one['season_competition']] = $comp_id_one['season_competition'];

            foreach( $comp_id_one['years_born'] as $year_born => $val ){

                if( !isset($year_born_data[$val['year_born']]) )
                    $year_born_data[$val['year_born']] = $val['year_born'];

                $shedule = @file_get_contents('https://reg.infobasket.ru/Widget/CalendarCarousel/'. $val['id'] .'?format=json&from=today-365&max=1000&to=today%2B365');
                $temp_data = json_decode($shedule, true);
                foreach( $temp_data as &$shedule_val ){
                    $shedule_val += [
                        'season_years' => $comp_id_one['season_competition'],
                        'year_born' => $val['year_born'],
                    ];
                }
                $shedule_data_all[] = $temp_data;
            }
        }
        $shedule_data_all = array_reduce($shedule_data_all, 'array_merge', []);

        $offset = isset($input_data['offset']) && !empty($input_data['offset']) ? $input_data['offset'] : 0;

        $empty = 0; // если ничего не найдено

        // фильтр по играм
        foreach( $shedule_data_all as $item ){
            $seasons_id = isset($input_data['seasons_id']) && !empty($input_data['seasons_id']) ? $input_data['seasons_id'] : $item['season_years'];
            $stages_id = isset($input_data['stages_id']) && !empty($input_data['stages_id']) ? $input_data['stages_id'] : $item['CompNameRu'];
            $year_born_id = isset($input_data['year_born_id']) && !empty($input_data['year_born_id']) ? $input_data['year_born_id'] : $item['year_born'];

            if( ($item['season_years'] == $seasons_id) && ($item['CompNameRu'] == $stages_id && $item['year_born'] == $year_born_id) ) {
                
                $shedule_data[] = $item;
                $empty++; // подсчет количества игр
            }
        }

        $shedule_data = array_slice($shedule_data, $offset, 5);

        // деление общего массива игр по месяцам
        foreach( $shedule_data as $item ) {
            foreach( Basket::$months as $month_number => $month_name ){
                $time = strtotime($item['GameDate']);
                $year = date("Y", $time);
                $month_games = Basket::$months[$month_number] .' '. $year; 
                if( $month_number == date("m", $time) ){
                    $item['timestamp_date'] = $time;
                    $shedule_data_new[$month_games][] = $item;
                }
            }
        }

        // сортировка всех массивов по врменени (по возрастанию)
        foreach( $shedule_data_new as $month_name => $month_data ){
            usort($shedule_data_new[$month_name], function($a, $b){
                return ($a['timestamp_date'] - $b['timestamp_date']);
            });
        }

        $stages = [];
        foreach( $shedule_data_all as $item ) {
            if( !isset($stages[$item['CompNameRu']]) )
                $stages[$item['CompNameRu']] = $item['CompNameRu'];
        }

        ob_start(); ?>

        <?php if( !isset($input_data['stages_id']) && !isset($input_data['team_id']) && !isset($input_data['date_from']) && !isset($input_data['date_to']) && !isset($input_data['games_status']) && !isset($input_data['offset']) ) { ?>
        <div class="col-md-12 col-lg-12 col-sm-12 col-12">
            <form>
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-sm-12 select_change_conclusion_team">
                        <div class="icon-select">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="0.247cm" height="0.141cm">
                                <path fill-rule="evenodd"  fill="rgb(17, 17, 17)" d="M7.000,1.000 L6.000,1.000 L6.000,2.000 L5.000,2.000 L5.000,3.000 L4.000,3.000 L4.000,4.000 L3.000,4.000 L3.000,3.000 L2.000,3.000 L2.000,2.000 L1.000,2.000 L1.000,1.000 L-0.000,1.000 L-0.000,-0.000 L7.000,-0.000 L7.000,1.000 Z"/>
                            </svg>
                        </div>
                        <select class="change_conclusion_team schedule_change" name="seasons_id" data-url="<?php echo admin_url("admin-ajax.php") ?>" data-href="Calendar/getCalendar">
                            <option value="" selected>Все сезоны</option>
                            <?php foreach( $seasons_data as $k => $v ){ ?>
                            <option value="<?=$k?>"><?=$v?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-12 select_change_conclusion_team">
                        <div class="icon-select">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="0.247cm" height="0.141cm">
                                <path fill-rule="evenodd"  fill="rgb(17, 17, 17)" d="M7.000,1.000 L6.000,1.000 L6.000,2.000 L5.000,2.000 L5.000,3.000 L4.000,3.000 L4.000,4.000 L3.000,4.000 L3.000,3.000 L2.000,3.000 L2.000,2.000 L1.000,2.000 L1.000,1.000 L-0.000,1.000 L-0.000,-0.000 L7.000,-0.000 L7.000,1.000 Z"/>
                            </svg>
                        </div>
                        <select class="change_conclusion_team schedule_change" name="stages_id" data-url="<?php echo admin_url("admin-ajax.php") ?>" data-href="Calendar/getCalendar">
                            <option value="" selected>Все турниры</option>
                            <?php foreach( $stages as $k => $v ){ ?>
                            <option value="<?=$k?>"><?=$v?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-12 select_change_conclusion_team">
                        <div class="icon-select">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="0.247cm" height="0.141cm">
                                <path fill-rule="evenodd"  fill="rgb(17, 17, 17)" d="M7.000,1.000 L6.000,1.000 L6.000,2.000 L5.000,2.000 L5.000,3.000 L4.000,3.000 L4.000,4.000 L3.000,4.000 L3.000,3.000 L2.000,3.000 L2.000,2.000 L1.000,2.000 L1.000,1.000 L-0.000,1.000 L-0.000,-0.000 L7.000,-0.000 L7.000,1.000 Z"/>
                            </svg>
                        </div>
                        <select class="change_conclusion_team schedule_change" name="year_born_id" data-url="<?php echo admin_url("admin-ajax.php") ?>" data-href="Calendar/getCalendar">
                            <option value="" selected>Все возрастные группы</option>
                            <?php foreach( $year_born_data as $k => $v ){ ?>
                            <option value="<?=$k?>"><?=$v?> года рождения</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <div id="calendar_tab_block" class="col-md-12 col-lg-12 col-sm-12 col-12 text_center col-main-block">

        <?php } 

        foreach( $shedule_data_new as $month_number => $month_games ) { 
            $month_this_competition = isset($input_data['month_this']) && !empty($input_data['month_this']) ? $input_data['month_this'] : '';
            ?>
            <?php if( $month_this_competition != $month_number ) {
                //if( empty($input_data['stages_id']) && empty($input_data['team_id']) && empty($input_data['date_from']) && empty($input_data['date_to']) && empty($input_data['games_status']) ) { ?>
                <div class="col-md-12 col-lg-12 col-sm-12 col-12 indent_top">
                    <span class="month_games">
                    <?=$month_number?>
                    </span>
                </div>
                <?php } 
            //}
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
            <div class="col-md-12 col-lg-12 col-sm-12 news-mini-block-all pagination-calendar more_margin_top more_margin_bottom col-main-block">
                <a class="all-news"><button class="more-calendar btn_learn_more btn_more_pag" data-url="<?php echo admin_url("admin-ajax.php") ?>" data-href="Calendar/getCalendar" data-offset="5" data-month-this="<?=$month_this_competition?>">Показать еще</button></a>
            </div>
        <?php } ?>
        <?php if( !isset($input_data['stages_id']) && !isset($input_data['team_id']) && !isset($input_data['date_from']) && !isset($input_data['date_to']) && !isset($input_data['games_status']) && !isset($input_data['offset']) ) { ?>
        </div>
        <?php } ?>
        <?php

        $content = ob_get_contents();

        ob_end_clean();

        if( $empty == 0 ) {

            $category = 'competition';

            $content = Basket::getPlug( $category );

            return ['status' => true, 'content' => $content];
        }

        return ['status' => true, 'content' => $content, 'count_offset' => $offset + 5, 'month_this' => $month_this_competition];
    }
}