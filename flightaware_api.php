<?php

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);
header("Access-Control-Allow-Origin: *");

$apiKey = 'CSaOQ0Aup78rjYVtTXwS4gHrbuT6iAIU';

if (isset($_GET['bbox'])) {

	$bbox = $_GET['bbox'];
	$query = ('-latlong "' . $bbox . '"');

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://aeroapi.flightaware.com/aeroapi/flights/search?query=' . $query . '&max_pages=1');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	$headers = array();
	$headers[] = 'Accept: application/json; charset=UTF-8';
	$headers[] = 'X-Apikey:' . $apiKey;
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	echo $result;
	curl_close($ch);
}

if (isset($_POST['json'])) {

	$fromTo = json_decode($_POST['json']);
	$query = 'https://aeroapi.flightaware.com/aeroapi/airports/' . $fromTo -> from . '/flights/to/' . $fromTo -> to;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $query);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	$headers = array();
	$headers[] = 'Accept: application/json; charset=UTF-8';
	$headers[] = 'X-Apikey: ' . $apiKey;
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);

	echo $result;
}

if (isset($_GET['position'])) {

	$flightNumber = $_GET['position'];

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://aeroapi.flightaware.com/aeroapi/flights/' . $flightNumber . '/position');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

	$headers = array();
	$headers[] = 'Accept: application/json; charset=UTF-8';
	$headers[] = 'X-Apikey: ar3qaqeDG8AOg4VAbPsWrTLtLIEgUIZd';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);

	echo $result;
}

if (isset($_GET['planeInfo'])) {

	$flightNumber = $_GET['planeInfo'];

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://aeroapi.flightaware.com/aeroapi/flights/'.$flightNumber);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	$headers = array();
	$headers[] = 'Accept: application/json; charset=UTF-8';
	$headers[] = 'X-Apikey: ' . $apiKey;
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);

	echo $result;
}
?>