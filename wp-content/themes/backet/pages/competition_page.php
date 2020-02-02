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
                    $municipalities_list = Basket::getMunicipalitiesList();
                    ?>
                    <!-- <div class="tab-pane fade" id="registration" role="tabpanel" aria-labelledby="registration-tab">
                        <form id="requetst_form" data-url="<?php echo admin_url("admin-ajax.php") ?>" data-href="Competition/addToRequestListToCompetition">
                            <input type="hidden" name="competition[ID]" value="<?=$competition_id?>">
                            <input type="hidden" name="competition[YearBorn]" value="<?=$competition_year_born?>">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <p>Заявка на регистрацию</p>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <p>Муниципальное образование</p>
                                        <select class="change_conclusion_team" name="user[Mid]" required>
                                            <option value="" selected>Выберите муниципальное образование</option>
                                            <?php foreach( $municipalities_list as $key => $item ){ ?>
                                                <option value="<?=$key?>"><?=$item?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <p>Фамилия</p>
                                        <input type="text" class="form-control" name="user[SecondName]" autocomplete="off" required>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <p>Имя</p>
                                        <input type="text" class="form-control" name="user[Name]" autocomplete="off" required>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <p>Отчество</p>
                                        <input type="text" class="form-control" name="user[LastName]" autocomplete="off" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p>Телефон</p>
                                        <input type="text" class="form-control masked_phone" name="user[Phone]" autocomplete="off" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p>Email</p>
                                        <input type="email" class="form-control" name="user[Email]" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 request-player-block">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <p>Участники</p>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <p>Список участников</p>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <table class="table" id="player-list">
                                            
                                        </table>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <p>Фамилия</p>
                                        <input type="text" class="form-control" name="player[0][SecondName]" autocomplete="off">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <p>Имя</p>
                                        <input type="text" class="form-control" name="player[0][Name]" autocomplete="off">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <p>Отчество</p>
                                        <input type="text" class="form-control" name="player[0][LastName]" autocomplete="off">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p>Дата рождения</p>
                                        <input type="text" class="form-control masked_date" name="player[0][DateBorn]" autocomplete="off">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p>Район</p>
                                        <input type="text" class="form-control" name="player[0][Area]" autocomplete="off">
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <button class="btn btn-default add-to-list-request" data-type="player">Добавить игрока</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 request-trainer-block">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <p>Тренера</p>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <p>Список тренеров</p>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <table class="table" id="trainer-list">
                                            
                                        </table>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <p>Фамилия</p>
                                        <input type="text" class="form-control" name="trainer[0][SecondName]" autocomplete="off">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <p>Имя</p>
                                        <input type="text" class="form-control" name="trainer[0][Name]" autocomplete="off">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <p>Отчество</p>
                                        <input type="text" class="form-control" name="trainer[0][LastName]" autocomplete="off">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p>Дата рождения</p>
                                        <input type="text" class="form-control masked_date" name="trainer[0][DateBorn]" autocomplete="off">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p>Район</p>
                                        <input type="text" class="form-control" name="trainer[0][Area]" autocomplete="off">
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <button class="btn btn-default add-to-list-request" data-type="trainer">Добавить тренера</button>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <button type="submit" class="btn btn-default">Отправить заявку</button>
                                </div>
                                <img class="loader-gif" style="display: none; float: right:" src="<?php echo get_template_directory_uri(); ?>/assets/images/load.gif" alt="Пример" width="40" height="40">
                            </div>
                        </form>
                    </div> -->

                    <div class="tab-pane fade" id="registration" role="tabpanel" aria-labelledby="registration-tab">
                        <form id="requetst_form" data-url="<?php echo admin_url("admin-ajax.php") ?>" data-href="Competition/addToRequestListToCompetition">
							<input type="hidden" name="competition[ID]" value="<?=$competition_id?>">
                            <input type="hidden" name="competition[YearBorn]" value="<?=$competition_year_born?>">
							<span class="title_form_competition">Заявка на регистрацию участников</span>

							<div class="backgr_form_comp">
							    <span class="form_comprtition_text">Муниципальное образование</span>
								<select class="change_conclusion_team" name="user[Mid]" required>
									<option value="" selected>Выберите муниципальное образование</option>
									<?php foreach( $municipalities_list as $key => $item ){ ?>
										<option value="<?=$key?>"><?=$item?></option>
									<?php } ?>
								</select>

								<div class="row">
									<div class="col-lg-4 col-md-6 col-sm-12">
										<p class="form_comprtition_text">Фамилия</p>
                                        <input type="text" class="form-control" name="user[SecondName]" autocomplete="off" required>
									</div>
									<div class="col-lg-4 col-md-6 col-sm-12">
										<p class="form_comprtition_text">Имя</p>
                                        <input type="text" class="form-control" name="user[Name]" autocomplete="off" required>
									</div>
									<div class="col-lg-4 col-md-12 col-sm-12">
										<p class="form_comprtition_text">Отчество</p>
                                        <input type="text" class="form-control" name="user[LastName]" autocomplete="off" required>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="form_comprtition_text">Телефон</p>
                                        <input type="text" class="form-control masked_phone" name="user[Phone]" autocomplete="off" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="form_comprtition_text">Email</p>
                                        <input type="email" class="form-control" name="user[Email]" autocomplete="off">
                                    </div>
								</div>
							</div>

							<span class="title_form_comp">Участники</span>

							<div class="backgr_form_comp request-player-block">
								<p class="text-center list_of">Список игроков</p>
								
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12">
                                        <table class="table table-striped" id="player-list">
                                        </table>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <p class="form_comprtition_text">Фамилия</p>
                                        <input type="text" class="form-control" name="player[0][SecondName]" autocomplete="off">
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <p class="form_comprtition_text">Имя</p>
                                        <input type="text" class="form-control" name="player[0][Name]" autocomplete="off">
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <p class="form_comprtition_text">Отчество</p>
                                        <input type="text" class="form-control" name="player[0][LastName]" autocomplete="off">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="form_comprtition_text">Дата рождения</p>
                                        <input type="text" class="form-control masked_date" name="player[0][DateBorn]" autocomplete="off">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="form_comprtition_text">Район</p>
										<input type="text" class="form-control" name="player[0][Area]" autocomplete="off">
                                    </div>
                                    <div class="col-lg-3 col-md-12 col-sm-12">
										<button class="add-to-list-request" data-type="player">Добавить игрока</button>
                                    </div>
								</div>
							</div>

							<span class="title_form_comp">Тренеры</span>

							<div class="backgr_form_comp request-trainer-block">
								<p class="text-center list_of">Список тренеров</p>
								
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12">
                                        <table class="table table-striped" id="trainer-list">
                                            
                                        </table>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <p class="form_comprtition_text">Фамилия</p>
                                        <input type="text" class="form-control" name="trainer[0][SecondName]" autocomplete="off">
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <p class="form_comprtition_text">Имя</p>
                                        <input type="text" class="form-control" name="trainer[0][Name]" autocomplete="off">
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <p class="form_comprtition_text">Отчество</p>
                                        <input type="text" class="form-control" name="trainer[0][LastName]" autocomplete="off">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="form_comprtition_text">Дата рождения</p>
                                        <input type="text" class="form-control masked_date" name="trainer[0][DateBorn]" autocomplete="off">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="form_comprtition_text">Район</p>
                                        <input type="text" class="form-control" name="trainer[0][Area]" autocomplete="off">
                                    </div>
									<div class="col-lg-3 col-md-12 col-sm-12">
										<button class="add-to-list-request" data-type="trainer">Добавить тренера</button>
                                    </div>
								</div>
							</div>

                            <button type="submit" class="send_form">Отправить заявку</button>
                            <img class="loader-gif" style="display: none; float: right:" src="<?php echo get_template_directory_uri(); ?>/assets/images/load.gif" alt="Пример" width="40" height="40">
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