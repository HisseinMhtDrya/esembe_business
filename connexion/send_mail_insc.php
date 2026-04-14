<?php
          $headers = "From: rudless@rudless.com\r\n";
          $headers .= "Reply-To: russellmk8299@gmail.com\r\n";
          $headers .= "Content-Type: text/html\r\n";
          $to = "russellmk8299@gmail.com";
          $subject = "Remerciement";
          $message = "Cher(e) $prenom $nom, nous tenions à vous adresser nos sincères remerciements pour vous être inscrit(e) sur notre plateforme. 
          Nous sommes ravis que vous ayez choisi de rejoindre notre communauté et nous vous souhaitons la bienvenue.
          
          Votre intérêt pour notre site est d'une grande valeur pour nous. 
          Nous espérons que vous trouverez des informations utiles, des
           ressources précieuses et une expérience enrichissante en tant que membre de notre plateforme.
          
          N'hésitez pas à nous contacter si vous avez des questions, des suggestions ou des préoccupations.
          Notre équipe est là pour vous aider et vous assurer une expérience agréable sur notre site.
          
          Merci encore de votre confiance et de votre soutien. 
          Nous sommes impatients de vous accompagner dans votre parcours sur notre site.
          
          Cordialement,
          L'équipe RudLess ";
          if (mail($to, $subject, $message, $headers)) {
            echo "L'e-mail a été envoyé avec succès.";
           
          } else {
            echo "Une erreur s'est produite lors de l'envoi de l'e-mail.";
          }
        
?>



