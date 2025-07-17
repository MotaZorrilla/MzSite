<!-- Define el tipo de documento como HTML5 -->
<!DOCTYPE html>
<!-- Inicia el documento HTML, estableciendo el idioma en español -->
<html lang="es">
<!-- Inicia la sección de la cabecera del documento, que contiene metadatos y enlaces a recursos externos -->
<head>
    <!-- Define la codificación de caracteres a UTF-8 para soportar una amplia gama de caracteres -->
    <meta charset="UTF-8">
    <!-- Configura la ventana de visualización para asegurar que la página sea responsive en diferentes dispositivos -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Establece el título de la página que aparece en la pestaña del navegador -->
    <title>Taller Finanzas + Cripto: Construyendo tu Futuro Financiero</title>
    
    <!-- Comentarios: Enlaces a los CDN (Content Delivery Network) de Reveal.js -->
    <!-- Hoja de estilos para resetear los estilos por defecto del navegador, parte de Reveal.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/reveal.js/4.6.1/reset.min.css">
    <!-- Hoja de estilos principal de Reveal.js para la estructura y diseño de la presentación -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/reveal.js/4.6.1/reveal.min.css">
    
    <!-- Comentarios: Enlace al CDN de Chart.js -->
    <!-- Script para incluir la librería Chart.js, utilizada para crear gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Comentarios: Enlace a Font Awesome -->
    <!-- Hoja de estilos para incluir los iconos de Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Enlace a la hoja de estilos personalizada de la presentación, utilizando la función asset() de Laravel para la ruta -->
    <link rel="stylesheet" href="{{ asset('css/presentation.css') }}">
    
<!-- Cierra la sección de la cabecera -->
</head>
<!-- Inicia el cuerpo del documento HTML -->
<body>
    <!-- Contenedor principal de la presentación de Reveal.js -->
    <div class="reveal">
        <!-- Contenedor de todas las diapositivas de la presentación -->
        <div class="slides">
            <!-- Diapositiva de Portada -->
            <section class="cover-slide" style="background-image: url({{ asset('images/presentation/portada.jpg') }});">
                <div class="cover-content">
                    <h1>Taller <br>Finanzas + Cripto</h1>
                    <h3>Construyendo tu Futuro Financiero</h3>
                    <div class="presenters">
                        <div>
                            <p>Alejandro Jiménez</p>
                            <p>@finanzasconale</p>
                        </div>
                        <div>
                            <p>Héctor Mota Zorrilla</p>
                            <p>@MotaZorrilla</p>
                        </div>
                    </div>
                    <a href="https://motazorrilla.com" class="signature-link" target="_blank" rel="noopener noreferrer">
                        <img src="{{ asset('images/MotaZorrilla.png') }}" alt="Firma de Héctor Mota Zorrilla">
                    </a>
                </div>
            </section>

            <!-- Diapositiva de Agenda -->
            <section>
                <!-- Cabecera de la sección de la agenda -->
                <div class="section-header">
                    <h2>Agenda del Taller</h2>
                </div>
                
                <!-- Contenedor para los módulos de la agenda, usando un diseño de cuadrícula -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                    <!-- Módulo 1 de la agenda -->
                    <div style="background: white; border-radius: 10px; padding: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                        <h3 style="color: var(--primary-color);">Módulo 1</h3>
                        <h4>Fundamentos Financieros</h4>
                        <ul style="text-align: left;">
                            <li>Planificación Financiera</li>
                            <li>Regla 50/30/20</li>
                            <li>Gastos Hormiga</li>
                            <li>Presupuesto inteligente</li>
                            <li>Anillos de seguridad</li>
                        </ul>
                    </div>
                    
                    <!-- Módulo 2 de la agenda -->
                    <div style="background: white; border-radius: 10px; padding: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                        <h3 style="color: var(--primary-color);">Módulo 2</h3>
                        <h4>El Poder de la Inversión</h4>
                        <ul style="text-align: left;">
                            <li>Interés compuesto</li>
                            <li>Tipos de inversiones</li>
                            <li>Fondos indexados/ETFs</li>
                            <li>Planes de ahorro</li>
                        </ul>
                    </div>
                    
                    <!-- Módulo 3 de la agenda -->
                    <div style="background: white; border-radius: 10px; padding: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                        <h3 style="color: var(--primary-color);">Módulo 3</h3>
                        <h4>Cripto Essentials</h4>
                        <ul style="text-align: left;">
                            <li>Blockchain en 5 minutos</li>
                            <li>Compra y custodia segura</li>
                            <li>Riesgos y protección</li>
                            <li>Integración con finanzas</li>
                        </ul>
                    </div>
                </div>
                
                <!-- Información adicional sobre recursos y participación -->
                <div style="margin-top: 30px; font-size: 1.2rem;">
                    <p><i class="fas fa-globe" style="color: var(--primary-color);" aria-hidden="true"></i> Todos los recursos en: <strong>motazorrilla.com</strong></p>
                    <p><i class="fas fa-poll" style="color: var(--accent-color);" aria-hidden="true"></i> Participa en vivo con <strong>Mentimeter</strong></p>
                </div>
            </section>

            <!-- Diapositiva: Módulo 1: Fundamentos Financieros -->
            <section>
                <!-- Sub-diapositiva: Introducción al Módulo 1 -->
                <section>
                    <div class="section-header">
                        <h2>Módulo 1: Fundamentos Financieros</h2>
                        <p>Por Alejandro Jiménez</p>
                    </div>
                    
                    <p>La base para construir un futuro financiero sólido</p>
                    
                    <div class="image-placeholder medium-placeholder">
                        Imagen: Fundamentos financieros
                    </div>
                </section>
                
                <!-- Diapositiva: Cierre y Recursos -->
                <section>
                    <!-- Sección de llamada a la acción y pie de página -->
                    <div class="footer-cta">
                        <h2 style="color: white;">¡Empieza Hoy Mismo!</h2>
                        <p>Tu futuro financiero comienza con el primer paso</p>
                        
                        <!-- Botones de llamada a la acción -->
                        <div class="cta-buttons">
                            <button class="cta-button" aria-label="Descargar Recursos">
                                <i class="fas fa-download" aria-hidden="true"></i> Descargar Recursos
                            </button>
                            <button class="cta-button" aria-label="Ver Próximo Taller">
                                <i class="fas fa-calendar-check" aria-hidden="true"></i> Próximo Taller
                            </button>
                            <button class="cta-button" aria-label="Obtener Plan Personalizado">
                                <i class="fas fa-file-alt" aria-hidden="true"></i> Plan Personalizado
                            </button>
                        </div>
                        
                        <!-- Enlaces a redes sociales -->
                        <div style="margin-top: 40px;">
                            <h3 style="color: white;">Síguenos para más contenido</h3>
                            <div class="social-links">
                                <a href="#" class="social-link" aria-label="Síguenos en Twitter"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                <a href="#" class="social-link" aria-label="Síguenos en Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                                <a href="#" class="social-link" aria-label="Síguenos en YouTube"><i class="fab fa-youtube" aria-hidden="true"></i></a>
                                <a href="#" class="social-link" aria-label="Síguenos en LinkedIn"><i class="fab fa-linkedin" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        
                        <!-- Información de contacto y derechos de autor -->
                        <div style="margin-top: 40px; font-size: 0.9rem; opacity: 0.8;">
                            <p>motazorrilla.com | @finanzasconale</p>
                            <p>Taller Finanzas + Cripto - Todos los derechos reservados</p>
                        </div>
                    </div>
                </section>
                <!-- Sub-diapositiva: La Regla 50/30/20 Evolucionada -->
                <section>
                    <h3>La Regla 50/30/20 Evolucionada</h3>
                    
                    <!-- Calculadora interactiva para la regla 50/30/20 -->
                    <div class="calculator">
                        <label for="monthly-income" class="sr-only">Ingresa tu sueldo mensual</label>
                        <input type="number" id="monthly-income" placeholder="Ingresa tu sueldo mensual" aria-label="Sueldo mensual">
                        
                        <div class="results" role="region" aria-live="polite" aria-atomic="true">
                            <div class="result-item">
                                <h4>Necesidades (50%)</h4>
                                <span id="needs" aria-live="polite">$0.00</span>
                            </div>
                            <div class="result-item">
                                <h4>Deseos (30%)</h4>
                                <span id="wants" aria-live="polite">$0.00</span>
                            </div>
                            <div class="result-item">
                                <h4>Ahorro (15%)</h4>
                                <span id="savings" aria-live="polite">$0.00</span>
                            </div>
                            <div class="result-item">
                                <h4>Cripto (5%)</h4>
                                <span id="crypto" aria-live="polite">$0.00</span>
                            </div>
                        </div>
                    </div>
                    
                    <p class="fragment">Adaptación moderna para incluir inversiones digitales</p>
                </section>
                
                <!-- Sub-diapositiva: Gastos Hormiga -->
                <section>
                    <h3>¡Cuidado con los Gastos Hormiga!</h3>
                    
                    <!-- Simulador interactivo de gastos hormiga -->
                    <div class="ant-expenses-simulator" role="form" aria-labelledby="gastos-hormiga-heading">
                        <h4 id="gastos-hormiga-heading" class="sr-only">Simulador de Gastos Hormiga</h4>
                        <div class="ant-item">
                            <i class="fas fa-coffee" aria-hidden="true"></i>
                            <label for="coffee-expense">Café diario ($):</label>
                            <input type="number" id="coffee-expense" value="0" min="0" aria-label="Gasto de café diario">
                        </div>
                        <div class="ant-item">
                            <i class="fas fa-utensils" aria-hidden="true"></i>
                            <label for="food-expense">Comidas fuera ($):</label>
                            <input type="number" id="food-expense" value="0" min="0" aria-label="Gasto en comidas fuera">
                        </div>
                        <div class="ant-item">
                            <i class="fas fa-tv" aria-hidden="true"></i>
                            <label for="subscriptions-expense">Suscripciones ($):</label>
                            <input type="number" id="subscriptions-expense" value="0" min="0" aria-label="Gasto en suscripciones">
                        </div>
                        <div class="ant-item">
                            <i class="fas fa-shopping-cart" aria-hidden="true"></i>
                            <label for="impulse-expense">Compras impulsivas ($):</label>
                            <input type="number" id="impulse-expense" value="0" min="0" aria-label="Gasto en compras impulsivas">
                        </div>
                    </div>
                    
                    <!-- Total calculado de gastos hormiga -->
                    <div class="ant-total" role="region" aria-live="polite" aria-atomic="true">
                        <p>Total de Gastos Hormiga al mes: <span id="ant-expenses-total" aria-live="polite">$0.00</span></p>
                    </div>
                    
                    <p class="fragment">Identifícalos y transfórmalos en ahorro</p>
                </section>
                
                <!-- Sub-diapositiva: Anillos de Seguridad Financiera -->
                <section>
                    <h3>Los Anillos de Seguridad Financiera</h3>
                    
                    <!-- Representación visual de los anillos de seguridad -->
                    <div class="security-rings">
                        <div class="ring ring-1">
                            <i class="fas fa-shield-alt" aria-hidden="true"></i>
                            <h4>Fondo de Emergencia</h4>
                            <p>3-6 meses de gastos</p>
                        </div>
                        <div class="ring ring-2">
                            <i class="fas fa-umbrella" aria-hidden="true"></i>
                            <h4>Seguros</h4>
                            <p>Salud, vida, propiedad</p>
                        </div>
                        <div class="ring ring-3">
                            <i class="fas fa-chart-line" aria-hidden="true"></i>
                            <h4>Inversiones</h4>
                            <p>Diversificación</p>
                        </div>
                        <div class="ring ring-4">
                            <i class="fas fa-piggy-bank" aria-hidden="true"></i>
                            <h4>Jubilación</h4>
                            <p>Planes a largo plazo</p>
                        </div>
                    </div>
                    
                    <p class="fragment">Tu red de protección contra imprevistos</p>
                </section>
            </section>

            <!-- Diapositiva: Módulo 2: El Poder de la Inversión -->
            <section>
                <!-- Sub-diapositiva: Introducción al Módulo 2 -->
                <section>
                    <div class="section-header">
                        <h2>Módulo 2: El Poder de la Inversión</h2>
                        <p>Por Alejandro Jiménez</p>
                    </div>
                    
                    <p>Haz que tu dinero trabaje para ti</p>
                    
                    <div class="image-placeholder medium-placeholder">
                        Imagen: Crecimiento de inversiones
                    </div>
                </section>
                
                <!-- Sub-diapositiva: El Interés Compuesto -->
                <section>
                    <h3>El Interés Compuesto: La Octava Maravilla</h3>
                    
                    <!-- Simulador interactivo de interés compuesto -->
                    <div class="compound-interest-simulator" role="form" aria-labelledby="interes-compuesto-heading">
                        <h4 id="interes-compuesto-heading" class="sr-only">Simulador de Interés Compuesto</h4>
                        <div class="input-group">
                            <label for="initial-investment">Inversión Inicial ($):</label>
                            <input type="number" id="initial-investment" value="1000" min="0" aria-label="Inversión inicial">
                        </div>
                        <div class="input-group">
                            <label for="monthly-contribution">Aporte Mensual ($):</label>
                            <input type="number" id="monthly-contribution" value="100" min="0" aria-label="Aporte mensual">
                        </div>
                        <div class="input-group">
                            <label for="annual-return">Retorno Anual (%):</label>
                            <input type="number" id="annual-return" value="7" min="0" step="0.1" aria-label="Retorno anual en porcentaje">
                        </div>
                        <div class="input-group">
                            <label for="investment-period">Período (años):</label>
                            <input type="number" id="investment-period" value="30" min="1" aria-label="Período de inversión en años">
                        </div>
                        <div class="total-result" role="region" aria-live="polite" aria-atomic="true">
                            <p>Valor Futuro: <span id="future-value" aria-live="polite">$0.00</span></p>
                        </div>
                    </div>
                    
                    <!-- Contenedor para el gráfico de Chart.js -->
                    <div style="width: 80%; margin: 20px auto;">
                        <canvas id="compoundInterestChart" role="img" aria-label="Gráfico de crecimiento de la inversión a lo largo del tiempo"></canvas>
                    </div>
                    
                    <p class="fragment">Empieza hoy, tu yo del futuro te lo agradecerá</p>
                </section>
                
                <!-- Sub-diapositiva: Tipos de Inversiones -->
                <section>
                    <h3>Tipos de Inversiones</h3>
                    
                    <!-- Ejemplos de tipos de inversiones -->
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin: 30px 0;">
                        <div style="background: rgba(25, 118, 210, 0.1); padding: 20px; border-radius: 10px;">
                            <h4 style="color: var(--heading-color);">Acciones</h4>
                            <p>Participación en empresas</p>
                        </div>
                        <div style="background: rgba(25, 118, 210, 0.1); padding: 20px; border-radius: 10px;">
                            <h4 style="color: var(--heading-color);">Bonos</h4>
                            <p>Préstamos a gobiernos/empresas</p>
                        </div>
                        <div style="background: rgba(25, 118, 210, 0.1); padding: 20px; border-radius: 10px;">
                            <h4 style="color: var(--heading-color);">Fondos</h4>
                            <p>Diversificación automática</p>
                        </div>
                        <div style="background: rgba(25, 118, 210, 0.1); padding: 20px; border-radius: 10px;">
                            <h4 style="color: var(--heading-color);">Bienes Raíces</h4>
                            <p>Propiedades físicas</p>
                        </div>
                    </div>
                    
                    <p class="fragment">Diversifica para reducir riesgos</p>
                </section>
            </section>

            <!-- Diapositiva: Módulo 3: Crypto Essentials -->
            <section>
                <!-- Sub-diapositiva: Introducción al Módulo 3 -->
                <section class="crypto-section">
                    <h2 style="color: white;">Módulo 3: Crypto Essentials</h2>
                    <p>Por Héctor Zorrilla</p>
                    
                    <div class="image-placeholder medium-placeholder" style="background: rgba(255,255,255,0.1);">
                        Imagen: Blockchain o criptomonedas
                    </div>
                </section>
                
                <!-- Sub-diapositiva: Blockchain en 5 Minutos -->
                <section class="crypto-section">
                    <h3 style="color: white;">Blockchain en 5 Minutos</h3>
                    
                    <!-- Explicación de Blockchain -->
                    <div style="display: flex; gap: 30px; align-items: center; margin: 30px 0;">
                        <div style="flex: 1;">
                            <p>Un libro contable digital:</p>
                            <ul style="text-align: left;">
                                <li>Descentralizado</li>
                                <li>Inmutable</li>
                                <li>Transparente</li>
                                <li>Seguro</li>
                            </ul>
                        </div>
                        
                        <div class="image-placeholder medium-placeholder" style="background: rgba(255,255,255,0.1);">
                            Imagen: Diagrama blockchain
                        </div>
                    </div>
                    
                    <p>La tecnología detrás de Bitcoin y Ethereum</p>
                </section>
                
                <!-- Sub-diapositiva: Compra y Custodia Segura -->
                <section class="crypto-section">
                    <h3 style="color: white;">Compra y Custodia Segura</h3>
                    
                    <!-- Pasos para la compra y custodia segura de criptoactivos -->
                    <div class="crypto-steps">
                        <div class="step">
                            <div class="step-number">1</div>
                            <p>Exchange regulado</p>
                        </div>
                        <div class="step">
                            <div class="step-number">2</div>
                            <p>Verificación KYC</p>
                        </div>
                        <div class="step">
                            <div class="step-number">3</div>
                            <p>Autenticación 2FA</p>
                        </div>
                        <div class="step">
                            <div class="step-number">4</div>
                            <p>Transferencia a Wallet</p>
                        </div>
                    </div>
                    
                    <!-- Marcador de posición para una imagen del proceso de compra -->
                    <div class="image-placeholder medium-placeholder" style="margin-top: 30px; background: rgba(255,255,255,0.1);">
                        Imagen: Proceso de compra
                    </div>
                </section>
                
                <!-- Sub-diapositiva: Riesgos y Protección -->
                <section class="crypto-section">
                    <h3 style="color: white;">Riesgos y Protección</h3>
                    
                    <!-- Cuadrícula de riesgos asociados a las criptomonedas -->
                    <div class="crypto-grid">
                        <div class="crypto-card">
                            <i class="fas fa-chart-line" aria-hidden="true"></i>
                            <h3>Volatilidad</h3>
                            <p>Los precios pueden cambiar rápidamente</p>
                        </div>
                        <div class="crypto-card">
                            <i class="fas fa-shield-alt" aria-hidden="true"></i>
                            <h3>Seguridad</h3>
                            <p>Protege tus claves privadas</p>
                        </div>
                        <div class="crypto-card">
                            <i class="fas fa-exclamation-triangle" aria-hidden="true"></i>
                            <h3>Scams</h3>
                            <p>Proyectos fraudulentos</p>
                        </div>
                        <div class="crypto-card">
                            <i class="fas fa-balance-scale" aria-hidden="true"></i>
                            <h3>Regulación</h3>
                            <p>Marco legal cambiante</p>
                        </div>
                    </div>
                    
                    <p>Conoce los riesgos para gestionarlos</p>
                </section>

                <!-- Sub-diapositiva: Precios de Criptomonedas en Vivo -->
                <section class="crypto-section">
                    <h3 style="color: white;">Precios de Criptomonedas en Vivo</h3>
                    <div id="crypto-prices" style="color: white; font-size: 1.2em;">
                        Cargando precios...
                    </div>
                    <p style="font-size: 0.8em; opacity: 0.7;">Datos proporcionados por CoinGecko</p>
                </section>
            </section>

            <!-- Diapositiva: Plan de Acción -->
            <section>
                <!-- Cabecera de la sección del plan de acción -->
                <div class="section-header">
                    <h2>Tu Plan de Acción Personalizado</h2>
                    <p>Integrando finanzas tradicionales y digitales</p>
                </div>
                
                <!-- Lista de acciones del plan personalizado -->
                <div class="action-plan">
                    <div class="action-item">
                        <div class="action-icon">
                            <i class="fas fa-1" aria-hidden="true"></i>
                        </div>
                        <div class="action-content">
                            <h4>Implementa la regla 50/30/15/5</h4>
                            <p>Asigna un 5% de tus ingresos a criptoactivos</p>
                        </div>
                    </div>
                    
                    <div class="action-item">
                        <div class="action-icon">
                            <i class="fas fa-2" aria-hidden="true"></i>
                        </div>
                        <div class="action-content">
                            <h4>Crea tu fondo de emergencia</h4>
                            <p>3-6 meses de gastos básicos (considera stablecoins)</p>
                        </div>
                    </div>
                    
                    <div class="action-item">
                        <div class="action-icon">
                            <i class="fas fa-3" aria-hidden="true"></i>
                        </div>
                        <div class="action-content">
                            <h4>Automatiza tus inversiones</h4>
                            <p>Programa compras recurrentes de ETFs y cripto</p>
                        </div>
                    </div>
                    
                    <div class="action-item">
                        <div class="action-icon">
                            <i class="fas fa-4" aria-hidden="true"></i>
                        </div>
                        <div class="action-content">
                            <h4>Protege tus activos</h4>
                            <p>Implementa 2FA y considera un hardware wallet</p>
                        </div>
                    </div>
                </div>
                
                <p><strong>Descarga tu plan personalizado en: motazorrilla.com/plan</strong></p>
            </section>

            <!-- Diapositiva: Cierre y Recursos -->
            <section>
                <!-- Sección de llamada a la acción y pie de página -->
                <div class="footer-cta">
                    <h2 style="color: white;">¡Empieza Hoy Mismo!</h2>
                    <p>Tu futuro financiero comienza con el primer paso</p>
                    
                    <!-- Botones de llamada a la acción -->
                    <div class="cta-buttons">
                        <button class="cta-button" aria-label="Descargar Recursos">
                            <i class="fas fa-download" aria-hidden="true"></i> Descargar Recursos
                        </button>
                        <button class="cta-button" aria-label="Ver Próximo Taller">
                            <i class="fas fa-calendar-check" aria-hidden="true"></i> Próximo Taller
                        </button>
                        <button class="cta-button" aria-label="Obtener Plan Personalizado">
                            <i class="fas fa-file-alt" aria-hidden="true"></i> Plan Personalizado
                        </button>
                    </div>
                    
                    <!-- Enlaces a redes sociales -->
                    <div style="margin-top: 40px;">
                        <h3 style="color: white;">Síguenos para más contenido</h3>
                        <div class="social-links">
                            <a href="#" class="social-link" aria-label="Síguenos en X"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                            <a href="#" class="social-link" aria-label="Síguenos en Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                            <a href="#" class="social-link" aria-label="Síguenos en YouTube"><i class="fab fa-youtube" aria-hidden="true"></i></a>
                            <a href="#" class="social-link" aria-label="Síguenos en LinkedIn"><i class="fab fa-linkedin" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    
                    <!-- Información de contacto y derechos de autor -->
                    <div style="margin-top: 40px; font-size: 0.9rem; opacity: 0.8;">
                        <p>@motazorrilla | @finanzasconale</p>
                        <p>Taller Finanzas + Cripto - Todos los derechos reservados</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
    
    <!-- Scripts -->
    <!-- Script principal de Reveal.js para la funcionalidad de la presentación -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/reveal.js/4.6.1/reveal.min.js"></script>
    <!-- Script personalizado de la presentación, utilizando la función asset() de Laravel para la ruta -->
    <script src="{{ asset('js/presentation.js') }}"></script>
    
<!-- Cierra el cuerpo del documento HTML -->
</body>
<!-- Cierra el documento HTML -->
</html>