<?php

/**
 * Module that connects to Mailchimp API..
 *
 * This return a JSON string to AJAX script.
 *
 * @package akai
 * @since akai 1.0
 */

	$email = $_POST['email'];
	$listID = '093700738d'; // Mailchimp list ID ("66497a42ac" for "Test" list)
	$apiKey = 'ad9908865e6018f57e43375726985525-us7'; // Mailchimp API key
	$apiUrl = 'https://us7.api.mailchimp.com/2.0/';
	$data = '{"apikey": "'.$apiKey.'", "id": "'.$listID.'", "email": {"email": "'.$email.'"}}';
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $apiUrl.'lists/subscribe.json');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
		"Content-Type" => "application/json",
		"Accept" => "application/json"
	]);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

	$result = curl_exec($ch);

	header("Content-Type:application/json");
	echo $result;

?>