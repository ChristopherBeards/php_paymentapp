<?php 
  require_once('vendor/autoload.php');

  \Stripe\Stripe::setApiKey('sk_test_agDidxqwVWUm7qqvFcnyzicd');

  // Sanitize form inputs
  $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

  // Get form data
  $first_name = $POST['first_name'];
  $last_name = $POST['last_name'];
  $email = $POST['email'];
  $token = $POST['stripeToken'];

  // Create Customer in Stripe
  $customer = \Stripe\Customer::create(array(
    "email" => $email,
    "source" => $token
  ));

  // Charge Customer
  $charge = \Stripe\Charge::create(array(
    "amount" => 5000,
    "currency" => "usd",
    "description" => "Intro To PHP",
    "customer" => $customer->id
  ));

  // print an array for testing
  // print_r($charge);

  // Redirect to Success page
  header('Location: success.php?tid='.$charge->id.'&product='.$charge->description);