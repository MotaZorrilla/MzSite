// Inicialización de Reveal.js
// Inicializa la presentación de Reveal.js con las opciones especificadas.
Reveal.initialize({
    hash: true, // Habilita el hash en la URL para navegar a diapositivas específicas.
    controls: true, // Muestra los controles de navegación (flechas).
    progress: true, // Muestra la barra de progreso de la presentación.
    center: true, // Centra el contenido de las diapositivas vertical y horizontalmente.
    transition: 'slide', // Establece la transición entre diapositivas como 'slide'.
    slideNumber: true, // Muestra el número de la diapositiva actual.
    plugins: [] // Define un array vacío para los plugins, lo que significa que no se usan plugins adicionales.
});

// Calculadora 50/30/15/5
// Obtiene la referencia al elemento input con el ID 'monthly-income'.
const monthlyIncomeInput = document.getElementById('monthly-income');

// Verifica si el elemento monthlyIncomeInput existe en el DOM.
if(monthlyIncomeInput) {
    // Añade un 'event listener' al input para detectar cambios en su valor.
    monthlyIncomeInput.addEventListener('input', function() {
        // Convierte el valor del input a un número flotante, o 0 si no es un número válido.
        const income = parseFloat(this.value) || 0;
        
        // Formatear como moneda
        // Crea un objeto Intl.NumberFormat para formatear números como moneda en español (USD).
        const formatter = new Intl.NumberFormat('es-ES', {
            style: 'currency', // Establece el estilo de formato como moneda.
            currency: 'USD' // Define la moneda a usar como Dólares Estadounidenses.
        });
        
        // Calcular los porcentajes
        // Actualiza el contenido de texto del elemento con ID 'needs' con el 50% del ingreso formateado como moneda.
        document.getElementById('needs').textContent = formatter.format(income * 0.5);
        // Actualiza el contenido de texto del elemento con ID 'wants' con el 30% del ingreso formateado como moneda.
        document.getElementById('wants').textContent = formatter.format(income * 0.3);
        // Actualiza el contenido de texto del elemento con ID 'savings' con el 15% del ingreso formateado como moneda.
        document.getElementById('savings').textContent = formatter.format(income * 0.15);
        // Actualiza el contenido de texto del elemento con ID 'crypto' con el 5% del ingreso formateado como moneda.
        document.getElementById('crypto').textContent = formatter.format(income * 0.05);
    });
}

// Simulador de Gastos Hormiga
const coffeeExpenseInput = document.getElementById('coffee-expense');
const foodExpenseInput = document.getElementById('food-expense');
const subscriptionsExpenseInput = document.getElementById('subscriptions-expense');
const impulseExpenseInput = document.getElementById('impulse-expense');
const antExpensesTotalSpan = document.getElementById('ant-expenses-total');

function calculateAntExpenses() {
    const coffee = parseFloat(coffeeExpenseInput.value) || 0;
    const food = parseFloat(foodExpenseInput.value) || 0;
    const subscriptions = parseFloat(subscriptionsExpenseInput.value) || 0;
    const impulse = parseFloat(impulseExpenseInput.value) || 0;

    const totalAntExpenses = coffee + food + subscriptions + impulse;

    const formatter = new Intl.NumberFormat('es-ES', {
        style: 'currency',
        currency: 'USD'
    });

    antExpensesTotalSpan.textContent = formatter.format(totalAntExpenses);
}

if (coffeeExpenseInput) {
    coffeeExpenseInput.addEventListener('input', calculateAntExpenses);
    foodExpenseInput.addEventListener('input', calculateAntExpenses);
    subscriptionsExpenseInput.addEventListener('input', calculateAntExpenses);
    impulseExpenseInput.addEventListener('input', calculateAntExpenses);

    // Calcular el total inicial al cargar la página
    calculateAntExpenses();
}

// Simulador de Interés Compuesto
const initialInvestmentInput = document.getElementById('initial-investment');
const monthlyContributionInput = document.getElementById('monthly-contribution');
const annualReturnInput = document.getElementById('annual-return');
const investmentPeriodInput = document.getElementById('investment-period');
const futureValueSpan = document.getElementById('future-value');
const ctx = document.getElementById('compoundInterestChart').getContext('2d');

let compoundInterestChart;

function calculateCompoundInterest() {
    const initialInvestment = parseFloat(initialInvestmentInput.value) || 0;
    const monthlyContribution = parseFloat(monthlyContributionInput.value) || 0;
    const annualReturn = parseFloat(annualReturnInput.value) || 0;
    const investmentPeriod = parseFloat(investmentPeriodInput.value) || 0;

    const monthlyReturnRate = (annualReturn / 100) / 12;
    const totalMonths = investmentPeriod * 12;

    let futureValue = initialInvestment;
    const labels = [];
    const data = [];

    for (let i = 0; i <= totalMonths; i++) {
        if (i > 0) {
            futureValue = (futureValue * (1 + monthlyReturnRate)) + monthlyContribution;
        }
        if (i % 12 === 0) { // Cada año
            labels.push(`Año ${i / 12}`);
            data.push(futureValue);
        }
    }

    const formatter = new Intl.NumberFormat('es-ES', {
        style: 'currency',
        currency: 'USD'
    });

    futureValueSpan.textContent = formatter.format(futureValue);

    if (compoundInterestChart) {
        compoundInterestChart.destroy();
    }

    compoundInterestChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Valor de la Inversión',
                data: data,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1,
                fill: false
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Crecimiento de la Inversión a lo Largo del Tiempo'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Año'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Valor ($)'
                    },
                    beginAtZero: true
                }
            }
        }
    });
}

if (initialInvestmentInput) {
    initialInvestmentInput.addEventListener('input', calculateCompoundInterest);
    monthlyContributionInput.addEventListener('input', calculateCompoundInterest);
    annualReturnInput.addEventListener('input', calculateCompoundInterest);
    investmentPeriodInput.addEventListener('input', calculateCompoundInterest);

    // Calcular el interés compuesto inicial al cargar la página
    calculateCompoundInterest();
}

// Widget de Precios de Criptomonedas
const cryptoPricesDiv = document.getElementById('crypto-prices');

async function fetchCryptoPrices() {
    if (!cryptoPricesDiv) return;

    try {
        const response = await web_fetch({
            prompt: 'Fetch crypto prices from https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum,ripple,litecoin&vs_currencies=usd'
        });
        const data = JSON.parse(response.text);

        let html = '<h4>Precios Actuales:</h4>';
        const formatter = new Intl.NumberFormat('es-ES', {
            style: 'currency',
            currency: 'USD'
        });

        for (const [coin, prices] of Object.entries(data)) {
            html += `<p>${coin.charAt(0).toUpperCase() + coin.slice(1)}: <strong>${formatter.format(prices.usd)}</strong></p>`;
        }
        cryptoPricesDiv.innerHTML = html;

    } catch (error) {
        console.error('Error fetching crypto prices:', error);
        cryptoPricesDiv.innerHTML = '<p>Error al cargar los precios de las criptomonedas.</p>';
    }
}

// Llama a la función para obtener precios cuando la diapositiva de cripto esté activa
Reveal.on('slidechanged', event => {
    if (event.currentSlide.querySelector('#crypto-prices')) {
        fetchCryptoPrices();
    }
});

// Llama a la función al cargar la página si la diapositiva de cripto es la inicial
if (document.getElementById('crypto-prices')) {
    fetchCryptoPrices();
}
