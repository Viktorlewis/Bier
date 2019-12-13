<?php
//bron https://www.jon-it.be
if(isset($_POST['email'])) {
  //Email adres veranderen.
    $email_to = "jonathan@jon-it.be";
    $email_subject = "Contactformulier website";
    $email_subject_client = "Bedankt!";
    
  
 
    function died($error) {
        echo "Sorry, het formulier lijkt niet volledig te zijn. ";
        echo "Gelieve deze fouten te verbeteren.<br /><br />";
        echo $error."<br /><br />";
        die();
    }
 
 
    if(!isset($_POST['naam']) ||
        !isset($_POST['email']) ||
        !isset($_POST['bericht'])) {
        died('sorry, op dit moment kunnen wij uw formulier niet versturen.');       
    }
 
     
    $reason = $_POST['opties'];
    $first_name = $_POST['naam']; 
    $email_from = $_POST['email'];
    $comments = $_POST['bericht'];
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'Het emailadres dat u invoerde bleek niet juist te zijn.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'Gelieve uw naam in te geven.<br />';
  }
 
  if(strlen($comments) < 2) {
    $error_message .= 'Gelieve een bericht in te vullen.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Data formulier contact.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
    $email_message .= "Reden van contact: ".clean_string($reason)."\n";
    $email_message .= "Naam: ".clean_string($first_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Bericht: ".clean_string($comments)."\n";
 

$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_from, $email_subject_client, $thank_you_note, $headers,"-f ".$email_from);
@mail($email_to, $email_subject, $email_message, $headers,"-f ".$email_from);

 header("Location: https://www.jon-it.be/test/contact.html"); /* Redirect browser */
exit();

}
?>
