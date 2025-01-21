<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace with your real receiving email address
  $receiving_email_address = 'ar.revanthreddy@gmail.com';  // Change this to your email address

  // Check if the PHP Email Form library exists
  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  // Create a new instance of PHP_Email_Form
  $contact = new PHP_Email_Form;
  $contact->ajax = true;

  // Set the recipient email address
  $contact->to = $receiving_email_address;

  // Get and sanitize form data
  $name = htmlspecialchars($_POST['name']);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $subject = htmlspecialchars($_POST['subject']);
  $message = htmlspecialchars($_POST['message']);

  // Validate email format
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format";
    exit;
  }

  // Set the email properties
  $contact->from_name = $name;
  $contact->from_email = $email;
  $contact->subject = $subject;

  // Uncomment below if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
  $contact->smtp = array(
    'host' => 'smtp.example.com',
    'username' => 'your-email@example.com',
    'password' => 'your-email-password',
    'port' => '587' // For TLS, use 465 for SSL
  );
  */

  // Add the form data as messages
  $contact->add_message($name, 'From');
  $contact->add_message($email, 'Email');
  $contact->add_message($message, 'Message', 10); // 10 is the character length limit

  // Send the email and return the result
  echo $contact->send();
?>
