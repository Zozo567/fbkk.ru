<!-- <span style="color: #fff; position: absolute; top: -50px; font-size: 250%;">Соревнования</span> -->
<div class="col-md-12 col-lg-12 col-sm-12 page-name-header-news col-main-block">
    <span>Соревнования</span>
</div>

<div class="container">
    <div class="row news-block season_games body-block-news competition-body-block" style="margin-right: 0px; !important">
    <?php
        $return = Competition::getCompetition(); 
        echo $return['content']; ?>
    </div>
    <?php if( $return['count_offset'] >= 5 ) { ?>
        <div class="col-md-12 col-lg-12 col-sm-12 col-main-block">
            <button class="btn btn-outline-primary initialism btn-href more-news" data-url="<?php echo admin_url("admin-ajax.php") ?>" data-href="Competition/getCompetition" data-offset="5">Показать еще</button>
        </div>
    <?php } ?>
</div>

<script>

    jQuery('body').find('.carousel').each(function(k,v){
        $('#carouselExample-' + k).on('slide.bs.carousel', function (e) {
            var $e = $(e.relatedTarget);
            var idx = $e.index();
            var itemsPerSlide = 4;
            var totalItems = $(this).find('.carousel-item').length;
            
            if (idx >= totalItems-(itemsPerSlide-1)) {
                var it = itemsPerSlide - (totalItems - idx);
                for (var i=0; i<it; i++) {
                    // append slides to end
                    if (e.direction=="left") {
                        $(this).find('.carousel-item').eq(i).appendTo('.carousel-inner');
                    }
                    else {
                        $(this).find('.carousel-item').eq(0).appendTo('.carousel-inner');
                    }
                }
            }
        });
    });

    jQuery('body').find('.carousel').each(function(k,v){
        $('#carouselExample-' + k).carousel({ 
            interval: false
        });
    });

    $(document).ready(function() {
        $('a.thumb').click(function(event){
        event.preventDefault();
        var content = $('.modal-body');
        content.empty();
            var title = $(this).attr("title");
            $('.modal-title').html(title);        
            content.html($(this).html());
            $(".modal-profile").modal({show:true});
        });
    });

</script>

<style>
/* Карусель годов */
@media (min-width: 768px) {

.carousel-control-prev-custom {
    position: absolute;
    top: 0;
    bottom: 0;
    z-index: 1;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: center;
    justify-content: center;
    width: 20px;
    color: black;
    text-align: center;
    opacity: .5;
    transition: opacity .15s ease;
    left: 0;
}

.carousel-control-next-custom {
    position: absolute;
    top: 0;
    bottom: 0;
    z-index: 1;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: center;
    justify-content: center;
    width: 20px;
    color: black;
    text-align: center;
    opacity: .5;
    transition: opacity .15s ease;
    right: 0;
}

/* show 3 items */
.carousel-inner .active,
.carousel-inner .active + .carousel-item,
.carousel-inner .active + .carousel-item + .carousel-item,
.carousel-inner .active + .carousel-item + .carousel-item + .carousel-item  {
    display: block;
    margin-right: -2px;
}

.carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left),
.carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item,
.carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item + .carousel-item,
.carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item + .carousel-item + .carousel-item {
    transition: none;
}

.carousel-inner .carousel-item-next,
.carousel-inner .carousel-item-prev {
  position: relative;
  transform: translate3d(0, 0, 0);
}

.carousel-inner .active.carousel-item + .carousel-item + .carousel-item + .carousel-item + .carousel-item {
    position: absolute;
    top: 0;
    right: -25%;
    z-index: -1;
    display: block;
    visibility: visible;
}

/* left or forward direction */
.active.carousel-item-left + .carousel-item-next.carousel-item-left,
.carousel-item-next.carousel-item-left + .carousel-item,
.carousel-item-next.carousel-item-left + .carousel-item + .carousel-item,
.carousel-item-next.carousel-item-left + .carousel-item + .carousel-item + .carousel-item,
.carousel-item-next.carousel-item-left + .carousel-item + .carousel-item + .carousel-item + .carousel-item {
    position: relative;
    transform: translate3d(-100%, 0, 0);
    visibility: visible;
}

/* farthest right hidden item must be abso position for animations */
.carousel-inner .carousel-item-prev.carousel-item-right {
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
    display: block;
    visibility: visible;
}

/* right or prev direction */
.active.carousel-item-right + .carousel-item-prev.carousel-item-right,
.carousel-item-prev.carousel-item-right + .carousel-item,
.carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item,
.carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item + .carousel-item,
.carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item + .carousel-item + .carousel-item {
    position: relative;
    transform: translate3d(100%, 0, 0);
    visibility: visible;
    display: block;
    visibility: visible;
}

}

/* Bootstrap Lightbox using Modal */

#profile-grid { overflow: auto; white-space: normal; } 
#profile-grid .profile { padding-bottom: 40px; }
#profile-grid .panel { padding: 0 }
#profile-grid .panel-body { padding: 15px }
#profile-grid .profile-name { font-weight: bold; }
#profile-grid .thumbnail {margin-bottom:6px;}
#profile-grid .panel-thumbnail { overflow: hidden; }
#profile-grid .img-rounded { border-radius: 4px 4px 0 0;}

/* Конец */
</style>