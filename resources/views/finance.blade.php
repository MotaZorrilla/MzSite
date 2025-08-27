<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taller Finanzas + Cripto: Construyendo tu Futuro Financiero</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/reveal.js/4.6.1/reset.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/reveal.js/4.6.1/reveal.min.css">


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/presentation.css') }}?v=1.2">
    <style>
        * {
            box-sizing: border-box;
        }

        .reveal .slides section .slide-box {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
        }

        html {
            background-color: lime !important;
            /* Diagnostic color for html element */
        }

        /* Specific styles for the cover slide to ensure they apply */
        .reveal .slides section.cover-slide .cover-content h1 {
            color: #0d2c4f !important;
            text-shadow: none !important;
        }

        .reveal .slides section.cover-slide .cover-content h3,
        .reveal .slides section.cover-slide .cover-content .presenters p {
            color: #343a40 !important;
        }

        /* Roadmap Item Styles - Injected for Max Priority */
        .reveal .slides section.slide-box .roadmap-item {
            background: white !important;
            border-radius: 10px !important;
            padding: 20px !important;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
            border: 1px solid #e0e0e0 !important;
            color: #212529 !important;
            display: flex !important;
            flex-direction: column !important;
            position: relative !important;
            /* Needed for absolute positioning of the image */
            overflow: hidden !important;
            /* Ensures the image doesn't spill out */
        }

        .reveal .slides section.slide-box .roadmap-item h3 {
            color: #007bff !important;
            font-size: 1em !important;
        }

        .reveal .slides section.slide-box .roadmap-item h4 {
            color: #343a40 !important;
            font-size: 0.85em !important;
        }

        .reveal .slides section.slide-box .roadmap-item ul {
            list-style-type: disc !important;
            margin-left: 20px !important;
            text-align: left !important;
        }

        .reveal .slides section.slide-box .roadmap-item li {
            font-size: 0.75em !important;
            line-height: 1.4 !important;
        }

        .section-header h2 {
            font-size: 2em !important;
            /* Adjusted font size */
            text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.7);
            /* White shadow */
        }

        .roadmap-item-image {
            position: absolute;
            right: 0;
            /* Position to the right edge */
            bottom: 0;
            /* Position to the bottom edge */
            height: 100%;
            /* Adapt to card height */
            width: auto;
            /* Maintain aspect ratio */
            object-fit: contain;
            /* Ensure it fits within the bounds */
            opacity: 1;
            /* Make it fully opaque */
            z-index: 1;
            -webkit-mask-image: linear-gradient(to right, transparent 5%, black 40%);
            mask-image: linear-gradient(to right, transparent 5%, black 40%);
        }

        .ci-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25); /* More pronounced shadow */
            padding: 10px; /* Reduced padding */
        }

        /* Styles for the Context section */
        .context-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            height: 100%;
            /* Ensure it takes full height of the slide-box */
            padding: 20px;
            /* Add padding to the content */
        }

        .context-text {
            flex: 1;
            z-index: 2;
            position: relative;
            padding-right: 20px;
            /* Space for the image */
        }

        .context-image {
            position: absolute;
            right: 0;
            bottom: 0;
            height: 100%;
            width: 50%;
            /* Adjust as needed */
            overflow: hidden;
            z-index: 1;
        }

        .context-image img {
            height: 100%;
            width: 100%;
            object-fit: contain;
            opacity: 1;
            /* Make image fully opaque */
        }
    </style>

</head>

<body>
    <div class="reveal">
        <div class="slides">

            <section class="cover-slide" style="background-image: url({{ asset('images/presentation/portada.jpg') }});">
                <div class="cover-content">
                    <h1>Finanzas + Cripto</h1>
                    <h2>Construyendo tu Futuro</h2>
                    <div class="presenters">
                        <div>
                            <p>Alejandro Jiménez</p>
                            <a href="https://www.instagram.com/finanzasconale/">@finanzasconale</a> 
                        </div>
                        <div>
                            <p><br>Héctor Mota Zorrilla</p>
                            <a href="https://motazorrilla.com">@MotaZorrilla</a>
                        </div>
                    </div>
                    <a href="https://motazorrilla.com" class="signature-link" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 4px; color:#000;">
                        by: <img src="{{ asset('images/MotaZorrilla.png') }}" alt="Firma de Héctor Mota Zorrilla" style="height: 20px;">
                    </a>
                </div>
            </section>

            <section class="slide-box" style="padding: 40px !important;">
                <div class="section-header">
                    <h2 style="color: #001f3f;">Nuestra Hoja de Ruta</h2>
                </div>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 20px; grid-auto-rows: 1fr;">
                    <div class="roadmap-item" data-slide-index="2" style="cursor: pointer;">
                        <div class="roadmap-item-content">
                            <h3>1. El Contexto</h3>
                            <h4>¿Por Qué Planificar Ahora?</h4>
                            <ul>
                                <li>El reto de la longevidad y el retiro </li>

                            </ul>
                        </div>
                        <img src="{{ asset('finance/images/contexto.png') }}" alt="Icono de El Contexto" class="roadmap-item-image">
                    </div>
                    <div class="roadmap-item" data-slide-index="3" style="cursor: pointer;">
                        <div class="roadmap-item-content">
                            <h3>2. La Base</h3>
                            <h4>Tu Mapa Financiero</h4>
                            <ul>
                                <li>El Presupuesto: Tu herramienta de control</li>
                                <li>Gastos Hormiga: El enemigo silencioso</li>
                                <li>Ahorro: La Regla 50/30/20</li>
                            </ul>
                        </div>
                        <img src="{{ asset('finance/images/base.png') }}" alt="Icono de La Base" class="roadmap-item-image">
                    </div>
                    <div class="roadmap-item" data-slide-index="4" style="cursor: pointer;">
                        <div class="roadmap-item-content">
                            <h3>3. El Motor</h3>
                            <h4>Inversión Inteligente</h4>
                            <ul>
                                <li>Interés Compuesto: La 8ª maravilla</li>
                                <li>Vehículos de Inversión (Fondos, ETFs)</li>
                            </ul>
                        </div>
                        <img src="{{ asset('finance/images/motor.png') }}" alt="Icono de El Motor" class="roadmap-item-image">
                    </div>
                    <div class="roadmap-item" data-slide-index="5" style="cursor: pointer;">
                        <div class="roadmap-item-content">
                            <h3>4. La Protección</h3>
                            <h4>Tu Red de Seguridad</h4>
                            <ul>
                                <li>Riesgos: Inflación, Mercado, Liquidez</li>
                                <li>Anillos de Seguridad Financiera</li>
                            </ul>
                        </div>
                        <img src="{{ asset('finance/images/proteccion.png') }}" alt="Icono de La Protección" class="roadmap-item-image">
                    </div>
                    <div class="roadmap-item" data-slide-index="6" style="cursor: pointer;">
                        <div class="roadmap-item-content">
                            <h3>5. El Futuro Digital</h3>
                            <h4>Cripto Essentials</h4>
                            <ul>
                                <li>Blockchain y Criptomonedas</li>
                                <li>Compra, custodia y riesgos</li>
                            </ul>
                        </div>
                        <img src="{{ asset('finance/images/cripto.png') }}" alt="Icono de El Futuro Digital" class="roadmap-item-image">
                    </div>
                    <div class="roadmap-item" data-slide-index="7" style="cursor: pointer;">
                        <div class="roadmap-item-content">
                            <h3>6. Tu Plan</h3>
                            <h4>¡Manos a la Obra!</h4>
                            <ul>
                                <li>Integrando finanzas tradicionales y digitales</li>
                                <li>Pasos concretos para empezar hoy</li>
                            </ul>
                        </div>
                        <img src="{{ asset('finance/images/plan.png') }}" alt="Icono de Tu Plan" class="roadmap-item-image">
                    </div>
                </div>
            </section>

            <section>
                <section class="slide-box" style="padding: 40px !important; display: flex; flex-direction: column;">
                    <div class="section-header">
                        <h2 style="color: #001f3f;">1. El Contexto: ¿Por Qué Planificar Hoy?</h2>
                        <p>Por Alejandro Jiménez</p>
                    </div>
                    <!-- The new card wrapper -->
                    <div class="roadmap-item" style="flex-grow: 1; display: flex; padding: 20px;">
                        <div class="context-content" style="width: 100%; display: flex; align-items: center;">
                            <div class="context-text" style="width: 50%; padding-right: 20px; text-align: left;">
                                <h3>Tienes una idea de cuanto Necesitarás para el retiro? </h3>
                                <p class="fragment">Los avances en medicina alargan la vida y la tecnología (IA) transforma el trabajo. Prepararse ya no es una opción, es una necesidad.</p>
                                <p style="margin-top: 20px; font-size: 1.1em; color: #333333;">¡Participa en nuestra encuesta interactiva!</p>
                                <button onclick="window.open('https://www.menti.com/alp4sbiewdw9', '_blank');" style="background: #1976d2; color: white; border: none; padding: 10px 20px; border-radius: 50px; font-size: 1em; cursor: pointer; display: inline-flex; align-items: center; margin-top: 10px; text-decoration: none; font-weight: bold; transition: all 0.3s ease;">
                                    Ir a la Encuesta <i class="fas fa-poll" style="margin-left: 8px;"></i>
                                </button>
                            </div>
                            <div class="context-image" style="width: 50%; height: 100%; position: relative;">
                                <img src="{{ asset('finance/images/planificarHoy.png') }}" alt="Imagen de Planificar Hoy" style="width: 100%; height: 100%; object-fit: contain; border-radius: 15px; opacity: 1;">
                            </div>
                        </div>
                    </div>
                </section>
            </section>

            <section>
                <!-- Slide 1: Main -->
                <section class="slide-box" style="padding: 40px !important; display: flex; flex-direction: column;">
                    <div class="section-header">
                        <h2 style="color: #001f3f;">2. La Base: Tu Mapa Financiero</h2>
                        <p>Por Alejandro Jiménez</p>
                    </div>
                    <div class="roadmap-item" style="flex-grow: 1; display: flex; flex-direction: row !important; padding: 20px; align-items: center;">
                        <div style="width: 50%; padding-right: 20px; text-align: left;">
                            <p style="font-size: 1.2em;">No puedes llegar a tu destino sin un mapa. Aquí aprenderás a crear el tuyo.</p>
                        </div>
                        <div style="width: 50%; height: 100%; position: relative;">
                            <img src="{{ asset('finance/images/base.png') }}" alt="Mapa Financiero" style="width: 100%; height: 100%; object-fit: contain; border-radius: 15px; opacity: 1;">
                        </div>
                    </div>
                </section>

                <!-- Slide 2: Presupuesto -->
                <section class="slide-box" style="padding: 40px !important; display: flex; flex-direction: column;">
                    <div class="roadmap-item" style="flex-grow: 1; display: flex; flex-direction: row !important; padding: 20px; align-items: center;">
                        <div style="width: 50%; padding-right: 20px; text-align: left;">
                            <h3>El Presupuesto: Tu Herramienta de Control</h3>
                            <p>Un presupuesto te da el poder de decirle a tu dinero a dónde ir, en lugar de preguntarte a dónde se fue. </p>
                            <div style="display: flex; gap: 20px; align-items: stretch; margin-top: 30px;">
                                <div style="flex: 1; background: rgba(255,255,255,0.1); padding: 15px; border-radius: 8px;">
                                    <i class="fas fa-arrow-down" style="color: #4CAF50;"></i>
                                    <h4>1. Calcula tus Ingresos</h4>
                                    <p>Salario neto, ingresos extra, etc. </p>
                                </div>
                                <div style="flex: 1; background: rgba(255,255,255,0.1); padding: 15px; border-radius: 8px;">
                                    <i class="fas fa-arrow-up" style="color: #F44336;"></i>
                                    <h4>2. Registra tus Gastos</h4>
                                    <p>Fijos (alquiler) y variables (ocio). </p>
                                </div>
                                <div style="flex: 1; background: rgba(255,255,255,0.1); padding: 15px; border-radius: 8px;">
                                    <i class="fas fa-sync-alt" style="color: #2196F3;"></i>
                                    <h4>3. Ajusta y Optimiza</h4>
                                    <p>Analiza dónde puedes reducir para alcanzar tus metas. </p>
                                </div>
                            </div>
                            <p class="fragment" style="margin-top: 30px; font-size: 1.1em; color: #1976d2; font-weight: bold;">¡Nueva pregunta en tu teléfono!</p>
                            <p style="margin-top: 20px; font-size: 1.1em; color: #333333;">¡Responde la encuesta de tu Archienemigo!</p>
                                    <button onclick="window.open('https://www.menti.com/alp4sbiewdw9', '_blank');" style="background: #1976d2; color: white; border: none; padding: 10px 20px; border-radius: 50px; font-size: 1em; cursor: pointer; display: inline-flex; align-items: center; margin-top: 10px; text-decoration: none; font-weight: bold; transition: all 0.3s ease;">
                                        Ir a la Encuesta <i class="fas fa-poll" style="margin-left: 8px;"></i>
                                    </button>
                        </div>
                        <div style="width: 50%; height: 100%; position: relative;">
                            <img src="{{ asset('finance/images/control.png') }}" alt="Control Presupuestario" style="width: 100%; height: 100%; object-fit: contain; border-radius: 15px; opacity: 1;">
                        </div>
                    </div>
                </section>

                <!-- Slide 3: Gastos Hormiga -->
                <section class="slide-box" style="padding: 40px !important; display: flex; flex-direction: column;">
                    <!-- Caja de título -->
                    <div class="section-header" style="position: relative; display: flex; align-items: center; gap: 16px; margin-bottom: 18px; background: #fff; border: 2.5px solid #1976d2; border-radius: 14px; box-shadow: 0 2px 10px rgba(25,118,210,0.08); padding: 18px 24px 14px 24px; overflow: hidden; min-height: 80px;">
                        <div style="z-index: 2; position: relative;">
                            <h2 style="margin: 0; color: #1976d2; font-size: 1.5em; font-weight: bold; letter-spacing: 0.5px;">¡Cuidado con los Gastos Hormiga!</h2>
                            <p style="margin: 0; color: #263238; font-size: 1em;">Pequeños gastos diarios que parecen insignificantes pero suman grandes cantidades.</p>
                        </div>
                        <img src="{{ asset('finance/images/hormiga.png') }}" alt="Gastos Hormiga" style="position: absolute; right: 0; top: 0; height: 100%; width: auto; max-width: 160px; opacity: 1; object-fit: contain; z-index: 1; pointer-events: none; border-radius: 18px 0 0 18px; background: #e3f2fd;" />
                    </div>
                    <!-- Tarjeta calculadora -->
                    <div class="roadmap-item" style="position: relative; flex-grow: 1; display: flex; flex-direction: row; gap: 32px; padding: 28px 28px 18px 28px; align-items: stretch; background: #fff; border: 2px solid #1976d2; box-shadow: 0 4px 18px rgba(25,118,210,0.10); border-radius: 18px; overflow: hidden; min-height: 320px;">
                        <div style="display: flex; flex-direction: row; width: 100%; gap: 32px; flex-wrap: wrap; height: 100%; min-height: 320px;">
                            <!-- Columna izquierda: calculadora -->
                            <div style="flex: 2 1 340px; min-width: 260px; display: flex; flex-direction: column; max-width: 100%;">
                                <form id="ant-expenses-form" style="margin-bottom: 10px; background: #e3f2fd; padding: 12px 10px 6px 10px; border-radius: 10px; border: 1.5px solid #1976d2; box-shadow: 0 2px 8px rgba(25,118,210,0.04); z-index: 1; align-self: center; width: 100%; max-width: 520px;">
                                    <div style="display: flex; gap: 10px; flex-wrap: wrap; align-items: flex-end;">
                                        <div style="flex: 1; min-width: 120px;">
                                            <label for="gasto-nombre" style="font-size: 0.95em; color: #1976d2; font-weight: 500;">Gasto</label>
                                            <input type="text" id="gasto-nombre" placeholder="Ej: Café" style="width: 100%; padding: 6px; border-radius: 6px; border: 1.5px solid #1976d2; background: #fff; color: #263238;">
                                        </div>
                                        <div style="flex: 1; min-width: 100px;">
                                            <label for="gasto-costo" style="font-size: 0.95em; color: #1976d2; font-weight: 500;">Costo&nbsp;($)</label>
                                            <input type="number" id="gasto-costo" min="0" step="0.01" placeholder="Ej: 2" style="width: 100%; padding: 6px; border-radius: 6px; border: 1.5px solid #1976d2; background: #fff; color: #263238;">
                                        </div>
                                        <div style="flex: 1; min-width: 100px;">
                                            <label for="gasto-frecuencia" style="font-size: 0.95em; color: #1976d2; font-weight: 500;">Veces</label>
                                            <input type="number" id="gasto-frecuencia" min="1" step="1" value="1" style="width: 100%; padding: 6px; border-radius: 6px; border: 1.5px solid #1976d2; background: #fff; color: #263238;">
                                        </div>
                                        <div style="flex: 1; min-width: 120px;">
                                            <label for="gasto-periodo" style="font-size: 0.95em; color: #1976d2; font-weight: 500;">Periodo</label>
                                            <select id="gasto-periodo" style="width: 100%; padding: 6px; border-radius: 6px; border: 1.5px solid #1976d2; background: #fff; color: #263238;">
                                                <option value="diario" selected>Diario</option>
                                                <option value="semanal">Semanal</option>
                                                <option value="mensual">Mensual</option>
                                                <option value="anual">Anual</option>
                                            </select>
                                        </div>
                                        <button type="submit" style="background: #1976d2; color: white; border: none; border-radius: 6px; padding: 8px 18px; font-size: 1em; cursor: pointer; font-weight: bold; box-shadow: 0 2px 6px rgba(25,118,210,0.08);">Agregar</button>
                                    </div>
                                </form>
                                <div style="max-height: 220px; overflow-y: auto; margin-bottom: 10px; z-index: 1;">
                                    <table id="ant-expenses-table" style="width: 100%; font-size: 1em; border-collapse: separate; border-spacing: 0; background: #fff; border-radius: 10px; box-shadow: 0 1px 4px rgba(25,118,210,0.04); margin: 0 auto;">
                                        <thead>
                                            <tr style="background: #1976d2; color: #fff;">
                                                <th style="padding: 6px; border-radius: 8px 0 0 8px;">Gasto</th>
                                                <th style="padding: 6px;">Costo&nbsp;($)</th>
                                                <th style="padding: 6px;">Veces</th>
                                                <th style="padding: 6px;">Periodo</th>
                                                <th style="padding: 6px;">Total</th>
                                                <th style="padding: 6px; border-radius: 0 8px 8px 0;">Quitar</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <div class="ant-total" role="region" aria-live="polite" aria-atomic="true" style="margin-bottom: 8px; font-size: 1.1em; background: #1976d2; color: #fff; font-weight: bold; border-radius: 8px; padding: 10px 18px; box-shadow: 0 1px 4px rgba(25,118,210,0.10); width: fit-content; align-self: center;">
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <span>Total Gastos Hormiga:</span>
                                        <span id="ant-expenses-total" aria-live="polite">$0.00</span>
                                        <select id="ant-period-select" style="margin-left: 8px; background: #fff; color: #1976d2; border: 1.5px solid #1976d2; border-radius: 6px; padding: 2px 8px; font-size: 1em; font-weight: 500; cursor: pointer;">
                                            <option value="diario">Diario</option>
                                            <option value="semanal">Semanal</option>
                                            <option value="mensual" selected>Mensual</option>
                                            <option value="anual">Anual</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="fragment" style="color: #1976d2; font-size: 1em; font-weight: 500; z-index: 1;">Experimenta agregando tus propios gastos y descubre el impacto real de los pequeños hábitos.</p>
                            </div>
                            <!-- Columna derecha: pie chart -->
                            <div style="flex: 1.2 1 220px; min-width: 220px; display: flex; align-items: center; justify-content: center; max-width: 100%;">
                                <div style="width: 100%; max-width: 540px; min-width: 320px; background: #e3f2fd; border-radius: 12px; box-shadow: 0 1px 4px rgba(25,118,210,0.06); padding: 12px; z-index: 1; display: flex; align-items: stretch; justify-content: center; height: 100%;">
                                    <canvas id="ant-expenses-pie" aria-label="Resumen de Gastos Hormiga" role="img" style="display: block; margin: 0; height: 100% !important; width: 100% !important; padding: 0; border: none; background: transparent;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Slide 4: Regla 50/30/20 -->
                <section class="slide-box" style="padding: 40px !important; display: flex; flex-direction: column;">
                    <div class="roadmap-item" style="flex-grow: 1; display: flex; flex-direction: row !important; padding: 20px; align-items: center;">
                        <div style="width: 50%; padding-right: 20px; text-align: left;">
                            <h3>La Regla 50/30/20 Evolucionada</h3>
                            <div class="calculator">
                            </div>
                            <p class="fragment">Asigna 50% a necesidades, 30% a deseos, y 20% a ahorro e inversión. Adaptamos la regla para incluir un % a Cripto.</p>
                        </div>
                        <div style="width: 50%; height: 100%; position: relative;">
                            <img src="{{ asset('finance/images/regla.png') }}" alt="Regla 50/30/20" style="width: 100%; height: 100%; object-fit: contain; border-radius: 15px; opacity: 1;">
                        </div>
                    </div>
                </section>
            </section>

            <section>
                <!-- Slide 1: Main -->
                <section class="slide-box" style="padding: 40px !important; display: flex; flex-direction: column;">
                    <div class="section-header">
                        <h2 style="color: #001f3f;">3. El Motor: La Inversión Inteligente</h2>
                        <p>Por Alejandro Jiménez</p>
                    </div>
                    <div class="roadmap-item" style="flex-grow: 1; display: flex; flex-direction: row !important; padding: 20px; align-items: center;">
                        <div style="width: 50%; padding-right: 20px; text-align: left;">
                            <div style="width: 50%; padding-right: 20px; text-align: left;">
                            <p>El ahorro te protege, la inversión te hace crecer.</p>
                            <p class="fragment" style="margin-top: 30px; font-size: 1.1em; color: #1976d2; font-weight: bold;">¡Nueva pregunta en tu teléfono! </p>
                        </div>
                        <p style="margin-top: 20px; font-size: 1.1em; color: #333333;">¡Participa en la encuesta de Aventura Financiera!</p>
                                <button onclick="window.open('https://www.menti.com/alp4sbiewdw9', '_blank');" style="background: #1976d2; color: white; border: none; padding: 10px 20px; border-radius: 50px; font-size: 1em; cursor: pointer; display: inline-flex; align-items: center; margin-top: 10px; text-decoration: none; font-weight: bold; transition: all 0.3s ease;">
                                    Ir a la Encuesta <i class="fas fa-poll" style="margin-left: 8px;"></i>
                                </button>
                        </div>
                        <div style="width: 50%; height: 100%; position: relative;">
                            <img src="{{ asset('finance/images/motor.png') }}" alt="Inversión Inteligente" style="width: 100%; height: 100%; object-fit: contain; border-radius: 15px; opacity: 1;">
                        </div>
                    </div>
                </section>

                <!-- Slide 2: Interes Compuesto - Cita -->
                <!-- Slide 2: Interes Compuesto - Cita -->
                <section class="slide-box" style="background-image: url('{{ asset('finance/images/compuesto.png') }}'); background-size: cover; background-position: center;">
                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(0, 0, 0, 0.7); padding: 40px; border-radius: 15px; color: white; max-width: 80%; min-width: 75%; min-height: 60vh; overflow: hidden;">
                        <h3 style="font-size: 2.5em; font-weight: bold; text-shadow: 2px 2px 4px #000000; text-align: left; position: relative; z-index: 2; margin-top: 40px;">"La fuerza más poderosa del universo es el interés compuesto."</h3>

                        <img src="{{ asset('finance/images/Albert-Einstein.jpg') }}" alt="Albert Einstein" style="position: absolute; bottom: 30px; right: 20px; width: 300px; border-radius: 15px; opacity: 1; z-index: 1; filter: drop-shadow(0 0 10px rgba(255,255,255,0.5));">

                        <p style="position: absolute; bottom: 45px; left: 40%; transform: translateX(-50%); z-index: 2; font-size: 1.5em; font-style: italic; text-shadow: 1px 1px 3px #000; white-space: nowrap;">- Atribuida a Albert Einstein</p>
                    </div>
                </section>

                <!-- Slide 3: Interes Compuesto - Calculadora -->
                <section class="slide-box" style="padding: 40px !important; display: flex; flex-direction: column;">
                    <div class="roadmap-item" style="position: relative; flex-grow: 1; height: 100%; display: flex; flex-direction: column; padding: 28px 28px 18px 28px; align-items: stretch; background: #fff; border: 2px solid #1976d2; box-shadow: 0 4px 18px rgba(25,118,210,0.10); border-radius: 18px; overflow: hidden;">
                        <!-- Top section: Title, Inputs, Final Capital -->
                        <div style="flex: 1; display: flex; flex-direction: row; justify-content: space-between; align-items: stretch; width: 100%; margin-bottom: 20px; gap: 20px;">
                            <!-- Top-Left: Title -->
                            <div class="ci-card" style="flex: 1; text-align: left; border: 1.5px solid #333333;">
                                <h2 style="margin: 0 0 5px 0; color: #1976d2; font-size: 1.3em; font-weight: bold; letter-spacing: 0.5px;">Calculadora de Interés Compuesto</h2>
                                <p style="margin: 0; color: #333333; font-size: 0.9em;">Visualiza el poder del interés compuesto en tus inversiones.</p>
                            </div>

                            <!-- Middle: Input Fields -->
                            <div class="compound-interest-simulator ci-card" role="form" aria-labelledby="interes-compuesto-heading" style="flex: 1; background: #e3f2fd; border-radius: 10px; border: 1.5px solid #1976d2; z-index: 1; width: 100%; max-width: 300px;">
                                <div style="display: flex; flex-direction: column; gap: 10px; width: 100%;">
                                    <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                                        <label for="ci-capital" style="font-size: 0.85em; color: #333333; font-weight: 500; white-space: nowrap; margin-right: 10px;">Capital Inicial ($)</label>
                                        <input type="number" id="ci-capital" value="12000" style="width: 100px; padding: 4px; border-radius: 6px; border: 1.5px solid #1976d2; background: #fff; color: #333333; text-align: right;">
                                    </div>
                                    <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                                        <label for="ci-aportacion" style="font-size: 0.85em; color: #333333; font-weight: 500; white-space: nowrap; margin-right: 10px;">Aportación Anual ($)</label>
                                        <input type="number" id="ci-aportacion" value="0" style="width: 100px; padding: 4px; border-radius: 6px; border: 1.5px solid #1976d2; background: #fff; color: #333333; text-align: right;">
                                    </div>
                                    <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                                        <label for="ci-interes" style="font-size: 0.85em; color: #333333; font-weight: 500; white-space: nowrap; margin-right: 10px;">Interés Anual (%)</label>
                                        <input type="number" id="ci-interes" value="10" style="width: 100px; padding: 4px; border-radius: 6px; border: 1.5px solid #1976d2; background: #fff; color: #333333; text-align: right;">
                                    </div>
                                    <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                                        <label for="ci-anos" style="font-size: 0.85em; color: #333333; font-weight: 500; white-space: nowrap; margin-right: 10px;">Años</label>
                                        <input type="number" id="ci-anos" value="20" style="width: 100px; padding: 4px; border-radius: 6px; border: 1.5px solid #1976d2; background: #fff; color: #333333; text-align: right;">
                                    </div>
                                </div>
                            </div>

                            <!-- Top-Right: Capital Final -->
                            <div class="resultado-final-impact ci-card" style="flex: 1; color: #1976d2; font-weight: bold; text-align: right; font-size: 1.2em; line-height: 1.2; text-shadow: 2px 2px 4px rgba(0,0,0,0.2); border: 1.5px solid #333333;">
                                <h3 style="font-size: 0.9em;">Capital Final: <span id="ci-resultado-final" style="color: #4CAF50; font-size: 0.9em; display: block; margin-top: 5px;"></span></h3>
                                <h3 style="font-size: 0.9em; margin-top: 10px;">Total de Aportaciones: <span id="ci-total-aportaciones" style="color: #333333; font-size: 0.9em; display: block; margin-top: 5px;"></span></h3>
                            </div>
                        </div>

                        <!-- Bottom section: Graph -->
                        <div class="ci-card" style="flex: 3; display: flex; align-items: center; justify-content: center; width: 100%; background: #e3f2fd; border-radius: 12px; padding: 12px; z-index: 1; height: 100%; max-height: 75%; border: 1.5px solid #333333;">
                            <canvas id="newCompoundInterestChart" role="img" aria-label="Gráfico de crecimiento de la inversión a lo largo del tiempo" style="display: block; margin: 0; height: 100% !important; width: 100% !important; padding: 0; border: none; background: transparent;"></canvas>
                        </div>
                </section>

                <!-- Slide 3: Vehiculos de Inversion -->
                <section class="slide-box" style="padding: 40px !important; display: flex; flex-direction: column;">
                    <div class="roadmap-item" style="flex-grow: 1; display: flex; flex-direction: row !important; padding: 20px; align-items: center;">
                        <div style="width: 50%; padding-right: 20px; text-align: left;">
                            <h3>Vehículos de Inversión: Diversifica tu Portafolio</h3>
                            <p>No pongas todos los huevos en la misma canasta. Considera una mezcla de activos para equilibrar riesgo y retorno.</p>
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin: 30px 0;">
                            </div>
                        </div>
                        <div style="width: 50%; height: 100%; position: relative;">
                            <img src="{{ asset('finance/images/inversiones.png') }}" alt="Vehículos de Inversión" style="width: 100%; height: 100%; object-fit: contain; border-radius: 15px; opacity: 1;">
                        </div>
                    </div>
                </section>

                <!-- Slide 4: ETFs -->
                <section class="slide-box" style="padding: 40px !important; display: flex; flex-direction: column;">
                    <div class="roadmap-item" style="flex-grow: 1; display: flex; flex-direction: row !important; padding: 20px; align-items: center;">
                        <div style="width: 50%; padding-right: 20px; text-align: left;">
                            <h3>Fondos Indexados (ETFs): La Vía Simple y Eficaz</h3>
                            <p>Un ETF es como comprar una canasta completa del supermercado en lugar de cada producto por separado. </p>

                            <p class="fragment">El S&P 500, que sigue a las 500 empresas más grandes de EE.UU., es un ejemplo popular con un rendimiento histórico promedio del 10% anual. </p>
                        </div>
                        <div style="width: 50%; height: 100%; position: relative;">
                            <img src="{{ asset('finance/images/fondos.png') }}" alt="Fondos Indexados" style="width: 100%; height: 100%; object-fit: contain; border-radius: 15px; opacity: 1;">
                        </div>
                    </div>
                </section>
            </section>

            <section>
                <!-- Slide 1: Main -->
                <section class="slide-box" style="padding: 40px !important; display: flex; flex-direction: column;">
                    <div class="section-header">
                        <h2 style="color: #001f3f;">4. La Protección: Tu Red de Seguridad</h2>
                        <p>Por Alejandro Jiménez</p>
                    </div>
                    <div class="roadmap-item" style="flex-grow: 1; display: flex; flex-direction: row !important; padding: 20px; align-items: center;">
                        <div style="width: 50%; padding-right: 20px; text-align: left;">
                            <p>Construir riqueza es importante, pero protegerla es fundamental.</p>
                        </div>
                        <div style="width: 50%; height: 100%; position: relative;">
                            <img src="{{ asset('finance/images/proteccion.png') }}" alt="Red de Seguridad" style="width: 100%; height: 100%; object-fit: contain; border-radius: 15px; opacity: 1;">
                        </div>
                    </div>
                </section>

                <!-- Slide 2: Riesgos -->
                <section class="slide-box" style="padding: 40px !important; display: flex; flex-direction: column;">
                    <div class="roadmap-item" style="flex-grow: 1; display: flex; flex-direction: row !important; padding: 20px; align-items: center;">
                        <div style="width: 50%; padding-right: 20px; text-align: left;">
                            <h3>Conoce los Riesgos para Poder Mitigarlos </h3>
                            <div style="display: flex; justify-content: space-around; text-align: center; margin-top: 40px;">
                                <div>
                                    <i class="fas fa-chart-area fa-3x" style="color: var(--primary-color);"></i>
                                    <h4>Riesgo de Mercado</h4>
                                    <p>Pérdida de valor de las inversiones. </p>
                                </div>
                                <div>
                                    <i class="fas fa-hourglass-half fa-3x" style="color: var(--primary-color);"></i>
                                    <h4>Riesgo de Liquidez</h4>
                                    <p>Dificultad para convertir un activo en efectivo. </p>
                                </div>
                                <div>
                                    <i class="fas fa-thermometer-three-quarters fa-3x" style="color: var(--primary-color);"></i>
                                    <h4>Riesgo de Inflación</h4>
                                    <p>Tu dinero pierde poder adquisitivo con el tiempo. </p>
                                </div>
                            </div>
                            <p class="fragment" style="margin-top: 40px;">La respuesta a estos riesgos es una estrategia de protección por capas.</p>
                        </div>
                        <div style="width: 50%; height: 100%; position: relative;">
                            <img src="{{ asset('finance/images/riesgos.png') }}" alt="Riesgos Financieros" style="width: 100%; height: 100%; object-fit: contain; border-radius: 15px; opacity: 1;">
                        </div>
                    </div>
                </section>

                <!-- Slide 3: Anillos de Seguridad -->
                <section class="slide-box" style="padding: 40px !important; display: flex; flex-direction: column;">
                    <div class="roadmap-item" style="flex-grow: 1; display: flex; flex-direction: row !important; padding: 20px; align-items: center;">
                        <div style="width: 50%; padding-right: 20px; text-align: left;">
                            <h3>Los Anillos de Seguridad Financiera </h3>
                            <div class="security-rings">
                            </div>
                            <p class="fragment">Cada anillo te protege de un tipo de imprevisto, desde lo más urgente a la planificación a largo plazo. </p>
                        </div>
                        <div style="width: 50%; height: 100%; position: relative;">
                            <img src="{{ asset('finance/images/seguridad.png') }}" alt="Anillos de Seguridad" style="width: 100%; height: 100%; object-fit: contain; border-radius: 15px; opacity: 1;">
                        </div>
                    </div>
                </section>
            </section>

            <section>
                <!-- Slide 1: Main -->
                <section class="slide-box" style="padding: 40px !important; display: flex; flex-direction: column;">
                    <div class="section-header">
                        <h2 style="color: #001f3f;">5. El Futuro Digital: Crypto Essentials</h2>
                        <p>Por Héctor Mota Zorrilla</p>
                    </div>
                    <div class="roadmap-item" style="flex-grow: 1; display: flex; flex-direction: row !important; padding: 20px; align-items: center;">
                        <div style="width: 50%; padding-right: 20px; text-align: left;">
                            <div class="image-placeholder medium-placeholder" style="background: rgba(255,255,255,0.1);"></div>
                            <p style="margin-top: 20px; font-size: 1.1em; color: #333333;">revisa tu teléfono y responde la encuesta</p>
                                <button onclick="window.open('https://www.menti.com/alp4sbiewdw9', '_blank');" style="background: #1976d2; color: white; border: none; padding: 10px 20px; border-radius: 50px; font-size: 1em; cursor: pointer; display: inline-flex; align-items: center; margin-top: 10px; text-decoration: none; font-weight: bold; transition: all 0.3s ease;">
                                    Ir a la Encuesta <i class="fas fa-poll" style="margin-left: 8px;"></i>
                                </button>
                        </div>
                        <div style="width: 50%; height: 100%; position: relative;">
                            <img src="{{ asset('finance/images/cripto.png') }}" alt="Crypto Essentials" style="width: 100%; height: 100%; object-fit: contain; border-radius: 15px; opacity: 1;">
                        </div>
                    </div>
                </section>

                <!-- Slide 2: Blockchain -->
                <section class="slide-box" style="padding: 40px !important; display: flex; flex-direction: column;">
                    <div class="roadmap-item" style="flex-grow: 1; display: flex; flex-direction: row !important; padding: 20px; align-items: center;">
                        <div style="width: 50%; padding-right: 20px; text-align: left;">
                            <h3>Blockchain en 5 Minutos</h3>
                        </div>
                        <div style="width: 50%; height: 100%; position: relative;">
                            <img src="{{ asset('finance/images/blockchain.png') }}" alt="Blockchain" style="width: 100%; height: 100%; object-fit: contain; border-radius: 15px; opacity: 1;">
                        </div>
                    </div>
                </section>

                <!-- Slide 3: Compra y Custodia -->
                <section class="slide-box" style="padding: 40px !important; display: flex; flex-direction: column;">
                    <div class="roadmap-item" style="flex-grow: 1; display: flex; flex-direction: row !important; padding: 20px; align-items: center;">
                        <div style="width: 50%; padding-right: 20px; text-align: left;">
                            <h3>Compra y Custodia Segura</h3>
                        </div>
                        <div style="width: 50%; height: 100%; position: relative;">
                            <img src="{{ asset('finance/images/compra.png') }}" alt="Compra y Custodia" style="width: 100%; height: 100%; object-fit: contain; border-radius: 15px; opacity: 1;">
                        </div>
                    </div>
                </section>

                <!-- Slide 4: Riesgos y Proteccion -->
                <section class="slide-box" style="padding: 40px !important; display: flex; flex-direction: column;">
                    <div class="roadmap-item" style="flex-grow: 1; display: flex; flex-direction: row !important; padding: 20px; align-items: center;">
                        <div style="width: 50%; padding-right: 20px; text-align: left;">
                            <h3>Riesgos y Protección</h3>
                        </div>
                        <div style="width: 50%; height: 100%; position: relative;">
                            <img src="{{ asset('finance/images/riesgos.png') }}" alt="Riesgos de Criptomonedas" style="width: 100%; height: 100%; object-fit: contain; border-radius: 15px; opacity: 1;">
                        </div>
                    </div>
                </section>

                <!-- Slide 5: Precios en vivo -->
                <section class="slide-box" style="padding: 40px !important; display: flex; flex-direction: column;">
                    <div class="section-header" style="margin-bottom: 8px; margin-top: 0; padding-top: 0;">
                        <h2 style="color: #001f3f; margin-bottom: 8px; margin-top: 0; padding-top: 0;">Precios de Criptomonedas en Vivo</h2>
                    </div>

                    <div style="flex-grow: 1; display: flex; flex-direction: column; gap: 10px; max-width: 75%; margin: 0 auto; width: 100%;">
                        <!-- Card 1: Bitcoin -->
                        <div class="roadmap-item" style="display: flex; flex-direction: row !important; padding: 10px 4px; align-items: center; flex-grow: 1; min-height: 140px;">
                            <div style="width: 40%; display: flex; align-items: center;">
                                <img src="https://assets.coingecko.com/coins/images/1/large/bitcoin.png" alt="Bitcoin" style="width: 50px; height: 50px; margin-right: 20px;">
                                <div style="display: flex; flex-direction: column; align-items: flex-start;">
                                    <strong style="font-size: 1.2em;">Bitcoin (BTC)</strong>
                                    <div>
                                        <span id="btc-price" style="font-size: 1.1em; font-weight: bold;">$0.00</span>
                                        <span id="btc-change" class="crypto-change" style="margin-left: 10px;">0.00%</span>
                                        <span id="btc-arrow" style="font-size: 1.2em; margin-left: 6px;"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="crypto-sparkline" style="width: 60%; min-width: 260px; height: 140px; display: flex; align-items: center; justify-content: center; margin: 0; padding: 0;">
                                <svg id="btc-sparkline" width="100%" height="140" viewBox="0 0 240 120" style="background: #f5f5f5; border-radius: 10px; width: 100%; height: 140px;">
                                    <g id="btc-sparkline-axes">
                                        <line x1="40" y1="20" x2="40" y2="110" stroke="#bbb" stroke-width="1" /> <!-- Y axis -->
                                        <line x1="40" y1="110" x2="230" y2="110" stroke="#bbb" stroke-width="1" /> <!-- X axis -->
                                        <text x="38" y="32" font-size="12" fill="#888" id="btc-ymax" text-anchor="end" alignment-baseline="middle">---</text>
                                        <text x="38" y="108" font-size="12" fill="#888" id="btc-ymin" text-anchor="end" alignment-baseline="middle">---</text>
                                    </g>
                                    <polyline id="btc-sparkline-poly" fill="none" stroke="#1976d2" stroke-width="2.5" points="" />
                                </svg>
                            </div>
                            <div class="crypto-legend" id="btc-legend" style="margin-left: 12px; font-size: 0.95em; color: #1976d2; min-width: 120px; white-space: pre-line;"></div>
                        </div>

                        <!-- Card 2: Ethereum -->
                        <div class="roadmap-item" style="display: flex; flex-direction: row !important; padding: 10px 4px; align-items: center; flex-grow: 1; min-height: 140px;">
                            <div style="width: 40%; display: flex; align-items: center;">
                                <img src="https://assets.coingecko.com/coins/images/279/large/ethereum.png" alt="Ethereum" style="width: 50px; height: 50px; margin-right: 20px;">
                                <div style="display: flex; flex-direction: column; align-items: flex-start;">
                                    <strong style="font-size: 1.2em;">Ethereum (ETH)</strong>
                                    <div>
                                        <span id="eth-price" style="font-size: 1.1em; font-weight: bold;">$0.00</span>
                                        <span id="eth-change" class="crypto-change" style="margin-left: 10px;">0.00%</span>
                                        <span id="eth-arrow" style="font-size: 1.2em; margin-left: 6px;"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="crypto-sparkline" style="width: 60%; min-width: 260px; height: 140px; display: flex; align-items: center; justify-content: center; margin: 0; padding: 0;">
                                <svg id="eth-sparkline" width="100%" height="140" viewBox="0 0 240 120" style="background: #f5f5f5; border-radius: 10px; width: 100%; height: 140px;">
                                    <g id="eth-sparkline-axes">
                                        <line x1="40" y1="20" x2="40" y2="110" stroke="#bbb" stroke-width="1" />
                                        <line x1="40" y1="110" x2="230" y2="110" stroke="#bbb" stroke-width="1" />
                                        <text x="38" y="32" font-size="12" fill="#888" id="eth-ymax" text-anchor="end" alignment-baseline="middle">---</text>
                                        <text x="38" y="108" font-size="12" fill="#888" id="eth-ymin" text-anchor="end" alignment-baseline="middle">---</text>
                                    </g>
                                    <polyline id="eth-sparkline-poly" fill="none" stroke="#1976d2" stroke-width="2.5" points="" />
                                </svg>
                            </div>
                            <div class="crypto-legend" id="eth-legend" style="margin-left: 12px; font-size: 0.95em; color: #1976d2; min-width: 120px; white-space: pre-line;"></div>
                        </div>

                        <!-- Card 3: Tether -->
                        <div class="roadmap-item" style="display: flex; flex-direction: row !important; padding: 10px 4px; align-items: center; flex-grow: 1; min-height: 140px;">
                            <div style="width: 40%; display: flex; align-items: center;">
                                <img src="https://assets.coingecko.com/coins/images/325/large/Tether.png" alt="Tether" style="width: 50px; height: 50px; margin-right: 20px;">
                                <div style="display: flex; flex-direction: column; align-items: flex-start;">
                                    <strong style="font-size: 1.2em;">Tether (USDT)</strong>
                                    <div>
                                        <span id="usdt-price" style="font-size: 1.1em; font-weight: bold;">$0.00</span>
                                        <span id="usdt-change" class="crypto-change" style="margin-left: 10px;">0.00%</span>
                                        <span id="usdt-arrow" style="font-size: 1.2em; margin-left: 6px;"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="crypto-sparkline" style="width: 60%; min-width: 260px; height: 140px; display: flex; align-items: center; justify-content: center; margin: 0; padding: 0;">
                                <svg id="usdt-sparkline" width="100%" height="140" viewBox="0 0 240 120" style="background: #f5f5f5; border-radius: 10px; width: 100%; height: 140px;">
                                    <g id="usdt-sparkline-axes">
                                        <line x1="40" y1="20" x2="40" y2="110" stroke="#bbb" stroke-width="1" />
                                        <line x1="40" y1="110" x2="230" y2="110" stroke="#bbb" stroke-width="1" />
                                        <text x="38" y="32" font-size="12" fill="#888" id="usdt-ymax" text-anchor="end" alignment-baseline="middle">---</text>
                                        <text x="38" y="108" font-size="12" fill="#888" id="usdt-ymin" text-anchor="end" alignment-baseline="middle">---</text>
                                    </g>
                                    <polyline id="usdt-sparkline-poly" fill="none" stroke="#1976d2" stroke-width="2.5" points="" />
                                </svg>
                            </div>
                            <div class="crypto-legend" id="usdt-legend" style="margin-left: 12px; font-size: 0.95em; color: #1976d2; min-width: 120px; white-space: pre-line;"></div>
                        </div>
                    </div>
                    <p style="font-size: 0.8em; opacity: 0.7; text-align: right; padding: 0 40px;">Datos proporcionados por CoinGecko</p>
                    </section>
            </section>

            <section>
                <section class="slide-box" style="padding: 40px !important; display: flex; flex-direction: column;">
                    <div class="section-header">
                        <h2 style="color: #001f3f;">6. Tu Plan de Acción</h2>
                    </div>
                    <div class="roadmap-item" style="flex-grow: 1; display: flex; flex-direction: row !important; padding: 20px; align-items: center;">
                        <div style="width: 50%; padding-right: 20px; text-align: left;">
                            <p>La teoría está muy bien, pero el éxito está en la práctica. Aquí tienes los pasos para empezar.</p>
                        </div>
                        <div style="width: 50%; height: 100%; position: relative;">
                            <img src="{{ asset('finance/images/plan.png') }}" alt="Plan de Acción" style="width: 100%; height: 100%; object-fit: contain; border-radius: 15px; opacity: 1;">
                        </div>
                    </div>
                </section>

                <!-- Slide 2: Plan Personalizado -->
                <section class="slide-box" style="padding: 40px !important; display: flex; flex-direction: column;">
                    <div class="roadmap-item" style="flex-grow: 1; display: flex; flex-direction: row !important; padding: 20px; align-items: center;">
                        <div class="footer-cta" style="width: 100%; text-align: center;">
                            <h2 style="color: black;">¡Empieza Hoy Mismo!</h2>
                            <p>Tu futuro financiero comienza con el primer paso. </p>
                            <p style="margin-top: 20px; font-size: 1.1em; color: #333333;">Haz el quiz final y gana un premio</p>
                            <button onclick="window.open('https://www.menti.com/alp4sbiewdw9', '_blank');" style="background: #1976d2; color: white; border: none; padding: 10px 20px; border-radius: 50px; font-size: 1em; cursor: pointer; display: inline-flex; align-items: center; margin-top: 10px; text-decoration: none; font-weight: bold; transition: all 0.3s ease;">
                                Ir al Quiz <i class="fas fa-trophy" style="margin-left: 8px;"></i>
                            </button>
                        </div>
                    </div>
                </section>

                
            </section>

            

            

            

            <section>
                <section class="slide-box farewell-content">
                    <h2>¡Gracias por asistir!</h2>
                    <p>Esperamos que hayas disfrutado la presentación y que te sea de gran utilidad.</p>

                    <div class="social-links-container">
                        <div style="display: flex; flex-direction: column; align-items: center;">
                            <h3>Alejandro Jiménez</h3>
                            <div style="display: flex; gap: 15px;">
                                <a href="https://x.com/finanzasconale" target="_blank"><i class="bx bxl-twitter"></i></a>
                                <a href="https://www.linkedin.com/in/alejandro-jimenez-finanzas/" target="_blank"><i class="bx bxl-linkedin"></i></a>
                            </div>
                        </div>
                        <div style="display: flex; flex-direction: column; align-items: center;">
                            <h3>Héctor Mota Zorrilla</h3>
                            <div style="display: flex; gap: 15px;">
                                <a href="https://x.com/MotaZorrilla" target="_blank"><i class="bx bxl-twitter"></i></a>
                                <a href="https://www.linkedin.com/in/motazorrilla/" target="_blank"><i class="bx bxl-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                    <p style="font-size: 1em; margin-top: 20px; margin-bottom: 10px;">
                        Para descargar esta presentación en formato PDF:
                    </p>
                    <ol style="font-size: 0.95em; text-align: left; margin-bottom: 20px;">
                        <li>Haz clic en el botón "Descargar Presentación (PDF)".</li>
                        <li>En la nueva ventana, usa la función de "Imprimir" de tu navegador (Ctrl+P o Cmd+P).</li>
                        <li>Selecciona "Guardar como PDF" como destino y haz clic en "Guardar".</li>
                    </ol>
                    <button onclick="window.open(window.location.href + '?print-pdf', '_blank');" class="download-button">
                        Descargar Presentación (PDF) <span><i class='bx bxs-file-pdf'></i></span>
                    </button>
                    <p class="website-link">También puedes descargar el PDF desde mi <a href="https://motazorrilla.com/#financial-analysis" target="_blank">sitio web</a>.</p>
                </section>
            </section>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/reveal.js/4.6.1/reveal.min.js"></script>
    <script src="{{ asset('js/presentation.js') }}"></script>
    <script>
        // --- Gastos Hormiga Calculator Mejorado + Pie Chart + Selector de periodo ---
        (function() {
            const form = document.getElementById('ant-expenses-form');
            const tableBody = document.querySelector('#ant-expenses-table tbody');
            const totalSpan = document.getElementById('ant-expenses-total');
            const pieCanvas = document.getElementById('ant-expenses-pie');
            const periodSelect = document.getElementById('ant-period-select');
            let gastos = [{
                    nombre: 'Café',
                    costo: 2.5,
                    frecuencia: 1,
                    periodo: 'diario'
                },
                {
                    nombre: 'Cigarrillos',
                    costo: 5,
                    frecuencia: 1,
                    periodo: 'diario'
                },
                {
                    nombre: 'Snacks',
                    costo: 1.2,
                    frecuencia: 2,
                    periodo: 'diario'
                },
                {
                    nombre: 'Uber',
                    costo: 4,
                    frecuencia: 1,
                    periodo: 'semanal'
                }
            ];
            let periodoActual = periodSelect ? periodSelect.value : 'mensual';
            let pieChart = null;

            function calcularTotal(gasto, periodo) {
                let dias = 1;
                if (periodo === 'semanal') dias = 7;
                if (periodo === 'mensual') dias = 30.44;
                if (periodo === 'anual') dias = 365;
                let gastoDias = 1;
                if (gasto.periodo === 'semanal') gastoDias = 7;
                else if (gasto.periodo === 'mensual') gastoDias = 30.44;
                else if (gasto.periodo === 'anual') gastoDias = 365;
                else gastoDias = 1;
                let total = 0;
                if (gasto.periodo === 'diario') {
                    total = gasto.costo * gasto.frecuencia * dias;
                } else {
                    total = (gasto.costo * gasto.frecuencia) * (dias / gastoDias);
                }
                return total;
            }

            function renderTabla() {
                tableBody.innerHTML = '';
                let total = 0;
                const labels = [];
                const data = [];
                const colors = [
                    '#1976d2', '#43a047', '#fbc02d', '#e53935', '#8e24aa', '#00bcd4', '#fb8c00', '#cddc39', '#6d4c41', '#0288d1'
                ];
                gastos.forEach((gasto, idx) => {
                    const row = document.createElement('tr');
                    const totalGasto = calcularTotal(gasto, periodoActual);
                    total += totalGasto;
                    row.innerHTML = `
                    <td style="padding: 6px;">${gasto.nombre}</td>
                    <td style="padding: 6px;">$${gasto.costo.toFixed(2)}</td>
                    <td style="padding: 6px;">${gasto.frecuencia}</td>
                    <td style="padding: 6px;">${gasto.periodo.charAt(0).toUpperCase() + gasto.periodo.slice(1)}</td>
                    <td style="padding: 6px;">$${totalGasto.toFixed(2)}</td>
                    <td style="padding: 6px;"><button type="button" data-idx="${idx}" style="color: #dc3545; background: none; border: none; cursor: pointer; font-size: 1.1em;">✕</button></td>
                `;
                    tableBody.appendChild(row);
                    labels.push(gasto.nombre);
                    data.push(totalGasto);
                });
                totalSpan.textContent = '$' + total.toFixed(2);
                renderPie(labels, data, colors);
            }

            function renderPie(labels, data, colors) {
                if (!pieCanvas) return;
                if (pieChart) pieChart.destroy();
                // Si no hay datos, no mostrar nada
                if (!data.length || data.reduce((a, b) => a + b, 0) === 0) {
                    pieChart = null;
                    pieCanvas.getContext('2d').clearRect(0, 0, pieCanvas.width, pieCanvas.height);
                    return;
                }
                pieChart = new Chart(pieCanvas, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: colors,
                            borderColor: '#fff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: true,
                                position: 'bottom',
                                labels: {
                                    color: '#263238',
                                    font: {
                                        size: 14
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let label = context.label || '';
                                        let value = context.parsed || 0;
                                        return `${label}: $${value.toFixed(2)}`;
                                    }
                                }
                            }
                        }
                    }
                });
            }

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const nombre = document.getElementById('gasto-nombre').value.trim() || 'Gasto';
                const costo = parseFloat(document.getElementById('gasto-costo').value);
                const frecuencia = parseInt(document.getElementById('gasto-frecuencia').value);
                let periodo = document.getElementById('gasto-periodo').value;
                if (isNaN(costo) || isNaN(frecuencia) || costo <= 0 || frecuencia <= 0) return;
                if (!['diario', 'semanal', 'mensual', 'anual'].includes(periodo)) periodo = 'diario';
                gastos.push({
                    nombre,
                    costo,
                    frecuencia,
                    periodo
                });
                form.reset();
                document.getElementById('gasto-frecuencia').value = 1;
                renderTabla();
            });

            tableBody.addEventListener('click', function(e) {
                if (e.target.tagName === 'BUTTON' && e.target.hasAttribute('data-idx')) {
                    const idx = parseInt(e.target.getAttribute('data-idx'));
                    gastos.splice(idx, 1);
                    renderTabla();
                }
            });

            if (periodSelect) {
                periodSelect.addEventListener('change', function() {
                    periodoActual = periodSelect.value;
                    renderTabla();
                });
            }

            // Render inicial con valores por defecto
            renderTabla();
        })();
        Reveal.on('ready', event => {
            document.querySelectorAll('.roadmap-item').forEach(item => {
                item.addEventListener('click', () => {
                    const slideIndex = item.getAttribute('data-slide-index');
                    if (slideIndex) {
                        Reveal.slide(parseInt(slideIndex, 10));
                    }
                });
            });
        });
    </script>
    <script>
        // --- Crypto Cards: Live Prices, Trend Arrows, and Historical Sparklines (1 año) ---
        (function() {
            const coins = [{
                    id: 'bitcoin',
                    symbol: 'btc',
                    name: 'Bitcoin',
                    color: '#f7931a'
                },
                {
                    id: 'ethereum',
                    symbol: 'eth',
                    name: 'Ethereum',
                    color: '#627eea'
                },
                {
                    id: 'tether',
                    symbol: 'usdt',
                    name: 'Tether',
                    color: '#26a17b'
                }
            ];
            const intervalMs = 60000;
            const history = {
                btc: [],
                eth: [],
                usdt: []
            };
            const historyDates = {
                btc: [],
                eth: [],
                usdt: []
            };
            // Formato precio
            function fmtPrice(val, symbol) {
                if (symbol === 'usdt') {
                    return '$' + val.toLocaleString('en-US', {
                        minimumFractionDigits: 6,
                        maximumFractionDigits: 7
                    });
                }
                if (val >= 1000) return '$' + val.toLocaleString('en-US', {
                    maximumFractionDigits: 0
                });
                return '$' + val.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 5
                });
            }
            // Dibuja sparkline con todo el histórico disponible
            function drawSparkline(symbol, data, dates) {
                const svg = document.getElementById(symbol + '-sparkline');
                const poly = document.getElementById(symbol + '-sparkline-poly');
                const ymaxT = document.getElementById(symbol + '-ymax');
                const yminT = document.getElementById(symbol + '-ymin');
                if (!svg || !poly || !data.length) return;
                // Usar todo el espacio horizontal
                const w = 190,
                    h = 90,
                    x0 = 40,
                    y0 = 20,
                    x1 = 230,
                    y1 = 110;
                const n = data.length;
                let min = Math.min(...data),
                    max = Math.max(...data);
                let range = max - min;
                // Para USDT, fuerza una escala visual más ajustada si la diferencia es muy pequeña
                if (symbol === 'usdt') {
                    // Si la diferencia es menor a 0.0005, fuerza un rango mínimo de 0.0005
                    if (range < 0.0005) {
                        const mid = (max + min) / 2;
                        min = mid - 0.00025;
                        max = mid + 0.00025;
                        range = max - min;
                    }
                } else {
                    if (range < 0.01) range = 0.01;
                }
                // Puntos de la línea
                const svgPoints = data.map((v, i) => {
                    const x = x0 + ((x1 - x0) * i / (n - 1 || 1));
                    const y = y1 - ((y1 - y0) * (v - min) / range);
                    return x + ',' + y;
                }).join(' ');
                poly.setAttribute('points', svgPoints);
                // Limpiar etiquetas previas
                Array.from(svg.querySelectorAll('.x-label, .y-label')).forEach(e => e.remove());
                // Etiquetas de precio: alineadas exactamente con el eje Y (x=38, text-anchor=end)
                if (ymaxT) ymaxT.textContent = '';
                if (yminT) yminT.textContent = '';
                const yLabelMax = document.createElementNS('http://www.w3.org/2000/svg', 'text');
                yLabelMax.setAttribute('x', 38);
                yLabelMax.setAttribute('y', y0 + 2);
                yLabelMax.setAttribute('font-size', '13');
                yLabelMax.setAttribute('fill', '#1976d2');
                yLabelMax.setAttribute('class', 'y-label');
                yLabelMax.setAttribute('text-anchor', 'end');
                yLabelMax.textContent = fmtPrice(max, symbol);
                svg.appendChild(yLabelMax);
                const yLabelMin = document.createElementNS('http://www.w3.org/2000/svg', 'text');
                yLabelMin.setAttribute('x', 38);
                yLabelMin.setAttribute('y', y1);
                yLabelMin.setAttribute('font-size', '13');
                yLabelMin.setAttribute('fill', '#1976d2');
                yLabelMin.setAttribute('class', 'y-label');
                yLabelMin.setAttribute('text-anchor', 'end');
                yLabelMin.textContent = fmtPrice(min, symbol);
                svg.appendChild(yLabelMin);
                // Leyenda de fechas
                if (dates && dates.length > 1) {
                    const legend = document.getElementById(symbol + '-legend');
                    if (legend) {
                        const start = new Date(dates[0]);
                        const end = new Date(dates[dates.length - 1]);
                        const fmt = d => d.toLocaleDateString('es-MX', {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric'
                        });
                        legend.textContent = `Datos de:\n${fmt(start)}\na:\n${fmt(end)}`;
                    }
                }
            }

            function animatePrice(el, from, to) {
                if (!el) return;
                const duration = 600;
                const start = performance.now();

                function step(now) {
                    const t = Math.min(1, (now - start) / duration);
                    const val = from + (to - from) * t;
                    el.textContent = fmtPrice(val);
                    if (t < 1) requestAnimationFrame(step);
                }
                requestAnimationFrame(step);
            }
            // Cargar histórico máximo permitido sin API key (CoinGecko: days=90)
            function fetchHistory(symbol, id) {
                // CoinGecko: /coins/{id}/market_chart?vs_currency=usd&days=90
                return fetch(`https://api.coingecko.com/api/v3/coins/${id}/market_chart?vs_currency=usd&days=90`)
                    .then(r => r.json())
                    .then(data => {
                        // data.prices: [[timestamp, price], ...]
                        history[symbol] = data.prices.map(p => p[1]);
                        historyDates[symbol] = data.prices.map(p => p[0]);
                        drawSparkline(symbol, history[symbol], historyDates[symbol]);
                    });
            }
            // Actualizar precios en vivo y animar
            function updateCryptoCards() {
                const ids = coins.map(c => c.id).join(',');
                fetch(`https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=${ids}`)
                    .then(r => r.json())
                    .then(data => {
                        data.forEach(coin => {
                            const symbol = coin.symbol.toLowerCase();
                            const price = coin.current_price;
                            const change = coin.price_change_percentage_24h;
                            const priceEl = document.getElementById(symbol + '-price');
                            const prev = priceEl && priceEl.textContent ? parseFloat(priceEl.textContent.replace(/[^\d.]/g, '')) : price;
                            animatePrice(priceEl, prev, price);
                            const changeEl = document.getElementById(symbol + '-change');
                            if (changeEl) {
                                changeEl.textContent = (change > 0 ? '+' : '') + change.toFixed(2) + '%';
                                changeEl.style.color = change > 0 ? '#43a047' : (change < 0 ? '#e53935' : '#888');
                            }
                            const arrowEl = document.getElementById(symbol + '-arrow');
                            if (arrowEl) {
                                arrowEl.textContent = change > 0 ? '▲' : (change < 0 ? '▼' : '');
                                arrowEl.style.color = change > 0 ? '#43a047' : (change < 0 ? '#e53935' : '#888');
                            }
                            // Redibujar sparkline con histórico
                            drawSparkline(symbol, history[symbol], historyDates[symbol]);
                        });
                    })
                    .catch(() => {});
            }
            // Mejorar estilos de la tabla y tarjetas
            document.addEventListener('DOMContentLoaded', function() {
                var cryptoCardsContainer = document.querySelectorAll('.slide-box h2') ?
                    Array.from(document.querySelectorAll('.slide-box h2')).find(h2 => h2.textContent.includes('Precios de Criptomonedas')) :
                    null;
                if (cryptoCardsContainer) {
                    var parent = cryptoCardsContainer.closest('.slide-box');
                    var cards = parent.querySelectorAll('.roadmap-item');
                    var wrapper = parent.querySelector('div[style*="flex-direction: column"]');
                    if (wrapper) {
                        wrapper.style.display = 'flex';
                        wrapper.style.flexDirection = 'column';
                        wrapper.style.gap = '8px';
                        wrapper.style.maxWidth = '100%';
                    }
                    cards.forEach(card => {
                        card.style.minWidth = '0';
                        card.style.maxWidth = '100%';
                        card.style.flex = 'unset';
                        card.style.margin = '0';
                        card.style.padding = '6px 1px';
                        card.style.background = '#f8fafc';
                        card.style.borderRadius = '12px';
                        card.style.boxShadow = '0 2px 8px rgba(25,118,210,0.06)';
                        card.style.border = '1.5px solid #e3eafc';
                    });
                }
                // Mejorar tabla Gastos Hormiga
                var antTable = document.getElementById('ant-expenses-table');
                if (antTable) {
                    antTable.style.background = '#f8fafc';
                    antTable.style.borderRadius = '10px';
                    antTable.style.boxShadow = '0 1px 4px rgba(25,118,210,0.04)';
                    antTable.style.border = '1.5px solid #e3eafc';
                }
            });

            // Al cargar, obtener histórico y luego iniciar updates
            Promise.all(coins.map(c => fetchHistory(c.symbol, c.id))).then(() => {
                updateCryptoCards();
                setInterval(updateCryptoCards, intervalMs);
                if (window.Reveal) {
                    Reveal.on('slidechanged', function(e) {
                        if (e.currentSlide && e.currentSlide.innerHTML.includes('Precios de Criptomonedas')) {
                            updateCryptoCards();
                        }
                    });
                }
            });
        })();
    </script>
    <script>
        // --- New Compound Interest Chart ---
        Reveal.on('ready', function(event) {
            (function() {
                const capitalInput = document.getElementById('ci-capital');
                const aportacionInput = document.getElementById('ci-aportacion');
                const interesInput = document.getElementById('ci-interes');
                const anosInput = document.getElementById('ci-anos');
                const resultadoFinalSpan = document.getElementById('ci-resultado-final');
                const ctx = document.getElementById('newCompoundInterestChart').getContext('2d');
                let compoundInterestChart = null;

                function calculateCompoundInterest() {
                    let capital = parseFloat(capitalInput.value);
                    let aportacion = parseFloat(aportacionInput.value);
                    let interes = parseFloat(interesInput.value) / 100;
                    let anos = parseInt(anosInput.value);

                    if (isNaN(capital) || isNaN(aportacion) || isNaN(interes) || isNaN(anos) || anos <= 0) {
                        resultadoFinalSpan.textContent = '$0.00';
                        if (compoundInterestChart) {
                            compoundInterestChart.destroy();
                            compoundInterestChart = null;
                        }
                        return;
                    }

                    const labels = [];
                    const data = []; // Capital Acumulado
                    const contributionData = []; // Total de Aportaciones
                    let currentCapital = capital;
                    let totalContributions = 0;

                    for (let i = 0; i <= anos; i++) {
                        labels.push(`Año ${i}`);
                        data.push(currentCapital); // Use raw number for calculation, format later
                        contributionData.push(totalContributions + capital); // Cumulative contributions + initial capital

                        if (i < anos) {
                            currentCapital = (currentCapital + aportacion) * (1 + interes);
                            totalContributions += aportacion;
                        }
                    }

                    const formatter = new Intl.NumberFormat('es-ES', {
                        style: 'currency',
                        currency: 'USD',
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                        useGrouping: true // Ensure thousands separator is always used
                    });
                    resultadoFinalSpan.textContent = formatter.format(currentCapital);
                    document.getElementById('ci-total-aportaciones').textContent = formatter.format(capital + totalContributions); // Populate total contributions
                    drawCompoundInterestChart(labels, data, contributionData); // Pass contributionData
                }

                function drawCompoundInterestChart(labels, data, contributionData) { // Added contributionData
                    if (compoundInterestChart) {
                        compoundInterestChart.destroy();
                        compoundInterestChart = null; // Set to null immediately after destroying
                    }

                    compoundInterestChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Capital Acumulado ($)', // Updated label
                                data: data,
                                borderColor: '#1976d2',
                                backgroundColor: 'rgba(25, 118, 210, 0.2)',
                                fill: true,
                                tension: 0.4
                            },
                            { // New dataset for Total de Aportaciones
                                label: 'Total de Aportaciones ($)', // Updated label
                                data: contributionData,
                                borderColor: '#FF9800', // Changed to orange
                                backgroundColor: 'rgba(255, 152, 0, 0.2)', // Changed to orange
                                fill: true,
                                tension: 0.4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: true, // Set to true to show legend for both datasets
                                    position: 'top',
                                    labels: {
                                        color: '#263238'
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            let label = context.dataset.label || '';
                                            if (label) {
                                                label += ': ';
                                            }
                                            // Format the value with currency
                                            const formatter = new Intl.NumberFormat('es-ES', {
                                                style: 'currency',
                                                currency: 'USD',
                                                minimumFractionDigits: 2,
                                                maximumFractionDigits: 2
                                            });
                                            label += formatter.format(parseFloat(context.raw));
                                            return label;
                                        }
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    title: {
                                        display: false, // Set to false by user request
                                        text: 'Años',
                                        color: '#263238'
                                    },
                                    ticks: {
                                        color: '#263238'
                                    }
                                },
                                y: {
                                    title: {
                                        display: false, // Set to false by user request
                                        text: 'Capital ($)',
                                        color: '#263238'
                                    },
                                    ticks: {
                                        color: '#263238'
                                    }
                                }
                            }
                        }
                    });
                }

                // Event Listeners
                capitalInput.addEventListener('input', calculateCompoundInterest);
                aportacionInput.addEventListener('input', calculateCompoundInterest);
                interesInput.addEventListener('input', calculateCompoundInterest);
                anosInput.addEventListener('input', calculateCompoundInterest);

                // Initial calculation and chart drawing
                calculateCompoundInterest();
            })();
        });
    </script>
</body>

</html>