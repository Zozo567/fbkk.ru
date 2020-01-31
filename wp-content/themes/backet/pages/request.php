<link href="<?php echo get_template_directory_uri(); ?>/assets/css/bootstrap.min.css?<?=$version?>" rel="stylesheet">
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/bootstrap.min.js?<?=$version?>"></script>
<div class="col-lg-12 col-md-12 col-sm-12">
    <form class="form-filter-requests-list">
        <input type="hidden" name="page" value="admin_help">
        <input type="hidden" name="p" value="0">
        <div class="row">
            <div class="col-md-3 col-lg-3 col-sm-3">
                <select class="form-control changing-status-request width-height-100" name="request[Status]">
                    <option value="">Статус заявки</option>
                    <?php foreach(Basket::getStatusRequestList() as $k => $it){ ?>
                        <option value="<?=$k?>" <?=!empty($_GET['request']['Status']) && $k == $_GET['request']['Status'] ? 'selected' : '' ?>><?=$it?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-3">
                <select class="form-control changing-status-request width-height-100" name="request[Cid]">
                    <option value="">Название соревнований</option>
                    <?php foreach(Competition::getExistsCid() as $k => $it){ ?>
                        <option value="<?=$k?>" <?=!empty($_GET['request']['Cid']) && $k == $_GET['request']['Cid'] ? 'selected' : '' ?>><?=$it?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-3">
                <select class="form-control changing-status-request width-height-100" name="request[YearBorn]">
                    <option value="">Год рождения</option>
                    <?php foreach(Competition::getExistsYearBorn() as $k => $it){ ?>
                        <option value="<?=$k?>" <?=!empty($_GET['request']['YearBorn']) && $k == $_GET['request']['YearBorn'] ? 'selected' : '' ?>><?=$it?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-3">
                <button class="btn btn-info width-height-100">Применить фильтр</button>
            </div>
        </div>
    </form>
    <table class="table form-table">
        <thead>
            <tr>
                <th class="text_center">Название соревнования</th>
                <th class="text_center">Заявитель на регистрацию</th>
                <th class="text_center">Телефон</th>
                <th class="text_center">Email</th>
                <th class="text_center">Статус заявки</th>
                <th class="text_center"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $data['requests_list'] as $key => $item ){ ?>
                <tr>
                    <td><?=Competition::getCompetitionName( $item['Cid'], $item['YearBorn'] )?></td>
                    <td><?=$item['user']['Name'] .' '. $item['user']['SecondName'] .' '. $item['user']['LastName']?></td>
                    <td><?=Basket::formatPhoneNumber( $item['user']['Phone'] )?></td>
                    <td><?=$item['user']['Email']?></td>
                    <td>
                        <form data-url="<?php echo admin_url("admin-ajax.php") ?>" data-href="Competition/changeStatusRequest">
                            <input type="hidden" name="request[ID]" value="<?=$item['ID']?>">
                            <select class="form-control changing-status-request" name="request[Status]">
                                <?php foreach(Basket::getStatusRequestList() as $k => $it){ ?>
                                    <option value=<?=$k?> <?=$k == $item['Status'] ? 'selected' : '' ?>><?=$it?></option>
                                <?php } ?>
                            </select>
                        </form>
                    </td>
                    <td>
                        <a class="" data-toggle="collapse" href="#collapseExample_<?=$item['ID']?>" role="button" aria-expanded="false" aria-controls="collapseExample_<?=$item['ID']?>">
                            Подробнее
                        </a>
                    </td>
                </tr>
                <tr class="collapse" id="collapseExample_<?=$item['ID']?>">
                    <td class="" colspan="3">
                        <b>Участники</b>
                        <table>
                            <?php foreach( $item['players'] as $it ){ ?>
                                <tr>
                                    <td><?=$it['Name'] .' '. $it['SecondName'] .' '. $it['LastName']?></td>
                                    <td><?= date("d.m.Y", (int) $it['DateBorn']) ?></td>
                                    <td><?= $it['Area'] ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </td>
                    <td class="" colspan="3">
                        <b>Тренера</b>
                        <table>
                            <?php foreach( $item['trainers'] as $it ){ ?>
                                <tr>
                                    <td><?=$it['Name'] .' '. $it['SecondName'] .' '. $it['LastName']?></td>
                                    <td><?= date("d.m.Y", (int) $it['DateBorn']) ?></td>
                                    <td><?= $it['Area'] ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php 
    $array = range(0, $data['count_all_requests']); // массив данных для пагинации
    $count = $data['count_requests']; // количество выводимых эелементом массива на страницу
    $length = 8; // количество выводимых страниц (начинается с нуля)
    
    $pages_count = floor(count($array) / $count);
    $page = !empty($_GET['p']) ? (int) $_GET['p'] : 0;
    
    if( $pages_count > 0 ){
    
        $pages = range(0, $pages_count);
    
        if( $pages_count > $length ) {
    
            if( $page > (floor($length / 2) + 1) && $page < ($pages_count - floor($length / 2) + 1) )
                $pages = array_merge([0, '-'], range($page - floor($length / 2), $page + floor($length / 2)), ['-', $pages_count]);
            else if( $page >= ($pages_count - floor($length / 2) + 1) )
                $pages = array_merge([0, '-'], range($pages_count - $length, $pages_count));
            else
                $pages = array_merge(range(0, $length), ['-', $pages_count]);
        }
    }
    if( $pages_count > 0 ){ ?>
        <nav class="item-list" style="float: right; margin-right: 50px;">
            <ul class="pager">
                <?php if( $page > 0 ){ ?>
                <li class="pager-previous">
                    <a href="#" class="go-to-current-page" data-page="0">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="pager-previous">
                    <a href="#" class="go-to-current-page" data-page="<?= $page > 0 ? $page - 1 : 0 ?>">
                        <span aria-hidden="true">&#8249;</span>
                    </a>
                </li>
                <?php } ?>
                <?php foreach( $pages as $k => $p ){ 
                    
                    if( $p === '-' ){ ?>
                        <li class="pager-ellipsis">...</li>
                    <?php continue; } ?>

                    <?php if( $p == $page ){ ?>
                        <li class="pager-current"><?=$p + 1?></li>
                    <?php } else { ?>
                        <li class="pager-item"><a href="#" class="go-to-current-page" data-page="<?=$p?>"><?=$p + 1?></a></li>
                    <?php } ?>
                    
                <?php } ?>
                <?php if( $page < $pages_count ){ ?>
                <li>
                    <a href="#" class="go-to-current-page" data-page="<?php if($page < $pages_count) echo ($page + 1); else $pages_count; ?>" data-page="" data-toggle="tooltip" data-placement="top" title="Следующая">
                        <span aria-hidden="true">&#8250;</span>
                    </a>
                </li>
                <li class="pager-previous">
                    <a href="#" class="go-to-current-page" data-page="<?=$pages_count?>" data-toggle="tooltip" data-placement="top" title="Последняя">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </nav>
    <?php } ?>
</div>

<script>
jQuery('body').on('change', '.changing-status-request', function(e){

    e.preventDefault();

    var _this = jQuery(this);

    var form = _this.parents('form');

    var url = form.data('url');
    var href = form.data('href');
    var data = form.serialize();

    jQuery.ajax({
        url: url,
        data: "action=basket&href=" + href + "&" + data,
        type: "POST",
        dataType: "json",
        success: function(res){
            if( res.status == true ){
                window.location.reload();
            }
        }
    });
});

jQuery('body').on('click', '.go-to-current-page', function(e){

    e.preventDefault();

    var _this = jQuery(this);

    var current_page = _this.data('page');

    var form = jQuery('form.form-filter-requests-list');

    form.find('input[name="p"]').val(current_page);

    form.trigger('submit');
});
</script>

<style>

    .width-height-100 {
        width: 100% !important;
        height: 100% !important;
    }

    .form-table th {
        text-align: center !important;
    }

    nav {
        display: block;
    }

    .pager {
        padding-left: 0;
        margin: 20px 0;
        text-align: center;
        list-style: none;
    }

    .pager li {
        display: inline;
    }

    .pager li > a,
    .pager li > span {
        display: inline-block;
        padding: 5px 14px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 15px;
    }

    .pager li > a:hover,
    .pager li > a:focus {
        text-decoration: none;
        background-color: #eee;
    }

</style>