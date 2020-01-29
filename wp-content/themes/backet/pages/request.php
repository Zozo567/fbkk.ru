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
                    <td><?=Basket::getStatusRequestList()[$item['Status']]?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>