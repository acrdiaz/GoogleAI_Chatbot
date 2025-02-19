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
$question = $_POST['question'];

// Configuración de la API
//$apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=TU_API_KEY"; // Reemplaza TU_API_KEY
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
$response = file_get_contents($apiUrl, false, $context);

if ($response === FALSE) {
  $error = error_get_last();
  die("Error HTTP: " . $error['message']);
}

// Decodificar la respuesta JSON
$result = json_decode($response, true);

// Manejar errores de la API
if (isset($result['error'])) {
  die("Error de la API: " . $result['error']['message']);
}

// Extraer la respuesta generada
$generatedText = "";
if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
  $generatedText = $result['candidates'][0]['content']['parts'][0]['text'];
} else {
  $generatedText = "Lo siento, no pude generar una respuesta.";
}

// Redirigir de vuelta al formulario con la respuesta
session_start();
$_SESSION['response'] = $generatedText;
header("Location: index.php");
exit();
?>