<?php
$to = $mail;
						
$new_pass = $password->gen_reg_key();

$new_pass1 = $password->password($new_pass); 

$boundary = md5(uniqid(microtime(), TRUE));

$objet = 'Votre nouveau mot de passe sur Daewen';


//=====Création du header de l'e-mail.
$header = "From: Daewen <daewen@gmail.com> \n";
$header .= "Reply-To: ".$to."\n";
$header .= "MIME-version: 1.0\n";
$header .= "Content-type: text/html; charset=utf-8\n";
$header .= "Content-Transfer-Encoding: 8bit";
//==========

$contenu =	"<html>".
                "<head></head>".
                "<body style='padding: 0%; margin: 0; font-family: Helvetica, Arial , sans-serif'>".
                    "<div bgcolor='#f7f7f7' style='background: white'>".
                        "<div bgcolor='#22313F' style='background: white; padding: 20px'>".
                            "<a href='https://www.daewen.com' style='color: #e74c3c; text-decoration: none; font-weight: 100;font-size: 24px'>Daewen</a>".
                        "</div>".
                        "<div style='background: white; padding: 2%'>".
                            "<p style='text-align: center; font-size: 18px'><b>Bonjour ".$req['pseudo']."</b>,</p><br/>".
                            "<p style='text-align: justify'><i><b>Voici votre nouveau mot de passe : </b></i>".$new_pass."</p><br/>".
                            "<p style='text-align: justify'>Si ce n'est pas vous qui avait fait cette demande, veuillez contacter l'administrateur.</p>".
                            "<p style='text-align: justify'>Vous pouvez vous rendre dans vos paramètres pour modifier le mot de passe.</p><br/>".
                            "<p>À bientôt sur <a href='http://www.daewen.com' style='color: #3A539B;text-decoration:none;outline: none'>Daewen</a>.</p>".
                           "</div>".
                    "</div>".
                "</body>".
            "</html>";	

mail($to, $objet, $contenu, $header);

?>