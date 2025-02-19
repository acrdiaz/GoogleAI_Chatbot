<!-- index.php -->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chatbot con Google AI Studio</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    form {
      margin-bottom: 20px;
    }
    textarea {
      width: 100%;
      height: 100px;
      margin-bottom: 10px;
    }
    .response {
      background: #f4f4f4;
      padding: 10px;
      border-radius: 5px;
    }
    label.checkbox-label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <h1>Chatbot con Google AI Studio</h1>

  <form action="process.php" method="POST">
    <!-- Checkbox para habilitar el combo box -->
    <label class="checkbox-label">
      <input type="checkbox" id="enableModel" onclick="toggleModelSelect()"> Habilitar selección de modelo
    </label>

    <label for="model">Selecciona un modelo:</label><br>
    <select id="model" name="model" required disabled>
      <option value="gemini-1.5-flash:generateContent">Gemini 1.5 Flash</option>
      <option value="text-bison-001:generateText">Text Bison 001</option>
      <option value="chat-bison-001:generateMessage">Chat Bison 001</option>
      <!-- Agrega más modelos aquí según estén disponibles... -->
    </select><br><br>

    <label for="question">Escribe tu pregunta:</label><br>
    <textarea id="question" name="question" required></textarea><br>
    <button type="submit">Enviar</button>
  </form>

  <?php
  // Mostrar la respuesta si existe
  session_start();

  if (isset($_SESSION['response'])) {
    echo '<div class="response">';
    echo htmlspecialchars($_SESSION['response']);
    echo '</div>';
    unset($_SESSION['response']); // Limpiar la respuesta luego de mostrarla
  }
  ?>

  <!-- Script para habilitar/deshabilitar el combo box -->
  <script>
    function toggleModelSelect() {
      // Obtener el checkbox y el combo box
      const enableModelCheckbox = document.getElementById('enableModel');
      const modelSelect = document.getElementById('model');

      // Habilitar/deshabilitar el combo box según el estado del checkbox
      modelSelect.disabled = !enableModelCheckbox.checked;

      // Si el combo box está habilitado, asegúrate de que tenga un valor seleccionado
      if (!modelSelect.disabled) {
        modelSelect.focus();
      }
    }
  </script>
</body>
</html>