<?php 
  require_once('vendor/autoload.php');

  \Stripe\Stripe::setApiKey('sk_test_qDdl7G3Rc54lyewIdZP5ZHD0');

  // Sanitize form inputs
  $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

  // Get form data
  $first_name = $POST['first_name'];
  $last_name = $POST['last_name'];
  $email = $POST['email'];
  $token = $POST['stripeToken'];