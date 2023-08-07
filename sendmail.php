<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';

    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->setLanguage('ru', 'phpmailer/language/');
    $mail->IsHTML(true);

    //От кото письма
    $mail->setFrom('email@gmail.com', 'LexPro');
    // Кому отправить
    $mail->addAddress('lexproua@ukr.net');
    // Тема письма
    $mail->Subject = '';


    // Тело письма
    $body = '<h1>Заявка</h1>';

    if(trim(!empty($_POST['name']))){
        $body.='<p><strong>Від:</strong> '.$_POST['name'].'</p>';
    }
    if(trim(!empty($_POST['tel']))){
        $body.='<p><strong>Номер телефону:</strong> '.$_POST['tel'].'</p>';
    }
    if(trim(!empty($_POST['hidden']))){
        $body.='<p><strong>Кнопка:</strong> '.$_POST['hidden'].'</p>';
    }
    if(trim(!empty($_POST['hidden-title']))){
        $body.='<p><strong>Заголовок:</strong> '.$_POST['hidden-title'].'</p>';
    }
    $body.='<p></p>';
    $body.='<p>--</p>';
    $body.='<p>Це повідомлення було відравлено з сайту LexPro (samobud.lexpro.com.ua)</p>';

    $mail->Body = $body;

    //Отправляем
    if(!$mail->send()){
        $message = 'Ошибка';
    } else{
        $message = 'Данные отправлены!';
    }

    $response = ['message' => $message];

    header('Content-type: applacation/json');
    echo json_encode($response);
?>

