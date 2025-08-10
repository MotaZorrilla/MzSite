### PLAN DE ACCIÓN: Mejoras "Plumber Battle"

1.  **Integración en el Portafolio Principal:**
    *   Localizar la vista principal del portafolio (probablemente `site.blade.php`).
    *   Añadir una "tarjeta" o sección para el juego "Plumber Battle", enlazando a la ruta correspondiente.
    *   En la descripción de la tarjeta, añadir un texto destacado indicando que es **jugable en dispositivos móviles**, diferenciándolo de otros proyectos.

2.  **Análisis de Código Existente:**
    *   Estudiar `plumber.blade.php` y su JavaScript asociado para entender la implementación actual del juego y su interfaz.
    *   Estudiar `tetris.blade.php` como **referencia visual y funcional** para las nuevas características.

3.  **Mejoras de Interfaz en `plumber.blade.php`:**
    *   **Cabecera:** Reemplazar la imagen de Tetris por `PlumberBattleJS.png` o un título estilizado.
    *   **Botón de Ayuda (`?`):** Implementar un modal que explique las reglas y controles (teclado y táctil) específicos de Plumber.
    *   **Botón de Sonido:** Hacer que el botón silencie únicamente la música de fondo, no los efectos de sonido.
    *   **Selección de Dificultad:** Conectar el modal de dificultad existente para que efectivamente ajuste la jugabilidad de Plumber.

4.  **Sistema de Puntuación:**
    *   **Frontend:** Mostrar la puntuación en pantalla y enviarla al backend al terminar la partida.
    *   **Backend:** Crear una ruta y un método en un controlador para recibir y guardar la puntuación en la base de datos.
