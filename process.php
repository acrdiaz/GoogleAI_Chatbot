<?php
// process.php

// Cargar el archivo .env manualmente
if (file_exists(__DIR__ . '/.env')) {
  $env = parse_ini_file(__DIR__ . '/.env');
  $apiKey = $env['GOOGLE_API_KEY'] ?? '';
} else {
  die("Archivo .env no encontrado.");
}

// Obtener la pregunta del usuario
$question = $_POST['question'] ?? '';

if (empty($question)) {
  die("Pregunta no proporcionada.");
}

// Configuración de la API
$apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent";

// Datos de entrada
$data = [
  'contents' => [
    [
      'parts' => [
        [
          'text' => $question
        ]
      ]
    ]
  ],
];

// Configurar la solicitud HTTP
$options = [
  'http' => [
    'header'  => "Content-Type: application/json\r\nx-goog-api-key: $apiKey", // Envía la API Key en el encabezado
    'method'  => 'POST',
    'content' => json_encode($data),
  ],
];

// Enviar la solicitud
$context = stream_context_create($options);
$response = @file_get_contents($apiUrl, false, $context);

session_start();

if ($response === FALSE) {
  $error = error_get_last();
  if (strpos($error['message'], '400') !== false) {
    $_SESSION['response'] = 'Error 400: Bad Request. Please check your input and try again.';
  } else {
    $_SESSION['response'] = 'An unexpected error occurred. Please try again later.';
  }
} else {
  // Decodificar la respuesta JSON
  $result = json_decode($response, true);

  // Manejar errores de la API
  if (isset($result['error'])) {
    $_SESSION['response'] = "Error de la API: " . $result['error']['message'];
  } else {
    // Extraer la respuesta generada
    $generatedText = "";
    if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
      $generatedText = $result['candidates'][0]['content']['parts'][0]['text'];
    } else {
      $generatedText = "Lo siento, no pude generar una respuesta.";
    }
    $_SESSION['response'] = $generatedText;
  }
}

header("Location: index.php");
exit();
?>