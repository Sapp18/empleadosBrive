var tipo = 1; //Tipo de cambio. 1=pesos, 0=dolares
var aux = 0; //Auxiliar para saber cual es la primera ejecución

const inputBuscador = document.querySelector('#buscar');
eventListeners();

function eventListeners() {
    // buscador
    inputBuscador.addEventListener('input', buscarEmpleados);

    numeroEmpleados();
    tipoCambio();

}

/** Buscador de registros */
function buscarEmpleados(e) {
    const expresion = new RegExp(e.target.value, "i");
    registros = document.querySelectorAll('tbody tr');

    registros.forEach(registro => {
        registro.style.display = 'none';
        if ((registro.childNodes[3].textContent.replace(/\s/g, " ").search(expresion) != -1) || (registro.childNodes[5].textContent.replace(/\s/g, " ").search(expresion) != -1)) {
            registro.style.display = 'table-row';
        }
        numeroEmpleados();
    })
}

/** Muestra el número de Empleados */
function numeroEmpleados() {
    const totalEmpleados = document.querySelectorAll('tbody tr'),
        contenedorNumero = document.querySelector('.total-empleados span');

    let total = 0;

    totalEmpleados.forEach(contacto => {
        if (contacto.style.display === '' || contacto.style.display === 'table-row') {
            total++;
        }
    });
    contenedorNumero.textContent = total;
}

function tipoCambio() {
    const contenedorMoneda = document.querySelector('.tipo-cambio span'),
        registros = document.querySelectorAll('.salario');
    contenedorBoton = document.querySelector('.moneda-boton');

    if (tipo == 1) {
        contenedorMoneda.textContent = 'Tipo de moneda: MXN';
        contenedorBoton.value = 'Cambiar a Dolares';
    } else {
        contenedorMoneda.textContent = 'Tipo de moneda: USD';
        contenedorBoton.value = 'Cambiar a Pesos';
    }

    registros.forEach(registro => {
        var mxn = ' MXN';
        var usd = ' USD';
        if (aux == 0) { //Primera ejecución, valor default por base de datos
            registro.textContent = registro.textContent;
            aux = 1;
        } else if (tipo == 1) { //Despues de la primera ejecución si se cambia a 1, se multiplica para los pesos
            registro.textContent = (parseFloat(registro.textContent.replace(",", "")) * 21.5).toLocaleString('en', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + mxn;
        } else { //Despues de la primera ejecución si se cambia a 0, se divide para los dolares
            registro.textContent = (parseFloat(registro.textContent.replace(",", "")) / 21.5).toLocaleString('en', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + usd;
        }
    })

}

function funcionBoton() {
    if (tipo == 1) {
        tipo = 0;
    } else {
        tipo = 1;
    }
    tipoCambio();
}