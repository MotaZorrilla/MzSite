# MzSite - Mi Portafolio Personal con Asistente de IA

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-77C1D2?style=for-the-badge&logo=alpine.js&logoColor=white)](https://alpinejs.dev)
[![AI](https://img.shields.io/badge/AI-61DAFB?style=for-the-badge&logo=openai&logoColor=white)](https://)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)

---

## 1. Visión del Proyecto

Un portafolio personal de vanguardia que no solo muestra mis proyectos y habilidades, sino que también demuestra mi experiencia en tecnologías de **Inteligencia Artificial** a través de un **asistente de chat interactivo** implementado y funcional.

---

## 2. Tecnologías Principales

*   **Backend:** Laravel 10.x
*   **Frontend:** Componentes Blade, **Alpine.js** para la reactividad, Tailwind CSS.
*   **Inteligencia Artificial:** Arquitectura lista para la conexión con cualquier API de IA (actualmente con respuesta simulada).

---

## 3. Estado del Proyecto: ¡Asistente de IA Implementado!

### ✅ **Funcionalidades Destacadas**

- **Asistente de IA Interactivo:**
    - Interfaz de chat completa construida con componentes Blade y Alpine.js.
    - Lógica de estado, envío de mensajes y recepción de respuestas totalmente funcional.
    - Incluye características de UX como autofocus y auto-scroll.
    - Backend preparado para conectarse a cualquier servicio de IA.

- **Arquitectura de Componentes:** La interfaz está construida con componentes Blade reutilizables, siguiendo las mejores prácticas de Laravel.

- **Base de Conocimiento Dinámica:**
    - Incluye una ruta (`/refresh-ai-knowledge`) para generar dinámicamente una base de conocimiento a partir del contenido del propio sitio, permitiendo que la IA esté siempre actualizada.

---

## 4. Guía de Puesta en Marcha

```bash
# 1. Clonar el repositorio
git clone <url-del-repositorio> MzSite
cd MzSite

# 2. Instalar dependencias
composer install
npm install

# 3. Configurar entorno
cp .env.example .env
php artisan key:generate

# 4. Compilar assets e iniciar servidor
npm run dev
php artisan serve
```

### 🧠 **Inicializar el Asistente de IA**

Una vez que el servidor esté corriendo, abre tu navegador y visita la siguiente URL para generar la base de conocimiento por primera vez:

`http://localhost:8000/refresh-ai-knowledge`

Después de este paso, el asistente de chat en el sitio principal estará listo para usar.

---

## 5. Documentación Técnica

Para un desglose técnico completo de la arquitectura, la implementación del asistente y cómo conectar una IA real, consulte:
- 📖 [`TECHNICAL_DOCUMENTATION.md`](TECHNICAL_DOCUMENTATION.md)
