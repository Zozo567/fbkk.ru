<?php
$competition_url = explode('/', $_SERVER['REQUEST_URI']);

$competition_id = $competition_url[3]; // id записи
$competition_year_born = $competition_url[4]; // год рождения участников

$competition = get_post($competition_id);
$competition_meta = get_post_meta($competition_id);

// получение id для загрузки статистики и календаря по году рождения участников
$competition_id_data = get_field('competition_id', $competition_id);
foreach( $competition_id_data as $val ){
    if( $val['year_born'] == $competition_year_born )
        $competition_id_stat = (int) $val['id'];
} 

// Check on the result of switching the possibility of registering member
$competition_registration = get_field('registration', $competition_id);
?>

<div class="container">
    <div class="body-block-competition">

        <span class="title_competition_one"><?=$competition->post_title?> - <?=$competition_year_born?> г.р.</span>

        <div class="col-block" style="padding-top: 15px;">
            <div class="competition-type-menu-wraper">
                <div class="competition-type-menu">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <?php if( !empty($competition_registration) ){ ?>
                            <li class="nav-item">
                                <a class="nav-link" style="" id="registration-tab" data-toggle="tab" href="#registration" role="tab" aria-controls="registration" aria-selected="false">Регистрация участников</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link active" style="" id="schedule-tab" data-toggle="tab" href="#schedule" role="tab" aria-controls="schedule" aria-selected="true">Турнир</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">Положения и регламенты</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" style="" id="statistics-tab" data-url="<?php echo admin_url("admin-ajax.php") ?>" data-href="Statistic/getStatisticAll" data-comp-id="<?=$competition_id_stat?>" data-toggle="tab" href="#statistics" role="tab" aria-controls="statistics" aria-selected="false">Статистика</a>
                        </li> -->
                    </ul>
                </div>
            </div>

            <div class="tab-content" id="myTabContent">

                <?php if( !empty($competition_registration) ){ 
                    $municipalities_list = Competition::getMunicipalitiesList();
                    ?>
                    <div class="tab-pane fade" id="registration" role="tabpanel" aria-labelledby="registration-tab">
                        <form id="requetst_form">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <p>Заявка на регистрацию</p>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <p>Муниципальное образование</p>
                                        <select class="change_conclusion_team" name="user[Mid]">
                                            <option selected disabled>Выберите муниципальное образование</option>
                                            <?php foreach( $municipalities_list as $item ){ ?>
                                                <option></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <p>Фамилия</p>
                                        <input type="text" class="form-control" name=user[SecondName] autocomplete="off">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <p>Имя</p>
                                        <input type="text" class="form-control" name=user[Name] autocomplete="off">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <p>Отчество</p>
                                        <input type="text" class="form-control" name=user[LastName] autocomplete="off">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p>Телефон</p>
                                        <input type="text" class="form-control" name=user[Phone] autocomplete="off">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p>Email</p>
                                        <input type="email" class="form-control" name=user[Email] autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <p>Участники</p>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <p>Список участников</p>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <table class="table" id="players-list">
                                            
                                        </table>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <p>Фамилия</p>
                                        <input type="text" class="form-control" name=player[SecondName] autocomplete="off">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <p>Имя</p>
                                        <input type="text" class="form-control" name=player[Name] autocomplete="off">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <p>Отчество</p>
                                        <input type="text" class="form-control" name=player[LastName] autocomplete="off">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p>Дата рождения</p>
                                        <input type="text" class="form-control" name=player[DateBorn] autocomplete="off">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p>Район</p>
                                        <input type="text" class="form-control" name=player[Area] autocomplete="off">
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <button class="btn btn-default add-to-list-request" data-type="players">Добавить игрока</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <p>Тренера</p>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <p>Список тренеров</p>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <table class="table" id="trainers-list">
                                            
                                        </table>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <p>Фамилия</p>
                                        <input type="text" class="form-control" name=player[SecondName] autocomplete="off">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <p>Имя</p>
                                        <input type="text" class="form-control" name=player[Name] autocomplete="off">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <p>Отчество</p>
                                        <input type="text" class="form-control" name=player[LastName] autocomplete="off">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p>Дата рождения</p>
                                        <input type="text" class="form-control" name=player[DateBorn] autocomplete="off">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p>Район</p>
                                        <input type="text" class="form-control" name=player[Area] autocomplete="off">
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <button class="btn btn-default">Добавить тренера</button>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <button class="btn btn-default add-to-list-request" data-type="trainers">Отправить заявку</button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php } ?>

                <div class="tab-pane fade show active in" id="schedule" role="tabpanel" aria-labelledby="schedule-tab">
                    <link href="https://artemyev.me/rfb/widgets.css" rel="stylesheet" />
                    <script src="https://russiabasket.ru/Content/html/assets/production/js/widgets.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
                    <script src="https://russiabasket.ru/Content/html/assets/js/lib/datepicker.min.js"></script>
                    <script src="https://russiabasket.ru/Content/html/assets/js/lib/datepicker.ru.min.js"></script>
                    <!-- <div class="InfoBasketWidget CalendarPage" data-id="<?=$competition_id_stat?>" data-comp-id="<?=$competition_id_stat?>" data-lang="ru" data-tab="1" data-var="0" data-date-format="dd.MM.yyyy" data-comps="" data-max="20"></div> -->
                    <div id="schedule_games" data-url="<?php echo admin_url("admin-ajax.php") ?>" data-href="Competition/getCompetitionShedule" data-comp-id="<?=$competition_id_stat?>">
                        <div class="spinner_center">
                            <div class="spinner-border" role="status">
                                <span class="sr-only"></span>
                            </div>
                        </div>
                    </div>
                    <script src="https://artemyev.me/rfb/widgetInit.js"></script>
                    <script>
                    setTimeout(() => {
                        jQuery('#schedule-tab').trigger('click');
                    }, 2000);
                    </script>
                </div>

                <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                    <?php 
                    $documents_data = get_field('competition_documents', $competition_id); ?>

                    <?php if( isset($documents_data) && !empty($documents_data) ){ ?>
                        <div class="col-lg-3 col-md-5 col-sm-12 competition_season_select">
                            <div class="icon-select">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="0.247cm" height="0.141cm">
                                    <path fill-rule="evenodd"  fill="rgb(17, 17, 17)" d="M7.000,1.000 L6.000,1.000 L6.000,2.000 L5.000,2.000 L5.000,3.000 L4.000,3.000 L4.000,4.000 L3.000,4.000 L3.000,3.000 L2.000,3.000 L2.000,2.000 L1.000,2.000 L1.000,1.000 L-0.000,1.000 L-0.000,-0.000 L7.000,-0.000 L7.000,1.000 Z"/>
                                </svg>
                            </div>
                            <select class="change_season_games change_conclusion_team" data-competition-id="<?=$competition_id?>" data-url="<?php echo admin_url("admin-ajax.php") ?>" data-href="Competition/getCompetitionDocuments">
                                <?php foreach( $documents_data as $key => $value ){ ?>
                                    <option class="change_season_competition" value="<?=$value['years_documents']?>"><?=$value['years_documents']?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="competition_document_season">
                            <?php echo Competition::getCompetitionDocuments($documents_data)['content']; ?>
                        </div>
                    <?php } else { ?>
                        <div class="text_center">
                            <span class="document_name_label">Документов не загружено</span>
                        </div>
                    <?php } ?>
                </div>

                <div class="tab-pane fade" id="statistics" role="tabpanel" aria-labelledby="statistics-tab">
                    <!-- <div class="InfoBasketWidget RatingPage" data-id="<?=$competition_id_stat?>" data-comp-id="<?=$competition_id_stat?>" data-lang="ru" data-tab="0" data-var="0" data-param="1" data-max="20" data-page="20"></div> -->
                </div>
            </div>
        </div>
    </div>
</div>