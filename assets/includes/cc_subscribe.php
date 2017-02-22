<?php
// Authorization: Bearer 162ddd75-2d06-43fd-b764-76e45d34abc2
// X-Originating-Ip: 24.193.72.125
// Varaible Setup
$api_key = "mza9wt48meaxcdt2cqew4nb5";
$access_token = "162ddd75-2d06-43fd-b764-76e45d34abc2";
$httpHeader = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
$list_id = '1941436722'; // Signups from Website
$email = $_REQUEST['email'];
$params = '{"email_addresses" : [{ "email_address" : "' . $email . '"}], "lists" : [{ "id" : "' . $list_id . '"}]}';

// Start Curl Connection
$ch = curl_init();

// Set Curl Options
curl_setopt($ch, CURLOPT_URL, "https://api.constantcontact.com/v2/contacts?api_key=$api_key&action_by=ACTION_BY_VISITOR");
curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

// Execute
curl_exec($ch);