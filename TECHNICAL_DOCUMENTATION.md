# Documentación Técnica - MzSite (Portafolio Personal)

---

## 🔍 **AUDITORÍA TÉCNICA - Octubre 2025**

**Estado General:** ✅ **Implementación de Asistente de IA Completada.**

### 📈 **MÉTRICAS TÉCNICAS FINALES**

| Categoría | Puntuación | Estado | Observaciones |
|---|---|---|---|
| **Arquitectura** | 9.0/10 | ✅ Excelente | Componentes Blade + Alpine.js para una UI reactiva y modular. |
| **Mantenibilidad**| 9.0/10 | ✅ Excelente | Fácil de actualizar gracias a la separación de lógica y componentes. |
| **Innovación** | 8.5/10 | ✅ Excelente | La implementación del Asistente de IA es un diferenciador clave. |
| **Puntuación General**| **8.8/10** | ✅ **PROYECTO DE ALTO NIVEL** | **La base es moderna, robusta y funcional.** |

---

## ✅ **Implementación del Asistente de IA**

Esta sección detalla la arquitectura y los componentes desarrollados para el Asistente de IA interactivo.

### **1. Backend**

#### **1.1. Base de Conocimiento**
- **Mecanismo:** Se implementó un método (`refreshKnowledge`) en el `AIController` que se activa a través de la ruta `GET /refresh-ai-knowledge`.
- **Funcionalidad:** Este método lee el contenido de todos los componentes Blade relevantes del sitio (About, Resume, Skills, etc.), extrae el texto puro y lo consolida en un único archivo: `storage/app/knowledge_base.txt`. Esto permite que la "memoria" de la IA se actualice fácilmente sin necesidad de acceso a la CLI.

#### **1.2. API de Chat**
- **Ruta:** Se creó la ruta `POST /api/chat` para gestionar las solicitudes de los usuarios desde la interfaz del chat.
- **Controlador:** El método `chat` en `AIController` recibe la pregunta del usuario.
- **Respuesta (Simulada):** Actualmente, el método devuelve una respuesta simulada para confirmar que todo el flujo de datos funciona. El siguiente paso es reemplazar esta simulación con una llamada a una API de IA real.

### **2. Frontend**

La interfaz del chat se construyó utilizando dos componentes Blade principales, orquestados por Alpine.js.

#### **2.1. Componentes Visuales**
- **`components/site/chat-trigger.blade.php`:** Un botón flotante que controla la visibilidad de la ventana de chat.
- **`components/site/chat-window.blade.php`:** La interfaz de usuario completa del chat, que incluye la cabecera, el área de mensajes y el campo de entrada de texto.

#### **2.2. Lógica Reactiva (Alpine.js)**
- **Gestión de Estado:** Se añadió un objeto `chatBot()` en `site.blade.php` para gestionar todo el estado del chat, incluyendo:
    - `showChat`: Controla la visibilidad de la ventana.
    - `messages`: Un array que almacena el historial de la conversación.
    - `loading`, `newMessage`: Variables para el estado de la UI.
- **Interacción:** La función `sendMessage()` se encarga de enviar la pregunta del usuario al backend (`/api/chat`) usando `fetch()` y de añadir las respuestas al historial de mensajes.

### **3. Refinamientos de Experiencia de Usuario (UX)**

Durante la implementación, se realizaron varios ajustes clave basados en pruebas:

- **Posicionamiento:** Se ajustó la posición del botón del chat (`chat-trigger`) para asegurar que no se solape con otros elementos flotantes como el botón de WhatsApp o de "volver arriba".
- **Autofocus:** Al abrir la ventana del chat, el cursor se posiciona automáticamente en el campo de texto, invitando a la interacción inmediata. Esto se logró con `this.$refs.chatInput.focus()`.
- **Auto-Scroll:** La ventana de conversación se desplaza automáticamente hacia el mensaje más reciente, asegurando que la caja de texto esté siempre visible y fija en la parte inferior. Esto se implementó con una función `scrollToBottom()` que utiliza `this.$refs.messageContainer.scrollTop`.

---

## 🧠 **Paso Final: Cómo Conectar una IA Real**

La arquitectura está lista. Para reemplazar la respuesta simulada por una real, sigue estos pasos:

1.  **Elige un Proveedor de IA:** Google (Gemini), OpenAI (GPT-4/3.5), etc.
2.  **Obtén una Clave de API:** Regístrate en la plataforma del proveedor y obtén tu clave.
3.  **Guárdala de Forma Segura:** Añade tu clave al archivo `.env` de tu proyecto. Por ejemplo: `OPENAI_API_KEY=tu_clave_aqui`.
4.  **Modifica el Controlador:** Abre el archivo `app/Http/Controllers/AIController.php` y ve al método `chat`.
5.  **Implementa la Llamada a la API:**
    - Descomenta las líneas de código que preparan el `prompt`.
    - Utiliza el cliente HTTP de Laravel para hacer una llamada `POST` a la URL de la API de tu proveedor, enviando el `prompt` y tu clave de API en las cabeceras.
    - Asigna la respuesta de la API a la variable `$reply`.

**Ejemplo conceptual para OpenAI:**

```php
// Dentro del método chat() en AIController.php

$knowledge = Storage::disk('local')->get('knowledge_base.txt');
$prompt = "Basado en la siguiente información sobre Héctor Mota:\n\n{$knowledge}\n\nResponde a esta pregunta: {$userMessage}";

$response = \Illuminate\Support\Facades\Http::withToken(config('services.openai.secret'))->post('https://api.openai.com/v1/chat/completions', [
    'model' => 'gpt-3.5-turbo',
    'messages' => [
        ['role' => 'system', 'content' => $prompt],
        ['role' => 'user', 'content' => $userMessage],
    ],
]);

$reply = $response->json('choices.0.message.content');

return response()->json(['reply' => $reply]);
```

---

## 🟡 **Tareas Pendientes**

- **Rediseño de la Sección "Games":** Modernizar la UI de esta sección para mostrar mejor las producciones de video.
