<?php

$to = "shompoth.khan@gmail.com";
 
if($_POST){ 
    $visitor_nom = "";
    $visitor_prenom = "";
    $visitor_email = "";
    $concerned_subject = "";
    $visitor_message = "";
     
    if(isset($_POST['visitor_nom'])) {
        $visitor_nom = filter_var($_POST['visitor_nom'], FILTER_SANITIZE_STRING);
    }
     
    if(isset($_POST['visitor_prenom'])) {
      $visitor_prenom = filter_var($_POST['visitor_prenom'], FILTER_SANITIZE_STRING);
  }

    if(isset($_POST['visitor_email'])) {
        $visitor_email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['visitor_email']);
        $visitor_email = filter_var($visitor_email, FILTER_VALIDATE_EMAIL);
    }
     
    // if(isset($_POST['email_title'])) {
    //     $email_title = filter_var($_POST['email_title'], FILTER_SANITIZE_STRING);
    // }
    if(isset($_POST['concerned_subject'])) {
        $concerned_subject = filter_var($_POST['concerned_subject'], FILTER_SANITIZE_STRING);
    }     

    
    if(isset($_POST['visitor_message'])) {
        $visitor_message = htmlspecialchars($_POST['visitor_message']);
    }
     


     
    if($concerned_subject == "Coaching présentiel") {
      $concerned_subject = "Coaching présentiel";
  }
  else if($concerned_subject == "Coaching à distance") {
      $concerned_subject = "Coaching à distance";
  }
  else if($concerned_subject == "Plan alimentaire/entrainement") {
      $concerned_subject = "Plan alimentaire/entrainement";
  }
  else if($concerned_subject == "Question") {
    $concerned_subject = "Question";
    }
else if($concerned_subject == "Autre") {
    $concerned_subject = "Autre";
    }


     
    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $visitor_email . "\r\n";
     
    if(mail($to, $concerned_subject, $visitor_message, $headers)) {
        echo "<p>Merci pour ton message $visitor_prenom. Tu recevras rapidement une réponse !</p>";
    } else {
        echo '<p>Désolé mais le mail n\'a pas été envoyé...</p>';
    }
     
} else {
    echo '<p>Quelque chose s\'est mal passé...</p>';
}
 
?>