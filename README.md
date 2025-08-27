# Proyecto: Trazados y Planchas - Repositorio Masónico

## Descripción General

Este proyecto es una aplicación web desarrollada en Laravel 10 que tiene como objetivo crear un repositorio digital seguro para documentos masónicos, denominados "Trazados y Planchas". La plataforma gestionará el acceso a los documentos basado en el grado masónico del usuario, asegurando que el material sea accesible solo para los miembros autorizados.

Para visitantes no autenticados, la página principal del repositorio (`/masonry`) ofrece una experiencia enriquecida con secciones públicas que incluyen información sobre el archivo, extractos destacados de obras, preguntas frecuentes sobre la masonería y testimonios.

## Tecnologías Principales

*   **Backend:** Laravel 10
*   **Frontend:** Blade con Bootstrap
*   **Autenticación:** Laravel Breeze (anteriormente Laravel UI)
*   **Base de Datos:** SQLite (para desarrollo)
*   **Gestión de Activos:** Vite

## Plan de Desarrollo

El desarrollo de la aplicación se divide en las siguientes fases:

### FASE 1: Panel de Administración y Gestión de Contenido
*   **Objetivo:** Crear una interfaz segura para que los administradores gestionen el contenido y los usuarios.
*   **Tareas:**
    *   Crear un panel de administración (`/admin`).
    *   Implementar la funcionalidad para subir, editar y eliminar archivos (PDFs).
    *   Gestionar las preguntas y respuestas utilizadas en el proceso de registro para la validación de grado.

### FASE 2: Registro Público y Acceso por Grado
*   **Objetivo:** Permitir que nuevos usuarios se registren y accedan al contenido correspondiente a su grado.
*   **Tareas:**
    *   Desarrollar un formulario de registro público (gestionado por Laravel Breeze).
    *   Implementar un sistema de preguntas dinámicas que se presentan durante el registro para verificar el grado del usuario.
    *   Asegurar que los usuarios solo puedan ver y descargar los documentos autorizados para su grado.

### FASE 3: Interacción y Mejoras de UX
*   **Objetivo:** Mejorar la experiencia del usuario y añadir funcionalidades de interacción.
*   **Tareas:**
    *   Añadir un sistema de comentarios en los documentos, gestionable por los administradores.
    *   **Autenticación:** Se ha implementado el sistema de autenticación de Laravel Breeze, reemplazando los modales de Livewire por páginas completas de inicio de sesión y registro con un diseño consistente.
    *   **Contenido Público:** La página del repositorio (`/masonry`) ahora incluye secciones públicas como "Sobre el Archivo Masónico", "Extractos Públicos Destacados", "Preguntas Frecuentes" y "Testimonios y Comentarios" para enriquecer la experiencia de los visitantes no autenticados.

### FASE 4: Pulido General
*   **Objetivo:** Finalizar la aplicación, mejorando la navegación y la identidad visual.
*   **Tareas:**
    *   Refinar la navegación interna entre las diferentes secciones.
    *   Consolidar la marca visual y el diseño general de la plataforma.

### Pruebas
*   Se están desarrollando pruebas unitarias y de características para asegurar la robustez y el correcto funcionamiento de la aplicación, especialmente para la gestión de obras masónicas.