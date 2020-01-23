<?php
class Basket {

    static $months = [ 
        1 => 'Января',
        2 => 'Февраля',
        3 => 'Марта',
        4 => 'Апреля',
        5 => 'Мая',
        6 => 'Июня',
        7 => 'Июля',
        8 => 'Августа',
        9 => 'Сентября',
        10 => 'Октября',
        11 => 'Ноября',
        12 => 'Декабря'
    ];

    function autoload() {

        if( !empty($_REQUEST) && !empty($_REQUEST['url']) )
            $url = $_REQUEST['url'];
        else
            $url = $_SERVER['REQUEST_URI'];

        if( $url == '/' )
            $url = '/main';

        $url = explode('/', $url);

        $return = self::getHTMLPage($url);

        $common = self::getCommonHTML();

        $body = str_replace('{{body}}', $return, $common);

        echo $body;
    }

    static function getHTMLPage( $url ) {

        if( isset($url[2]) && !empty($url[2]) ){
            switch ($url[1]) {
                case 'news':
                    echo $url[1] = 'note';
                    break;
                case 'events':
                    echo $url[1] = 'note';
                    break;
                case 'projects':
                    echo $url[1] = 'note';
                    break;
                case 'media':
                    echo $url[1] = 'note';
                    break;
                case 'competition':
                    echo $url[1] = 'competition_page';
                    break;
                default:
                    echo 'note';
            }
        }
      
        if( stripos( $url[1], 'preview=true' ) != false){
            echo $url[1] = 'note';
        }

        if( empty($url[1]) || !file_exists(DIR_PATH . '/pages/' . $url[1] . '.php') )
            $url[1] = 'page404';

        ob_start();

        include_once DIR_PATH . '/pages/' . $url[1] . '.php';

        $data = ob_get_contents();

        ob_end_clean();

        return $data;
    }

    static function getCommonHTML()
    {
        ob_start();

        include_once DIR_PATH . '/pages/common.php';

        $data = ob_get_contents();

        ob_end_clean();

        return $data;
    }

    static function getRussianMonth( $month_number )
    {
        return self::$months[$month_number];
    }

    static function getRussianWeekDayShort( $day_number )
    {
        $days_week = [ 
            1 => 'пн',
            2 => 'вт',
            3 => 'ср',
            4 => 'чт',
            5 => 'пт',
            6 => 'сб',
            7 => 'вс',
        ];

        return $days_week[$day_number];
    }

    static function getDatePostFormat($date_post, $isset_time = true)
    {
        if( !$date_post )
            $date_post = date("Y-m-d H:i");

        $date_post = explode(' ', $date_post);
        $date_day = explode('-', $date_post[0]);
        $date_month = self::getRussianMonth( (int) $date_day[1]);

        if( $isset_time )
            $date_post_return = $date_day[2] .' '. strtolower($date_month) .' '. $date_day[0] .', '. substr($date_post[1], 0, 5);
        else
            $date_post_return = $date_day[2] .' '. strtolower($date_month) .' '. $date_day[0];

        return $date_post_return;
    }

    static function getCurrentDate( $date, $format = false, $time = true )
    {
        if( $format == true )
            $date = date("Y-m-d H:i", $date);

        $date_post = explode(' ', $date);

        $date_day = explode('-', $date_post[0]);

        $date_month = Basket::getRussianMonth( (int) $date_day[1]);

        if( $time && ( isset( $date_post[1] ) && $date_post[1] != "00:00:00" ) )
            $current_date = $date_day[2] .' '. strtolower($date_month) .' '. $date_day[0] .', '. substr($date_post[1], 0, 5);
        else
            $current_date = $date_day[2] .' '. strtolower($date_month) .' '. $date_day[0];

        return $current_date;
    }

    static function getPlug( $category, $trigger = false )
    {
        if( !$category )
            return false;

        $template_file = __DIR__.'/../'.'/assets/json'.'/'.'plug_template.json';

        if( !file_exists( $template_file ) )
            return false;
        
        $data = json_decode(file_get_contents( $template_file ));

        $body_plug = $data->$category;

        ob_start(); ?>

        <div class="col-md-12 col-lg-12 col-sm-12" style="text-align: center;">
            <!-- <div class="col-md-12 col-lg-12 col-sm-12">
                <img class="img-fluid" src="<?=get_template_directory_uri()?>/assets/images/EeX7lfClbb4.jpg" alt="404">
            </div> -->
            <div class="col-md-12 col-lg-12 col-sm-12" style="">
                <span style="font-size: 40px;">Упппс... <?=$body_plug->main?></span>
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12" style="margin-top: 30px;">
                <span style="font-size: 20px; color: gray;"><?=$body_plug->description?></span>
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12">
                <span style="font-size: 20px; color: gray;">Вы можете перейти на главную страницу.</span>
            </div>
            <div class="row justify-content-center align-items-center" style="margin-top: 30px; margin-bottom: 30px;">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <a class="all-news" href="/main"><button style="width:300px;" class="btn_learn_more">Перейти на главную</button></a>
                </div>
            </div>
        </div>

        <?php $content = ob_get_contents();

        ob_end_clean();

        return $content;

        
    }

}