<!-- <span style="color: #fff; position: absolute; top: -50px; font-size: 250%;">Календарь</span> -->
<div class="col-md-12 col-lg-12 col-sm-12 page-name-header-news col-main-block">
    <span>Календарь</span>
</div>

<div class="container">
    <div class="row body-block body-block-calendar" id="calendar-tab">
    <?php
        $page_url = explode( '/', $_SERVER['REQUEST_URI'] );
        $page = $page_url[1];
        $page_data = get_page_by_path( $page );
        $competition_id = get_field( 'competition_id', $page_data->ID );
        $interseasonal = ( get_field( 'interseasonal', $page_data->ID ) == "1" ) ? true : false;
        $return = Calendar::getCalendar( $competition_id, $interseasonal ); 
        echo $Calendar = $return['content']; ?>
    </div>
</div>