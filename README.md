# GoogleAI_Chatbot

Este proyecto es un chatbot interactivo que utiliza el modelo de lenguaje avanzado Gemini de Google AI Studio. El chatbot permite a los usuarios hacer preguntas y recibir respuestas generadas por inteligencia artificial.

## Características principales

- Soporte para el modelo Gemini.
- Interfaz simple y fácil de usar.
- Manejo seguro de la API Key mediante un archivo .env.
- Compatible con PHP sin necesidad de frameworks adicionales.

## Requisitos previos

Antes de ejecutar este proyecto, asegúrate de cumplir con los siguientes requisitos:

1. PHP : Necesitas tener PHP instalado en tu sistema. Puedes verificar la versión ejecutando:

   ```bash
   php -v
   ```

2. API Key de Google AI Studio :

   - Ve a [Google AI Studio](https://aistudio.google.com) y genera una API Key.
   - Asegúrate de que la clave tenga acceso al modelo Gemini.

3. Servidor web (opcional):
   Si no tienes un servidor local configurado, puedes usar herramientas como XAMPP , WAMP, MAMP o LAMP para ejecutar el proyecto.

# Configuración del proyecto

1.  Clonar el repositorio
    Cambia de directorio ve a la carpeta raíz de tu servidor web.

    Si estás usando Git, clona este repositorio en tu máquina local:

    ```bash
    git clone https://github.com/acrdiaz/GoogleAI_Chatbot.git
    ```

    ```bash
    cd GoogleAI_Chatbot
    ```

2.  Configurar la API Key
    Para manejar la API Key de forma segura, sigue estos pasos:

    ### Usar un archivo .env

    1. Crea un archivo llamado .env en la raíz del proyecto.

    2. Agrega tu API Key al archivo .env:

       ```
       GOOGLE_API_URL=https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent
       GOOGLE_API_KEY=TU_API_KEY
       ```

    3. Asegúrate de ignorar el archivo .env en Git agregando lo siguiente al archivo .gitignore:

       ```
       .env
       ```

3.  Ejecutar el proyecto

    1. Abre el archivo index.php en tu navegador:
       http://localhost/GoogleAI_Chatbot/index.php

    2. Cómo usar la aplicación:
       - Escribe tu pregunta en el cuadro de texto.
       - Presiona el botón "Enviar" .
       - Espera unos segundos mientras el modelo procesa tu pregunta.
       - La respuesta generada se mostrará en la parte inferior de la pantalla.

**¡Feliz viaje! 🚀**
