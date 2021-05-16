<?php
  session_start();

  if(!empty($_POST)){
    extract($_POST);
    $valid = true;

      if (isset($_POST['contact'])){
        $nom = (string) htmlentities(trim($nom)); // on recupere le nom
        $prenom = (string) htmlentities(trim($prenom)); // on recupere le prenom
        $mail = (string) htmlentities(strtolower(trim($mail))); // on recupere le mail
        $sujet = (int) trim($sujet); 
        $message = (string) htmlentities(trim($message)); 

        if(empty($nom))
        {
          $valid = false;
          $er_nom = ("Le nom ne peut pas être vide");
        }
        elseif( !preg_match("/^[a-zA-Z ]*$/", $nom))
        // elseif( preg_match ( " \^[a-zA-Z ]$\" , $nom ))
        {
          $valid = false;
          $er_mail = "Le nom n'est pas valide";
        }

        if(empty($prenom)){
          $valid = false;
          $er_nom = ("Le prenom ne peut pas être vide");
        }elseif(!preg_match("/^[a-zA-Z ]*$/", $prenom)){
          $valid = false;
          $er_mail = "Le prenom n'est pas valide";
        }
        // erreur possible *$

        if(empty($mail)){
          $valid = false;
          $er_nom = ("Le mail ne peut pas être vide");
        }elseif(!preg_match("/ˆ[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $mail)){
          $valid = false;
          $er_mail = "Le mail n'est pas valide";
        }

        $verif_sujet = array(1, 2, 3, 4, 5);

        if(!in_array($sujet, $verif_sujet)){
          $valid = false;
          $er_sujet = "Le sujet ne correspond pas";
        }

        $nb_sujet = (int) $sujet;

        switch($sujet){
          case 1: $sujet = "Coaching présentiel"; break;
          case 2: $sujet = "Coaching à distance"; break;
          case 3: $sujet = "Plan alimentaire/entrainement"; break;
          case 4: $sujet = "Question"; break;
          case 5: $sujet = "Autre"; break;
          default: $sujet = "Incorrect"; break;
        }

        if(empty($message)){
          $valid = false;
          $er_message = "Le message ne peut pas être vide";
        }

        if($valid){
          
          $to = "shompoth.khan@gmail.com";

          $header = 'MIME-Version: 1.0' . "\r\n";
          $header .= 'Content-type: text/html; charset=utf-8' . "\r\n";

          $header .= 'To: Vous <' . $to . '>'. "\r\n"; 
          $header .= 'From ' . $nom . ', '. $prenom . ' <' . $mail . '>' . "\r\n";

          $message = "<html>
            <head>
              <title>Contact</title>
            </head>
            <body> 
              <p>" .
                  $nom . ', ' . $prenom . ', 
                  Sujet : ' . $sujet . ',
                  Message : ' . $message . "
              </p>
            </body>
          </html>";

          if(mail($to, $sujet, $message, $header)){
            echo 'ok';
          }else{
            echo 'pas ok';
          }
          header('Location: /');
          exit;
        }


      }
    
  }
  ?>
