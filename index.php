<?php

require 'vendor/autoload.php';

use AkuratecoTest\Requests\GuzzleRequest;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$email = "mail@mail.com";
$cardNumber = "4111111111111111";
$hash = md5(strtoupper(strrev($email).$_ENV["CLIENT_PASS"].strrev(substr($cardNumber,0,6).substr($cardNumber,-4))));

$postData = [
    "action" => "SALE",
    "client_key" => $_ENV["PUBLIC_KEY"],
    "order_id" => rand(5, 99),
    "order_amount" => 25.22,
    "order_currency" => "USD",
    "order_description" => "test",
    "card_number" => $cardNumber,
    "card_exp_month" => "01",
    "card_exp_year" => "2025",
    "card_cvv2" => "000",
    "payer_first_name" => "User",
    "payer_last_name" => "Name",
    "payer_address"=> "Test",
    "payer_country" => "UA",
    "payer_city"=> "Odesa",
    "payer_zip" => "65000",
    "payer_email" => $email,
    "payer_phone" => "199999999",
    "payer_ip" => "192.168.0.1",
    "term_url_3ds" => "http://site.com/terms",
    "hash" => $hash
];

$request = new GuzzleRequest($_ENV["API_URL"] . "/post", $postData);
$response = $request->send();

echo "Status code: " . $response->getStatusCode() . "<br>";
echo "Response Body:<br>" . $response->getBody();
