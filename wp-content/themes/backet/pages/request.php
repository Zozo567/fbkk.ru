<div class="col-lg-12 col-md-12 col-sm-12">
    <table class="table form-table">
        <thead>
            <tr>
                <th>Название соревнования</th>
                <th>Заявитель на регистрацию</th>
                <th>Телефон</th>
                <th>Email</th>
                <th>Статус заявки</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $data as $key => $item ){ ?>
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
                </tr>
            <?php } ?>
        </tbody>
    </table>
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
</script>