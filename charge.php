<?php 
  require_once('vendor/autoload.php');
  require_once('config/db.php');
  require_once('lib/pdo_db.php');
  require_once('models/Customer.php');
  require_once('models/Transaction.php');

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

  // Instantiate Customer
  $customer = new Customer();

  // Customer Data
  $customerData = [
    'id' => $charge->customer,
    'first_name' => $first_name,
    'last_name' => $last_name,
    'email' => $email
  ];

  // Add Customer To DB
  $customer->addCustomer($customerData);

  // Transaction Data
  $transactionData = [
    'id' => $charge->id,
    'customer_id' => $charge->customer,
    'product' => $charge->description,
    'amount' => $charge->amount,
    'currency' => $charge->currency,
    'status' => $charge->status,
  ];

  // Instantiate Transaction
  $transaction = new Transaction();

  // Add Customer To DB
  $transaction->addTransaction($transactionData);

  // Redirect to Success page
  header('Location: success.php?tid='.$charge->id.'&product='.$charge->description);