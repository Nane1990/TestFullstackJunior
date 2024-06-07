
<script>

//Invertir cadena

function invertirCadena(cadena) {
  return cadena.split('').reverse().join('');
	}

//Mostrar en consola, n'umeros pares de un arreglo
// Array de números
	const numeros = [3, 6, 8, 11, 4, 9, 10, 21, 16];

// Filtrar números pares
	const numerosPares = numeros.filter(numero => numero % 2 === 0);

// Mostrar números pares en la consola
	console.log("Números pares:");
console.log(numerosPares);

//Añadir un event listener a un botón con el id #myButton para mostrar una alerta con el mensaje "Hello World" al hacer clic

document.getElementById('myButton').addEventListener('click', function() {
alert('Hello World');


//Promesa
const miPromesa = new Promise((resolve, reject) => 
{
  // Simulamos una operación asincrónica que tarda 2 segundos en completarse
  setTimeout(() => 
   {
    const exito = true;

    if (exito) 
      {
      resolve("¡La operación fue exitosa!");
      } else 
         {
          reject("¡La operación falló!");
         }
     }, 2000);
  });

miPromesa.then((mensaje) => {
console.log(mensaje);
}).catch((error) => {
console.error(error);
});

//función en JavaScript que haga una petición AJAX (usando fetch) para obtener datos de una API

function getApiData() {
  // URL de la API
  const url = 'https://example.com/api/data';

  // Petición GET usando fetch
  fetch(url)
    .then(response => response.json())
    .then(data => {
      // Mostrar los datos recibidos en el elemento #result
      const resultElement = document.getElementById('result');
      resultElement.textContent = JSON.stringify(data);
    })
    .catch(error => {
      // Mostrar un mensaje de error en caso de fallo
      const resultElement = document.getElementById('result');
      resultElement.textContent = Error: ${error};
    });

// Función para guardar una clave-valor en localStorage
function setLocalStorage(key, value) {
  localStorage.setItem(key, value);
}

// Función para recuperar una clave-valor de localStorage
function getLocalStorage(key) {
  return localStorage.getItem(key);
}

// Ejemplo de uso
setLocalStorage('nombre', 'Juan');
const nombre = getLocalStorage('nombre');
console.log(nombre); // Imprime "Juan"

 </script>
