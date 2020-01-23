<?php
class Statistic {

    static function getStatisticAll( $comp_id = false )
    {
        if( !$comp_id )
            $comp_id = $_POST['competition_id'];

        if( isset($_POST['statistic_team']) && !empty($_POST['statistic_team']) )
            $statistic_team = self::getStatisticTeam( $comp_id )['content'];
        else
            $statistic_team = '';

        if( isset($_POST['statistic_player']) && !empty($_POST['statistic_player']) )
            $statistic_player = self::getStatisticPlayer( $comp_id )['content'];
        else
            $statistic_player = '';

        $statistic_all = $statistic_team . $statistic_player;

        return ['status' => true, 'content' => $statistic_all];
    }

    static function getStatisticTeam( $comp_id ) 
    {
        $best_teams = @file_get_contents('https://reg.infobasket.ru/Comp/GetTeamStats/'. $comp_id .'?page=0&lang=ru&var=0&tab=0&param=1');
        $best_teams_json = json_decode($best_teams, true);

        if( !empty($best_teams_json) ){

            // Если нужно будет ограничение по выводу команд в статистики, то поменять следующие строчки местами
            // $best_teams_data = array_slice($best_teams_json['Stats'], 0, 4);
            $best_teams_data = $best_teams_json['Stats'];

            ob_start(); 
            // лучшие команды этого соревнования
            if( !isset($_POST['type_figures']) ) {
            ?>
                <div class="col-md-12 col-lg-12 col-sm-12 col-12 title_statistic_table">
                    <span>Статистика команд</span>
                </div>
                <div class="col-md-12 col-lg-12 col-sm-12 col-12 div_change_conclusion_team">
                    <div>
                        <div class="col-md-6 col-lg-4 col-sm-12 select_change_conclusion_team">
                            <div class="icon-select">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="0.247cm" height="0.141cm">
                                    <path fill-rule="evenodd"  fill="rgb(17, 17, 17)" d="M7.000,1.000 L6.000,1.000 L6.000,2.000 L5.000,2.000 L5.000,3.000 L4.000,3.000 L4.000,4.000 L3.000,4.000 L3.000,3.000 L2.000,3.000 L2.000,2.000 L1.000,2.000 L1.000,1.000 L-0.000,1.000 L-0.000,-0.000 L7.000,-0.000 L7.000,1.000 Z"/>
                                </svg>
                            </div>
                            <select class="change_conclusion_team" data-url="<?php echo admin_url("admin-ajax.php") ?>" data-href="Statistic/getStatisticAll" data-comp-id="<?=$comp_id?>" data-statistic="team">
                                <option value="medium_figures" selected>Средние показатели</option>
                                <option value="total_figures">Cуммарные показатели</option>
                            </select>
                        </div>
                    </div>
                </div>
            <div class="col-md-12 col-lg-12 col-sm-12 col-12 table_scroll" id="statistics-team">
            <?php } ?>
                <div class="outer">
                    <div class="inner">
                        <table class="table statistic_table">
                            <thead>
                                <tr>
                                    <td class="table_fixed_left">Команда</td>
                                    <td>Игры</td>
                                    <td>Очки</td>
                                    <td>% 2-х очковых</td>
                                    <td>% 3-х очковых</td>
                                    <td>% штрафных</td>
                                    <td>Передачи</td>
                                    <td>Подборы</td>
                                    <td>Перехваты</td>
                                    <td>Потери</td>
                                    <td>Блонкшоты</td>
                                    <td>Фолы</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                                $co = 0;
                                foreach( $best_teams_data as $item ){ ?>
                                <tr>
                                    <?php 
                                    if( $co == 0 ){
                                        $class_border = "bord";
                                        $co = 1;
                                    } else{
                                        $class_border = "";
                                        $class_border = "";
                                    }
                                    
                                    if( isset($_POST['type_figures']) && !empty($_POST['type_figures']) && $_POST['type_figures'] == 'total_figures' ){?>
                                        <td class="table_fixed_left <?=$class_border?>"><?=!empty($item['TeamName']['CompTeamShortNameRu']) ? $item['TeamName']['CompTeamShortNameRu'] : '-' ?></td>
                                        <td><?=!empty($item['GameCount']) ? $item['GameCount'] : '-'?></td>
                                        <td><?=!empty($item['Points']) ? $item['Points'] : '-'?></td>
                                        <td><?=!empty($item['Shot2Percent']) ? $item['Shot2Percent'] : '-'?></td>
                                        <td><?=!empty($item['Shot3Percent']) ? $item['Shot3Percent'] : '-'?></td>
                                        <td><?=!empty($item['Shot1Percent']) ? $item['Shot1Percent'] : '-'?></td>
                                        <td><?=!empty($item['Assist']) ? $item['Assist'] : '-'?></td>
                                        <td><?=!empty($item['Rebound']) ? $item['Rebound'] : '-'?></td>
                                        <td><?=!empty($item['Steal']) ? $item['Steal'] : '-'?></td>
                                        <td><?=!empty($item['Turnover']) ? $item['Turnover'] : '-'?></td>
                                        <td><?=!empty($item['Blocks']) ? $item['Blocks'] : '-'?></td>
                                        <td><?=!empty($item['Foul']) ? $item['Foul'] : '-'?></td>
                                    <?php } else { ?>
                                        <td class="table_fixed_left <?=$class_border?>"><?=!empty($item['TeamName']['CompTeamShortNameRu']) ? $item['TeamName']['CompTeamShortNameRu'] : '-' ?></td>
                                        <td><?=!empty($item['GameCount']) ? $item['GameCount'] : '-'?></td>
                                        <td><?=!empty($item['AvgPoints']) ? $item['AvgPoints'] : '-'?></td>
                                        <td><?=!empty($item['Shot2Percent']) ? $item['Shot2Percent'] : '-'?></td>
                                        <td><?=!empty($item['Shot3Percent']) ? $item['Shot3Percent'] : '-'?></td>
                                        <td><?=!empty($item['Shot1Percent']) ? $item['Shot1Percent'] : '-'?></td>
                                        <td><?=!empty($item['AvgAssist']) ? $item['AvgAssist'] : '-'?></td>
                                        <td><?=!empty($item['AvgRebound']) ? $item['AvgRebound'] : '-'?></td>
                                        <td><?=!empty($item['AvgSteal']) ? $item['AvgSteal'] : '-'?></td>
                                        <td><?=!empty($item['AvgTurnover']) ? $item['AvgTurnover'] : '-'?></td>
                                        <td><?=!empty($item['AvgBlocks']) ? $item['AvgBlocks'] : '-'?></td>
                                        <td><?=!empty($item['AvgFoul']) ? $item['AvgFoul'] : '-'?></td>
                                    <?php } ?>
                                </tr>
                            <?php $co = 1;} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php if( !isset($_POST['type_figures']) ) { ?>
            <?php } ?>
            </div>
            <?php

            $content = ob_get_contents();

            ob_end_clean();
        
        } else
            $content = '';

        return ['status' => true, 'content' => $content];
    }

    static function getStatisticPlayer( $comp_id, $count_players = false ) 
    {
        if( !$count_players )
            $count_players = isset($_GET['count_players']) && !empty($_GET['count_players']) ? $_GET['count_players'] : 2000;

        $best_teams = @file_get_contents('https://reg.infobasket.ru/Comp/GetTeamStats/'. $comp_id .'?page=0&lang=ru&var=0&tab=0&param=1');
        $best_teams_data = json_decode($best_teams, true)['Stats'];

        if( !empty($best_teams_data) ) {

            $best_players_link = 'https://reg.infobasket.ru/Widget/BestPlayers/'. $comp_id .'?format=json&max='. $count_players .'&param=1&lang=ru';
            $best_players = @file_get_contents($best_players_link);
            $best_players_data = json_decode($best_players, true);

            if( !empty($best_players_data) ) {
                
                ob_start(); 
                // лучшие игроки этого соревнования
                ?>
                <?php if( !isset($_POST['team_id']) && !isset($_POST['count_players']) && !isset($_POST['type_figures']) ) { ?>
                    <div class="col-md-12 col-lg-12 col-sm-12 col-12 title_statistic_table">
                        <span>Статистика игроков</span>
                    </div>
                    <form>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-12 div_change_conclusion_team">
                            <div class="row row-block-statistic">
                                <div class="col-md-4 col-lg-4 col-sm-12 select_change_conclusion_team">
                                    <select class="change_conclusion_team" name="type_figures" data-url="<?php echo admin_url("admin-ajax.php") ?>" data-href="Statistic/getStatisticAll" data-comp-id="<?=$comp_id?>" data-statistic="player">
                                        <option value="medium_figures" selected>Средние показатели</option>
                                        <option value="total_figures">Cуммарные показатели</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-lg-4 col-sm-12 select_change_conclusion_team">
                                    <select class="change_conclusion_team" name="team_id" data-url="<?php echo admin_url("admin-ajax.php") ?>" data-href="Statistic/getStatisticAll" data-comp-id="<?=$comp_id?>" data-statistic="player">
                                        <option value="" selected>Выберите команду</option>
                                        <?php foreach( $best_teams_data as $it ){ ?>
                                        <option value="<?=$it['TeamID']?>"><?=$it['TeamName']['CompTeamShortNameRu']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-4 col-lg-4 col-sm-12 select_change_conclusion_team">
                                    <select class="change_conclusion_team" name="count_players" data-url="<?php echo admin_url("admin-ajax.php") ?>" data-href="Statistic/getStatisticAll" data-comp-id="<?=$comp_id?>" data-statistic="player">
                                        <option value="10" selected>Первые 10 игроков</option>
                                        <option value="25">Первые 25 игроков</option>
                                        <option value="50">Первые 50 игроков</option>
                                        <option value="2000">Все игроки</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-12 col-lg-12 col-sm-12 col-12 table_scroll" id="statistics-player">
                <?php } ?>
                <div class="outer">
                    <div class="inner">
                        <table class="table statistic_table">
                            <thead>
                                <tr>
                                    <td class="table_fixed_left">Игроков</td>
                                    <td>Игры</td>
                                    <td>Очки</td>
                                    <td>% 2-х очковых</td>
                                    <td>% 3-х очковых</td>
                                    <td>% штрафных</td>
                                    <td>Передачи</td>
                                    <td>Подборы</td>
                                    <td>Перехваты</td>
                                    <td>Потери</td>
                                    <td>Блонкшоты</td>
                                    <td>Фолы</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $count = 0;
                            $count_players = isset($_POST['count_players']) && !empty($_POST['count_players']) ? $_POST['count_players'] : 10;
                            foreach( $best_players_data as $item ) { 
                                    foreach( $best_teams_data as $val ) { 
                                        foreach( $val['Players'] as $value ) {

                                            $team_id = isset($_POST['team_id']) && !empty($_POST['team_id']) ? $_POST['team_id'] : $item['TeamName']['TeamID'];

                                            if( $value['PersonInfo']['PersonID'] == $item['Person']['PersonID'] && $item['TeamName']['TeamID'] == $team_id ){ 
                                                
                                                if( $count >= $count_players )
                                                    continue;
                                                ?>
                                        <tr>
                                            <?php if( isset($_POST['type_figures']) && !empty($_POST['type_figures']) && $_POST['type_figures'] == 'total_figures' ){ ?>
                                                <td class="table_fixed_left"><?=!empty($value['PersonInfo']['PersonFullNameRu']) ? $value['PersonInfo']['PersonFullNameRu'] : '-' ?></td>
                                                <td><?=!empty($value['GameCount']) ? $value['GameCount'] : '-'?></td>
                                                <td><?=!empty($value['Points']) ? $value['Points'] : '-'?></td>
                                                <td><?=!empty($value['Shot2Percent']) ? $value['Shot2Percent'] : '-'?></td>
                                                <td><?=!empty($value['Shot3Percent']) ? $value['Shot3Percent'] : '-'?></td>
                                                <td><?=!empty($value['Shot1Percent']) ? $value['Shot1Percent'] : '-'?></td>
                                                <td><?=!empty($value['Assist']) ? $value['Assist'] : '-'?></td>
                                                <td><?=!empty($value['Rebound']) ? $value['Rebound'] : '-'?></td>
                                                <td><?=!empty($value['Steal']) ? $value['Steal'] : '-'?></td>
                                                <td><?=!empty($value['Turnover']) ? $value['Turnover'] : '-'?></td>
                                                <td><?=!empty($value['Blocks']) ? $value['Blocks'] : '-'?></td>
                                                <td><?=!empty($value['Foul']) ? $value['Foul'] : '-'?></td>
                                            <?php } else { ?>
                                                <td class="table_fixed_left"><?=!empty($value['PersonInfo']['PersonFullNameRu']) ? $value['PersonInfo']['PersonFullNameRu'] : '-' ?></td>
                                                <td><?=!empty($value['GameCount']) ? $value['GameCount'] : '-'?></td>
                                                <td><?=!empty($value['AvgPoints']) ? $value['AvgPoints'] : '-'?></td>
                                                <td><?=!empty($value['Shot2Percent']) ? $value['Shot2Percent'] : '-'?></td>
                                                <td><?=!empty($value['Shot3Percent']) ? $value['Shot3Percent'] : '-'?></td>
                                                <td><?=!empty($value['Shot1Percent']) ? $value['Shot1Percent'] : '-'?></td>
                                                <td><?=!empty($value['AvgAssist']) ? $value['AvgAssist'] : '-'?></td>
                                                <td><?=!empty($value['AvgRebound']) ? $value['AvgRebound'] : '-'?></td>
                                                <td><?=!empty($value['AvgSteal']) ? $value['AvgSteal'] : '-'?></td>
                                                <td><?=!empty($value['AvgTurnover']) ? $value['AvgTurnover'] : '-'?></td>
                                                <td><?=!empty($value['AvgBlocks']) ? $value['AvgBlocks'] : '-'?></td>
                                                <td><?=!empty($value['AvgFoul']) ? $value['AvgFoul'] : '-'?></td>
                                            <?php
                                            }
                                            $count++;
                                            if( $count >= $count_players )
                                                continue;
                                            ?>
                                        </tr>
                            <?php       
                                    }
                                    }
                                }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if( !isset($_POST['team_id']) && !isset($_POST['count_players']) && !isset($_POST['type_figures']) ) { ?>
                </div>
                <?php } ?>
                </div>
                <?php

                $content = ob_get_contents();

                ob_end_clean();

            } else
                $content = '';
        
        } else
            $content = '';

        return ['status' => true, 'content' => $content];
    }
}