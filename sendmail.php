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
    $mail->setFrom('email1@gmail.com', 'Имя');
    // Кому отправить
    $mail->addAddress('email2@gmail.com');
    // Тема письма
    $mail->Subject = 'Тема письма"';


    // Тело письма
    $body = '<h1>Тело письма</h1>';

    if(trim(!empty($_POST['name']))){
        $body.='<p><strong>Имя:</strong> '.$_POST['name'].'</p>';
    }
    if(trim(!empty($_POST['tel']))){
        $body.='<p><strong>Tel:</strong> '.$_POST['tel'].'</p>';
    }
    if(trim(!empty($_POST['hidden']))){
        $body.='<p><strong>Форма была отправлена с кнопки:</strong> '.$_POST['hidden'].'</p>';
    }

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

