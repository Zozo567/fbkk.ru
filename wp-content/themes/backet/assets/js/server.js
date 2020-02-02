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

    // Add one player or trainer to request list
    jQuery('body').on('click', '.add-to-list-request', function(e){

        e.preventDefault();

        _this = jQuery(this);

        var type = _this.data('type');

        var block_type = _this.parents('.request-' + type + '-block');

        var count_type = jQuery('#' + type + '-list tr').length + 1;

        var name = block_type.find('input[name="' + type + '[0][Name]"]:not([type=hidden])');
        var second_name = block_type.find('input[name="' + type + '[0][SecondName]"]:not([type=hidden])');
        var last_name = block_type.find('input[name="' + type + '[0][LastName]"]:not([type=hidden])');
        var date_born = block_type.find('input[name="' + type + '[0][DateBorn]"]:not([type=hidden])');
        var area = block_type.find('input[name="' + type + '[0][Area]"]:not([type=hidden])');

        var name_val = name.val();
        var second_name_val = second_name.val();
        var last_name_val = last_name.val();
        var date_born_val = date_born.val();
        var area_val = area.val();

        var fl = true;

        if( name_val == "" ){
            block_type.find('input[name="' + type + '[0][Name]"]:not([type=hidden])').addClass('is-invalid');
            fl = false;
        }
        if( second_name_val == "" ){
            block_type.find('input[name="' + type + '[0][SecondName]"]:not([type=hidden])').addClass('is-invalid');
            fl = false;
        }
        if( last_name_val == "" ){
            block_type.find('input[name="' + type + '[0][LastName]"]:not([type=hidden])').addClass('is-invalid');
            fl = false;
        }
        if( date_born_val == "" ){
            block_type.find('input[name="' + type + '[0][DateBorn]"]:not([type=hidden])').addClass('is-invalid');
            fl = false;
        }
        if( area_val == "" ){
            block_type.find('input[name="' + type + '[0][Area]"]:not([type=hidden])').addClass('is-invalid');
            fl = false;
        }

        if( fl == true ){
            block_type.find('#' + type + '-list')
            .append('<tr>' 
                + '<td>'
                    + '<div class="row">'
                        + '<div class="col-lg-4 col-md-4 col-sm-12">'
                            + '<p class="info_point">' + name.val() + ' ' + second_name.val() + ' ' + last_name.val() + '</p>'
                            + '<input type="hidden" name="' + type + '[' + count_type + '][Name]" value="' + name.val() + '">'
                            + '<input type="hidden" name="' + type + '[' + count_type + '][SecondName]" value="' + second_name.val() + '">'
                            + '<input type="hidden" name="' + type + '[' + count_type + '][LastName]" value="' + last_name.val() + '">'
                        +'</div>'
    
                        + '<div class="col-lg-4 col-md-4 col-sm-12">'
                            + '<p class="info_point">' + date_born.val() + '</p>'
                            + '<input type="hidden" name="' + type + '[' + count_type + '][DateBorn]" value="' + date_born.val() + '">'
                        + '</div>'
    
                        + '<div class="col-lg-4 col-md-4 col-sm-12">'
                            + '<p class="info_point">'+ area.val() + '</p>'
                            + '<input type="hidden" name="' + type + '[' + count_type + '][Area]" value="' + area.val() + '">'
                        + '</div>'
    
                    + '</div>'
    
                + '<td>'
    
                + '<td class="add_bin">'
                    + '<a href="" class="request-delete-one-note"><i class="fa fa-trash" aria-hidden="true" style="color:#00A3E3;"></i></a>'
                + '</td>'
                + '</tr>');
                
            name.val('');
            second_name.val('');
            last_name.val('');
            date_born.val('');
            area.val('');
        }else{

            setTimeout(function(){
                $( ".is-invalid" ).each(function() {
                    $( this ).removeClass( "is-invalid" );
                });
            }, 2000);
        }
        
    });

    // Delete one player or trainer from request list
    jQuery('body').on('click', '.request-delete-one-note', function(e){

        e.preventDefault();

        jQuery(this).parents('tr').remove();
    });

    // Submit form add request players and trainers
    jQuery('body').on('submit', '#requetst_form', function(e){

        e.preventDefault();

        var _this = jQuery(this);

        var url = _this.data('url');
        var href = _this.data('href');
        var data = _this.serialize();

        _this.find('.loader-gif').css('display', 'block');

        jQuery.ajax({
            url: url,
            data: "action=basket&href=" + href + "&" + data,
            type: "POST",
            dataType: "json",
            success: function(res){
                if( res.status == true ){
                    _this.find('.loader-gif').css('display', 'none');
                    window.location.reload();
                }
            }
        });
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

    // !!!!!!! КОСТЫЛЬ
    // при подключении через скрипт в хэдере не работает
    // даже близко не понимаю почему
    /*
    jQuery Masked Input Plugin
    Copyright (c) 2007 - 2015 Josh Bush (digitalbush.com)
    Licensed under the MIT license (http://digitalbush.com/projects/masked-input-plugin/#license)
    Version: 1.4.1
    */
    !function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a("object"==typeof exports?require("jquery"):jQuery)}(function(a){var b,c=navigator.userAgent,d=/iphone/i.test(c),e=/chrome/i.test(c),f=/android/i.test(c);a.mask={definitions:{9:"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"},autoclear:!0,dataName:"rawMaskFn",placeholder:"_"},a.fn.extend({caret:function(a,b){var c;if(0!==this.length&&!this.is(":hidden"))return"number"==typeof a?(b="number"==typeof b?b:a,this.each(function(){this.setSelectionRange?this.setSelectionRange(a,b):this.createTextRange&&(c=this.createTextRange(),c.collapse(!0),c.moveEnd("character",b),c.moveStart("character",a),c.select())})):(this[0].setSelectionRange?(a=this[0].selectionStart,b=this[0].selectionEnd):document.selection&&document.selection.createRange&&(c=document.selection.createRange(),a=0-c.duplicate().moveStart("character",-1e5),b=a+c.text.length),{begin:a,end:b})},unmask:function(){return this.trigger("unmask")},mask:function(c,g){var h,i,j,k,l,m,n,o;if(!c&&this.length>0){h=a(this[0]);var p=h.data(a.mask.dataName);return p?p():void 0}return g=a.extend({autoclear:a.mask.autoclear,placeholder:a.mask.placeholder,completed:null},g),i=a.mask.definitions,j=[],k=n=c.length,l=null,a.each(c.split(""),function(a,b){"?"==b?(n--,k=a):i[b]?(j.push(new RegExp(i[b])),null===l&&(l=j.length-1),k>a&&(m=j.length-1)):j.push(null)}),this.trigger("unmask").each(function(){function h(){if(g.completed){for(var a=l;m>=a;a++)if(j[a]&&C[a]===p(a))return;g.completed.call(B)}}function p(a){return g.placeholder.charAt(a<g.placeholder.length?a:0)}function q(a){for(;++a<n&&!j[a];);return a}function r(a){for(;--a>=0&&!j[a];);return a}function s(a,b){var c,d;if(!(0>a)){for(c=a,d=q(b);n>c;c++)if(j[c]){if(!(n>d&&j[c].test(C[d])))break;C[c]=C[d],C[d]=p(d),d=q(d)}z(),B.caret(Math.max(l,a))}}function t(a){var b,c,d,e;for(b=a,c=p(a);n>b;b++)if(j[b]){if(d=q(b),e=C[b],C[b]=c,!(n>d&&j[d].test(e)))break;c=e}}function u(){var a=B.val(),b=B.caret();if(o&&o.length&&o.length>a.length){for(A(!0);b.begin>0&&!j[b.begin-1];)b.begin--;if(0===b.begin)for(;b.begin<l&&!j[b.begin];)b.begin++;B.caret(b.begin,b.begin)}else{for(A(!0);b.begin<n&&!j[b.begin];)b.begin++;B.caret(b.begin,b.begin)}h()}function v(){A(),B.val()!=E&&B.change()}function w(a){if(!B.prop("readonly")){var b,c,e,f=a.which||a.keyCode;o=B.val(),8===f||46===f||d&&127===f?(b=B.caret(),c=b.begin,e=b.end,e-c===0&&(c=46!==f?r(c):e=q(c-1),e=46===f?q(e):e),y(c,e),s(c,e-1),a.preventDefault()):13===f?v.call(this,a):27===f&&(B.val(E),B.caret(0,A()),a.preventDefault())}}function x(b){if(!B.prop("readonly")){var c,d,e,g=b.which||b.keyCode,i=B.caret();if(!(b.ctrlKey||b.altKey||b.metaKey||32>g)&&g&&13!==g){if(i.end-i.begin!==0&&(y(i.begin,i.end),s(i.begin,i.end-1)),c=q(i.begin-1),n>c&&(d=String.fromCharCode(g),j[c].test(d))){if(t(c),C[c]=d,z(),e=q(c),f){var k=function(){a.proxy(a.fn.caret,B,e)()};setTimeout(k,0)}else B.caret(e);i.begin<=m&&h()}b.preventDefault()}}}function y(a,b){var c;for(c=a;b>c&&n>c;c++)j[c]&&(C[c]=p(c))}function z(){B.val(C.join(""))}function A(a){var b,c,d,e=B.val(),f=-1;for(b=0,d=0;n>b;b++)if(j[b]){for(C[b]=p(b);d++<e.length;)if(c=e.charAt(d-1),j[b].test(c)){C[b]=c,f=b;break}if(d>e.length){y(b+1,n);break}}else C[b]===e.charAt(d)&&d++,k>b&&(f=b);return a?z():k>f+1?g.autoclear||C.join("")===D?(B.val()&&B.val(""),y(0,n)):z():(z(),B.val(B.val().substring(0,f+1))),k?b:l}var B=a(this),C=a.map(c.split(""),function(a,b){return"?"!=a?i[a]?p(b):a:void 0}),D=C.join(""),E=B.val();B.data(a.mask.dataName,function(){return a.map(C,function(a,b){return j[b]&&a!=p(b)?a:null}).join("")}),B.one("unmask",function(){B.off(".mask").removeData(a.mask.dataName)}).on("focus.mask",function(){if(!B.prop("readonly")){clearTimeout(b);var a;E=B.val(),a=A(),b=setTimeout(function(){B.get(0)===document.activeElement&&(z(),a==c.replace("?","").length?B.caret(0,a):B.caret(a))},10)}}).on("blur.mask",v).on("keydown.mask",w).on("keypress.mask",x).on("input.mask paste.mask",function(){B.prop("readonly")||setTimeout(function(){var a=A(!0);B.caret(a),h()},0)}),e&&f&&B.off("input.mask").on("input.mask",u),A()})}})});

    if( $(".masked_phone").length )
        $(".masked_phone").mask("8(999) 999-9999");

    if( $(".masked_date").length )
        $(".masked_date").mask("99.99.9999");
});
