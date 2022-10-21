<?php

class Email{

    function __construct()
    {
        $mail = new PHPMailer;

        //$mail->SMTPDebug = 3;                               // Enable verbose debug output
        $mail->setLanguage('br');
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.alcancesolucoes.com.br';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'malmeida@alcancesolucoes.com.br';                 // SMTP username
        $mail->Password = '34712604x';                           // SMTP password
        $mail->SMTPSecure = 'false';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;   
        $mail->sender="malmeida@alcancesolucoes.com.br";                                 // TCP port to connect to
        
        $mail->setFrom('malmeida@alcancesolucoes.com.br', 'Contato');
        $mail->addAddress('malmeida@alcancesolucoes.com.br', 'Contato');     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
        
        $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML
        
        $mail->Subject = 'Contato do Projeto';
        $mail->Body    = 'Corpo da mensagem em HTML! <b>TEXTO EM NEGRITO!</b>';
        $mail->AltBody = 'Mensagem para clientes que não suportam html';
        
        if(!$mail->send()) {
            echo 'A mensagem não pode ser enviada.';
            echo 'Erro: ' . $mail->ErrorInfo;
        } else {
            echo 'Mensagem enviada com sucesso!';
        }
    }
}
?>
