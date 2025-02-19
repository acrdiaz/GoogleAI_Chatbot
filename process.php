<?php
// process.php

require_once 'helper.php';

// Main script execution
$env = loadEnv(__DIR__ . '/.env');
$apiKey = $env['GOOGLE_API_KEY'] ?? '';
$apiUrl = $env['GOOGLE_API_URL'] ?? '';

$question = getUserQuestion();
if (empty($question)) {
  die("Pregunta no proporcionada.");
}

$data = prepareApiData($question);
$options = configureHttpOptions($apiKey, $data);

$context = stream_context_create($options);
$response = @file_get_contents($apiUrl, false, $context);

session_start();
$_SESSION['response'] = handleApiResponse($response);

header("Location: index.php");
exit();
?>