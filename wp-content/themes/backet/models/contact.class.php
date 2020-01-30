<?php
class Contact {

    static function getContact( $offset = false ) {

        if( !$offset )
            $offset = !empty($_POST['offset']) ? $_POST['offset'] : 0;

        $arguments = [
            'numberposts' => 9,
            'offset' => $offset,
            'order' => 'DESC',
            'category_name' => 'contact'
        ];

        $post = get_post();
        $post_meta = get_post_meta($post->ID);

        ob_start(); ?>

        <div class="col-md-12 col-lg-12 col-sm-12 federation-wrapper">
            <div class="row">
                <div class="contact-content col-md-12 col-lg-12 col-sm-12">
                    <p>
                        <i class="fa fa-map-marker contact-i-left" aria-hidden="true"></i>

                        <span class="contact-span-name">Адрес</span>

                        <?php if( isset($post_meta['contact_address']) ){ ?>
                            <span class="contact-span-info"><?= current($post_meta['contact_address']) ?></span>
                        <?php }?>
                    </p>
                    <p>
                        <i class="fa fa-envelope contact-i-center" aria-hidden="true"></i>

                        <span class="contact-span-name">E-mail</span>

                        <?php if( isset($post_meta['contact_email']) ){ ?>
                            <span class="contact-span-info"><?= current($post_meta['contact_email']) ?></span>
                        <?php }?>
                    </p>
                    <p>
                        <i class="fa fa-phone contact-i-right" aria-hidden="true"></i>

                        <span class="contact-span-name-last">Телефон</span>

                        <?php if( isset($post_meta['contact_phone']) ){ ?>
                            <span class="contact-span-info"><?= current($post_meta['contact_phone']) ?></span>
                        <?php }?>
                    </p>
                </div>
                <div class="contact-content col-md-12 col-lg-12 col-sm-12">
                    <div class="container">
                        <div class="row">
                            <div class="wrapper-form col-md-12 col-lg-12 col-sm-12">
                                <div class="form_box">
                                    <h4>Форма обратной связи</h4>
                                    <p>Здесь вы всегда можете задать любые интересующие вопросы</p>
                                    <form class="rf contact-form-federation">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-sm-12 input-block-left">
                                                <input type="hidden" name="_"/>
                                                <input type="text" class="rfield" name="name" placeholder="Имя"/>
                                            </div>

                                            <div class="col-md-6 col-lg-6 col-sm-12 input-block-right">
                                                <input type="text" class="rfield" name="email" placeholder="E-mail"/>
                                            </div>

                                            <div class="col-md-12 col-lg-12 col-sm-12 input-block-message">
                                                <input type="text" class="rfield" name="message" placeholder="Сообщение"/>
                                            </div>

                                            <div class="col-md-5 col-lg-5 col-sm-12">
                                                <input type="hidden" name="hide" data-url = "<?php echo admin_url("admin-ajax.php") ?>" data-href="Contact/sendMessage"/>
                                                <input class="btn_submit disabled" value="Отправить данные"/>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $content = ob_get_contents();

        ob_end_clean();

        return ['status' => true, 'count_offset' => $count_posts, 'content' => $content, 'numberposts' => $arguments['numberposts']];
    }

    static function sendMessage()
    {
        $post = $_POST;

       if( !empty( $_POST['name'] ) && !empty( $_POST['email'] ) && !empty( $_POST['message'] ) ){

            $message = $_POST['message'];
        
            $data = [
                'email' => $_POST['email'],
                'name' => $_POST['name'],
            ];

            $check = self::send_email( $data, $message );

            if( $check )
                return ['status' => true, 'message' => 'Сообщение отправлено'];
            else
                return ['status' => false, 'message' => 'Сообщение не отправлено, пожалуйста повторите попытку!'];
       }else
            return ['status' => false, 'message' => 'Не зашел'];
    }

    /**
     * Отправка почты пользователю
     *
     * @param mixed $email
     * @param mixed $subject
     * @param mixed $message
     * @param mixed $attachments
     * @return void
     */
    static function send_email( $data, $message )
    {
        if( !$data['email'] || !$data['name'] || !$message )
            return false;

        $patch = realpath(__DIR__.'/../');
        $dir = __DIR__;

        include_once realpath(__DIR__.'/../').'/libraries/PhpMailer/PHPMailer.php';
        include_once realpath(__DIR__.'/../').'/libraries/PhpMailer/Exception.php';
        include_once realpath(__DIR__.'/../').'/libraries/PhpMailer/SMTP.php';
        include_once realpath(__DIR__.'/../').'/libraries/PhpMailer/OAuth.php';
        include_once realpath(__DIR__.'/../').'/libraries/PhpMailer/POP3.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->CharSet = 'utf-8';
        $mail->IsSMTP();     // turn on SMTP authentication
        $mail->Host = "smtp.yandex.ru";  // specify main and backup server
        $mail->SMTPAuth = true;  // specify main and backup server

        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;  // specify main and backup server

        include_once 'structure.class.php';

        $mail->Username = Structure::$site_fbkk['email'];  // SMTP username
        $mail->Password = Structure::$site_fbkk['pass']; // SMTP password

        $mail->From = "no-reply@fbkk.ru";
        $mail->FromName = "no-reply@fbkk.ru";

        $mail->addAddress('info@fbkk.ru');
            
        $mail->isHTML(true);
        $mail->Subject = 'Новое письмо с сайта';
            
        // $mail->Body = $message;
        $mail->Body = "<p>Имя отправителя: ". $data['name'] ."</p>".
                        "<p>Адрес отправителя: " . $data['email']. "</p>".
                        "<p>Сообщение: " . $message . "</p>";

        $mail->AltBody = strip_tags( $message );
        return $mail->Send();
    }
}