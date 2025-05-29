<?php

  $mail = new PHPMailer;
  $mail->SMTPDebug = 0;
  $mail->isSMTP();
  $mail->Host = 'estores.ng';
  $mail->Port = 465;
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = 'ssl';
  $mail->Username = 'info@estores.ng';
  $mail->Password = 'j(Mr7DlV7Oog';
  $mail->setFrom('info@estores.ng', 'estores.ng');
  $mail->addAddress($receiver_email);
  $mail->addReplyTo('info@estores.ng');
  
?>