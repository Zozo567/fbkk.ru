jQuery('html,body').ready(function () {

    $( "#click-menu" ).click(function() {

        var myTopNav = $( "#myTopNav" ).attr('class');
    
        if( myTopNav === "vary" )
            $( "#myTopNav" ).addClass('responsive');
        else
            $( "#myTopNav" ).removeClass('responsive');
    });

    jQuery('body').on('click', 'button.more-news', function(e){

        e.preventDefault();

        var offset = jQuery(this).data('offset');
        var url = jQuery(this).data('url');
        var href = jQuery(this).data('href');

        jQuery.ajax({
            url: url,
            data: "action=basket&href=" + href + "&offset=" + offset,
            type: "POST",
            dataType: "json",
            success: function(res){
                if( res.status == true ){
                    jQuery('body').find('div.news-block').append(res.content);
                    jQuery('body').find('button.more-news').data('offset', offset + res.count_offset);
                    if( res.count_offset < res.numberposts )
                        jQuery('body').find('.news-mini-block-all').empty();
                }
            }
        });
    });

    jQuery('body').on('click', 'button.more-calendar', function(e){

        e.preventDefault();

        var offset = jQuery(this).data('offset');
        var url = jQuery(this).data('url');
        var href = jQuery(this).data('href');
        var month_this = jQuery(this).data('month-this');

        var data = '';
        if( jQuery('body').find('#calendar-tab form').length )
            data = jQuery('body').find('#calendar-tab form').serialize();

        jQuery.ajax({
            url: url,
            data: "action=basket&href=" + href + "&offset=" + offset + "&month_this=" + month_this + '&' + data,
            type: "POST",
            dataType: "json",
            success: function(res){
                if( res.status == true ){
                    jQuery('body').find('div.pagination-calendar').before(res.content);
                    jQuery('body').find('button.more-calendar').data('offset', res.count_offset).data('month-this', res.month_this);
                    if( res.count_offset < res.numberposts )
                        jQuery('body').find('.news-mini-block-all').empty();
                }
            }
        });
    });

    jQuery('body').on('click', 'button.more-shedule', function(e){

        e.preventDefault();

        var offset = jQuery(this).data('offset');
        var url = jQuery(this).data('url');
        var href = jQuery(this).data('href');
        var competition_id = jQuery(this).data('comp-id');
        var month_this = jQuery(this).data('month-this');

        var data = '';
        if( jQuery('body').find('#schedule_games form').length )
            data = jQuery('body').find('#schedule_games form').serialize();

        jQuery.ajax({
            url: url,
            data: "action=basket&href=" + href + "&offset=" + offset + "&competition_id=" + competition_id + "&month_this=" + month_this + '&' + data,
            type: "POST",
            dataType: "json",
            success: function(res){
                if( res.status == true ){
                    jQuery('body').find('div.pagination-competition').before(res.content);
                    jQuery('body').find('button.more-shedule').data('offset', res.count_offset).data('month-this', res.month_this);
                    if( res.count_offset < res.numberposts )
                        jQuery('body').find('.news-mini-block-all').empty();
                }
            }
        });
    });

    jQuery('body').on('change', '.change_season_games', function(e){

        e.preventDefault();

        var url = jQuery(this).data('url');
        var href = jQuery(this).data('href');
        var competition_id = jQuery(this).data('competition-id');
        var season = jQuery(this).val();

        jQuery.ajax({
            url: url,
            data: "action=basket&href=" + href + "&season=" + season + "&competition_id=" + competition_id,
            type: "POST",
            dataType: "json",
            success: function(res){

                if( res.status == true ){
                    jQuery('body').find('div.competition_document_season').empty().append(res.content);
                    jQuery('body').find('button.more-news').data('offset', 1);
                } else 
                    console.log('Ошибка');
            }
        });
    });

    jQuery('body').on('submit', '.contact-form-federation', function(e){

        e.preventDefault();

       console.log("eferff");
       
       var data = jQuery(this).serialize();

       var hidden = $(this).find("input[name='hide']");

       var url = hidden.data('url');
       var href = hidden.data('href');

       jQuery.ajax({
           url: url,
           data: "action=basket&href=" + href + "&data=" + data,
           type: "POST",
           dataType: "json",
           success: function(res){
            if( res.status == true )
                // console.log(res.message);
                alert("Письмо отправлено");
            else
                // console.log(res.message);
                alert("Письмо не отправлено. Пожалуйста, повторите попытку!");
           }
       });

    });

    jQuery('body').on('change', '#calendar-tab .change_conclusion_team.schedule_change', function(){

        var url = jQuery(this).data('url');
        var href = jQuery(this).data('href');

        var data = jQuery(this).parents('form').serialize();

        jQuery('body').find('#calendar_tab_block').empty().append('<div class="spinner_center"><div class="spinner-border" role="status"><span class="sr-only"></span></div></div>');

        jQuery.ajax({
            url: url,
            data: "action=basket&href=" + href + "&" + data,
            type: "POST",
            dataType: "json",
            success: function(res){

                if( res.status == true )
                    jQuery('body').find('#calendar_tab_block').empty().append(res.content);
                else 
                    console.log('Ошибка');
            }
        });
    });

    jQuery('body').on('click', '#schedule-tab', function(){

        var url = jQuery('body').find('#schedule_games').data('url');
        var href = jQuery('body').find('#schedule_games').data('href');
        var competition_id = jQuery('body').find('#schedule_games').data('comp-id');

        jQuery('body').find('#schedule_games').empty().append('<div class="spinner_center"><div class="spinner-border" role="status"><span class="sr-only"></span></div></div>');

        jQuery.ajax({
            url: url,
            data: "action=basket&href=" + href + "&competition_id=" + competition_id,
            type: "POST",
            dataType: "json",
            success: function(res){

                if( res.status == true )
                    jQuery('body').find('#schedule_games').empty().append(res.content);
                else 
                    console.log('Ошибка');

                $('input[name="date_competition"]').daterangepicker({
                    opens: 'left',
                    locale: {
                        format: 'DD.MM.YYYY',
                        separator: " - ",
                        applyLabel: "Применить",
                        cancelLabel: "Отмена",
                        fromLabel: "От",
                        toLabel: "До",
                        customRangeLabel: "Свой",
                        daysOfWeek: [
                            "Вс",
                            "Пн",
                            "Вт",
                            "Ср",
                            "Чт",
                            "Пт",
                            "Сб"
                        ],
                        monthNames: [
                            "Январь",
                            "Февраль",
                            "Март",
                            "Апрель",
                            "Май",
                            "Июнь",
                            "Июль",
                            "Август",
                            "Сентябрь",
                            "Октябрь",
                            "Ноябрь",
                            "Декабрь"
                        ],
                        firstDay: 1
                    },
                    applyButtonClasses: 'apply-competition-date',
                    startDate: res.date_from, 
                    endDate: res.date_to,
                });
            }
        });
    });

    jQuery('body').on('click', '.apply-competition-date', function(){
        jQuery('body').find('#schedule_games .change_conclusion_team.schedule_change').trigger('change');
    });

    jQuery('body').on('change', '#schedule_games .change_conclusion_team.schedule_change', function(){

        var url = jQuery('body').find('#schedule_games').data('url');
        var href = jQuery('body').find('#schedule_games').data('href');
        var competition_id = jQuery('body').find('#schedule_games').data('comp-id');
        // var month_this = jQuery(this).data('month-this');

        var data = jQuery(this).parents('form').serialize();

        jQuery('body').find('#competition_games_block').empty().append('<div class="spinner_center"><div class="spinner-border" role="status"><span class="sr-only"></span></div></div>');

        jQuery.ajax({
            url: url,
            data: "action=basket&href=" + href + "&competition_id=" + competition_id + "&" + data,
            type: "POST",
            dataType: "json",
            success: function(res){

                if( res.status == true )
                    jQuery('body').find('#competition_games_block').empty().append(res.content);
                else 
                    console.log('Ошибка');
            }
        });
    });

    jQuery('body').on('click', '#statistics-tab', function(){

        var url = jQuery(this).data('url');
        var href = jQuery(this).data('href');
        var competition_id = jQuery(this).data('comp-id');

        var statistic = "&statistic_team=1&statistic_player=1";
        var div_id = "#statistics";

        jQuery('body').find(div_id).empty().append('<div class="spinner_center"><div class="spinner-border" role="status"><span class="sr-only"></span></div></div>');

        jQuery.ajax({
            url: url,
            data: "action=basket&href=" + href + "&competition_id=" + competition_id + statistic,
            type: "POST",
            dataType: "json",
            success: function(res){

                if( res.status == true )
                    jQuery('body').find(div_id).empty().append(res.content);
                else 
                    console.log('Ошибка');
            }
        });
    });

    jQuery('body').on('change', '#statistics .select_change_conclusion_team .change_conclusion_team', function(e){

        var url = jQuery(this).data('url');
        var href = jQuery(this).data('href');
        var competition_id = jQuery(this).data('comp-id');

        var type_figures = 'medium_figures';
        if( jQuery(this).val() == 'total_figures' )
            type_figures = 'total_figures';

        var statistic = "&statistic_team=1&statistic_player=1";
        var div_id = "#statistics";
        var more = "";

        if( jQuery(this).data('statistic').length && jQuery(this).data('statistic') == 'team' ){
            statistic = "&statistic_team=1";
            div_id = "#statistics-team";
        } else if( jQuery(this).data('statistic').length && jQuery(this).data('statistic') == 'player' ){
            statistic = "&statistic_player=1";
            div_id = "#statistics-player";
            more = jQuery(this).parents('form').serialize();
        }

        jQuery('body').find(div_id).empty().append('<div class="spinner_center"><div class="spinner-border" role="status"><span class="sr-only"></span></div></div>');

        jQuery.ajax({
            url: url,
            data: "action=basket&href=" + href + "&competition_id=" + competition_id + statistic + "&type_figures=" + type_figures + "&" + more,
            type: "POST",
            dataType: "json",
            success: function(res){

                if( res.status == true )
                    jQuery('body').find(div_id).empty().append(res.content);
                else 
                    console.log('Ошибка');
            }
        });
    });

    jQuery('body').on('click', '.more-photos-media-galery', function(e){

        e.preventDefault();

        var _this = jQuery(this);

        var url = jQuery(this).data('url');
        var href = jQuery(this).data('href');
        var post_id = jQuery(this).data('post-id');
        var offset = jQuery(this).data('offset');

        jQuery.ajax({
            url: url,
            data: "action=basket&href=" + href + "&post_id=" + post_id + "&offset=" + offset,
            type: "POST",
            dataType: "json",
            success: function(res){
                if( res.status == true ){

                    jQuery('body').find('.get_more_photo_media').append(res.content);
                    _this.data('offset', res.count_offset);

                    if( res.count_content < 9 )
                        jQuery('body').find('.more-photos-media-galery-block').empty();
                    
                } else 
                    console.log('Ошибка');
            }
        });
    });
    
    jQuery('body').on('click', '.search_posts', function(e){

        e.preventDefault();

        jQuery('body').find('.seach_posts_div').append('<div class="search_posts_div_form">' + 
                                                            '<form id="search_posts_form">' +
                                                                '<i class="fa fa-search search_posts_input_icon" aria-hidden="true"></i>' +  
                                                                '<input class="form-control search_posts_input" type="text" name="search_value" placeholder="Поиск" autocomplete="off">' +
                                                                '<i class="fa fa-times search_posts_input_icon_close" aria-hidden="true"></i>' +
                                                            '</form>' +
                                                        '</div>');

        jQuery('body').find('input.search_posts_input').trigger('focus');
    });

    jQuery('body').on('click', '.search_posts_input_icon_close', function(e){
        e.preventDefault();
        jQuery(this).parents('div.search_posts_div_form').remove();
    });

    jQuery('body').on('submit', 'form#search_posts_form', function(e){

        e.preventDefault();

        var data = jQuery(this).children('input[name="search_value"]').val();

        window.location.replace('/search?query=' + data);
    });

    $( "div.mouse-hover-class-check" ).mouseover(function() {
        $( this ).css({'transition':'0.5s', 'filter':'brightness(100%)'});
        $( this ).find('div.gradient-hover-id').css({'transition':'0.5s', 'opacity':'0.6'});
        $( this ).parent('a').find('span.more').addClass('learn-more-color-hover');
        
    });
    $( "div.mouse-hover-class-check" ).mouseleave(function() {
        $( this ).css({'transition':'0.5s', 'filter':'brightness(50%)'});
        $( this ).find('div.gradient-hover-id').css({'transition':'0.5s', 'opacity':'0'});
        $( this ).parent('a').find('span.more').removeClass('learn-more-color-hover');
    });

    $( "div.mouse-hover-class-one" ).mouseover(function() {
        // $( this ).find('div.mouse-hover-class-check').css({'filter':'brightness(100%)'});
        // $( this ).find('div.gradient-hover-id').addClass('gradient-hover');
        // $( this ).css({'transition':'0.5s', 'filter':'brightness(100%)'});
        $( this ).find('div.gradient-hover-id').css({'transition':'0.5s', 'opacity':'0.6'});
		$( this ).find('span.learn-more').addClass('learn-more-color-hover');
    });
    $( "div.mouse-hover-class-one" ).mouseleave(function() {
        // $( this ).find('div.mouse-hover-class-check').css({'filter':'brightness(50%)'});
        // $( this ).find('div.gradient-hover-id').removeClass('gradient-hover');
        // $( this ).css({'transition':'0.5s', 'filter':'brightness(50%)'});
        $( this ).find('div.gradient-hover-id').css({'transition':'0.5s', 'opacity':'0'});
		$( this ).find('span.learn-more').removeClass('learn-more-color-hover');
    });

    $( "div.mouse-class-main-news-hover" ).mouseover(function() {
        // $( this ).find('div.gradient-hover-id').addClass('gradient-hover');
        $( this ).find('div.gradient-hover-id').css({'transition':'0.5s', 'opacity':'0.6'});
		$( this ).find('span.learn-more').addClass('learn-more-color-hover');
    });
    $( "div.mouse-class-main-news-hover" ).mouseleave(function() {
        // $( this ).find('div.gradient-hover-id').removeClass('gradient-hover');
        $( this ).find('div.gradient-hover-id').css({'transition':'0.5s', 'opacity':'0'});
		$( this ).find('span.learn-more').removeClass('learn-more-color-hover');
    });
    
    $( "div.mouse-hover-class-one-event-right" ).mouseover(function() {
		$( this ).find('span.learn-more').addClass('learn-more-color-hover');
    });
    $( "div.mouse-hover-class-one-event-right" ).mouseleave(function() {
		$( this ).find('span.learn-more').removeClass('learn-more-color-hover');
	});
	
	// $( "div.event-block" ).mouseover(function() {
    //     // $( this ).find('div.mouse-hover-class-event').css({'filter':'brightness(100%)'});
	// 	$( this ).find('div.gradient-hover-id').addClass('gradient-hover');
	// 	$( this ).find('span.learn-more').addClass('learn-more-color-hover');
    // });
    // $( "div.event-block" ).mouseleave(function() {
    //     // $( this ).find('div.mouse-hover-class-event.litle-news-block').css({'filter':'brightness(50%)'});
	// 	$( this ).find('div.gradient-hover-id').removeClass('gradient-hover');
	// 	$( this ).find('span.learn-more').removeClass('learn-more-color-hover');
    // });

    $( "div.a_hover_svg" ).mouseover(function() {
        $( this ).find('a.base_icon').css({'display':'none'});
        $( this ).find('a.hover_icon').css({'display':'block'});
    });
    $( "div.a_hover_svg" ).mouseleave(function() {
        $( this ).find('a.base_icon').css({'display':'block'});
        $( this ).find('a.hover_icon').css({'display':'none'});
    });

    (function( $ ){

        $(function() {
        
          $('.rf').each(function(){
            // Объявляем переменные (форма и кнопка отправки)
            var form = $(this),
                btn = form.find('.btn_submit');
        
            // Добавляем каждому проверяемому полю, указание что поле пустое
            form.find('.rfield').addClass('empty_field');
        
            // Функция проверки полей формы
            function checkInput(){
              form.find('.rfield').each(function(){
                if($(this).val() != ''){
                  // Если поле не пустое удаляем класс-указание
                $(this).removeClass('empty_field');
                } else {
                  // Если поле пустое добавляем класс-указание
                $(this).addClass('empty_field');
                }
              });
            }
        
            // Функция подсветки незаполненных полей
            function lightEmpty(){
              form.find('.empty_field').css({'border-color':'#d8512d'});
              // Через полсекунды удаляем подсветку
              setTimeout(function(){
                form.find('.empty_field').removeAttr('style');
              },500);
            }
        
            // Проверка в режиме реального времени
            setInterval(function(){
              // Запускаем функцию проверки полей на заполненность
              checkInput();
              // Считаем к-во незаполненных полей
              var sizeEmpty = form.find('.empty_field').length;
              // Вешаем условие-тригер на кнопку отправки формы
              if(sizeEmpty > 0){
                if(btn.hasClass('disabled')){
                  return false
                } else {
                  btn.addClass('disabled')
                }
              } else {
                btn.removeClass('disabled')
              }
            },500);
        
            // Событие клика по кнопке отправить
            btn.click(function(){
              if($(this).hasClass('disabled')){
                // подсвечиваем незаполненные поля и форму не отправляем, если есть незаполненные поля
                lightEmpty();
                return false
              } else {
                // Все хорошо, все заполнено, отправляем форму
                form.submit();
              }
            });
          });
        });
        
    })( jQuery );
});
