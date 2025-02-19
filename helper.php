<?php

// Load .env file manually
function loadEnv($filePath) {
  if (file_exists($filePath)) {
    return parse_ini_file($filePath);
  }
  die("Archivo .env no encontrado.");
}

// Get user question from POST request
function getUserQuestion() {
  return $_POST['question'] ?? '';
}

// Prepare API request data
function prepareApiData($question) {
  return [
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
}

// Configure HTTP request options
function configureHttpOptions($apiKey, $data) {
  return [
    'http' => [
      'header'  => "Content-Type: application/json\r\nx-goog-api-key: $apiKey",
      'method'  => 'POST',
      'content' => json_encode($data),
    ],
  ];
}

// Handle API response
function handleApiResponse($response) {
  if ($response === FALSE) {
    $error = error_get_last();
    if (strpos($error['message'], '400') !== false) {
      return 'Error 400: Bad Request. Please check your input and try again.';
    }
    return 'An unexpected error occurred. Please try again later.';
  }

  $result = json_decode($response, true);
  if (isset($result['error'])) {
    return "Error de la API: " . $result['error']['message'];
  }

  return $result['candidates'][0]['content']['parts'][0]['text'] ?? "Lo siento, no pude generar una respuesta.";
}
?>
