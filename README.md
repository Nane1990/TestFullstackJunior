# TestFullstackJunior
Prueba desarrollada para aplicar a una vacacnte de fullstack junior/traineer

Sección 1: Symfony
1. **Pregunta de Configuración:**
Describe los pasos básicos para levantar un proyecto en Symfony.

Antes de empezar, tener instalados los siguientes componentes:
XAMPP: Un entorno de desarrollo que incluye Apache, MySQL y PHP.
Paso 1: Crear el Proyecto Symfony
Paso 2: Configurar la Conexión a la Base de Datos
Paso 3: Agregar el Archivo .env al .gitignore
Paso 4: Instalar Doctrine
Paso 5: Iniciar el Servidor
Paso 6: Crear la Base de Datos
Paso 7: Crear Entidades
Paso 8: Establecer Relaciones
Paso 9: Aplicar Cambios en la Base de Datos
Paso 10: Crear Controladores

2. **Pregunta de Código:**
Crea un controlador en Symfony que maneje una ruta /hello/{name} y devuelva un saludo personalizado. Además, si el nombre no se proporciona, debe devolver un saludo predeterminado "Hello World". (opcional) Implementa también una prueba unitaria para verificar que la ruta devuelve el saludo correcto.

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    /**
     * @Route("/hello/{name}", name="hello")
     */
    public function hello($name)
    {
        return new Response('¡Hola, ' . $name . '!');
    }
}

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    /**
     * @Route("/hello/{name}", name="hello")
     */
    public function hello($name = "World")
    {
        return new Response('¡Hola, ' . $name . '!');
    }
}

Prueba unitaria:

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HelloControllerTest extends WebTestCase
{
    public function testHelloWithoutName()
    {
        $client = static::createClient();
        $client->request('GET', '/hello');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertStringContainsString('¡Hola, World!', $client->getResponse()->getContent());
    }
}

3. **Pregunta Teórica:**
- Explica la arquitectura de Symfony y cómo se organiza un proyecto típico en términos de carpetas y archivos.

La estructura de carpetas en Symfony sigue una arquitectura MVC (Modelo-Vista-Controlador), lo que significa que el código se organiza en diferentes carpetas según su función. Algunas de las carpetas más importantes son:
•	config: Contiene los archivos de configuración del proyecto, como las rutas, la configuración de la base de datos y los servicios.
•	src: Aquí se encuentra el código fuente de la aplicación, incluyendo los controladores (Controller), modelos (Entity) y vistas.(Repository, consultas a la base de datos)
•	templates: Contiene las plantillas de vistas escritas en Twig, el motor de plantillas de Symfony.
•	public: Carpeta accesible desde el navegador que almacena archivos estáticos como imágenes, hojas de estilo y scripts JavaScript.
•	vendor: Contiene las dependencias del proyecto, que son las bibliotecas y paquetes de terceros instalados a través de Composer.
•	bin: Contiene el archivo “console”, que se utiliza para ejecutar comandos en la terminal, como la ejecución de tareas programadas o la ejecución de comandos personalizados.
•	var: Almacena la caché y registros (logs).

4. **Pregunta de Código:**
Escribe un servicio en Symfony que se inyecta en un controlador y realiza una operación matemática básica (por ejemplo, sumar dos números). ¿Qué configuraciones son necesarias para poder usarlo? (opcional) Implementa también una prueba unitaria para verificar el correcto funcionamiento del servicio.

Para crear un servicio en Symfony que realice una operación matemática básica y luego inyectarlo en un controlador, puedes seguir estos pasos:
1.	Crear la clase del servicio:
// src/Service/MathService.php

namespace App\Service;

class MathService
{
    public function sum($a, $b)
    {
        return $a + $b;
    }
}

2.	Registrar el servicio en el contenedor de servicios de Symfony:
# config/services.yaml
services:
    App\Service\MathService: ~

3.	Inyectar el servicio en el controlador:
namespace App\Controller;

use App\Service\MathService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class SomeController extends AbstractController
{
    private $mathService;

    public function __construct(MathService $mathService)
    {
        $this->mathService = $mathService;
    }

    public function someAction()
    {
        $result = $this->mathService->sum(5, 3);

        return new Response('The sum is: ' . $result);
    }
}

5. **Pregunta de Código:**
Muestra cómo crear un formulario en Symfony para una entidad User con campos username y email.

1.	Primero asegurarme de tener la entidad User definida en el proyecto:
// src/Entity/User.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    // getters y setters para $username y $email
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}

2.	Luego, crear una clase de tipo formulario UserType que Symfony utilizará para construir el formulario:
// src/Form/UserType.php
namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

3.	Después de definir la entidad y el formulario, puedo usar este formulario en un controlador para manejar la solicitud y renderizar el formulario en una plantilla Twig:
// src/Controller/UserController.php
namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user/new", name="user_new")
     */
    public function newUser(Request $request): Response
    {
        // crea una nueva instancia de User
        $user = new User();

        // crea el formulario
        $form = $this->createForm(UserType::class, $user);

        // maneja la solicitud
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // guarda el nuevo usuario, por ejemplo:
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($user);
            // $entityManager->flush();

            return $this->redirectToRoute('user_success');
        }

        // renderiza el formulario en la plantilla twig
        return $this->render('user/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

4.	Finalmente, en la plantilla Twig, puedo renderizar el formulario:
{# templates/user/new.html.twig #}
{% extends 'base.html.twig' %}
{% block body %}
    <h1>Create new User</h1>

    {{ form_start(form) }}
        {{ form_widget(form) }}
        <button class="btn">Register</button>
    {{ form_end(form) }}
{% endblock %}

Nota: Necesitaré tener configurado Twig y Doctrine para que funcione correctamente, y que los paths y namespaces sean consistentes con la estructura del proyecto en Symfony.

6. **Pregunta Teórica:**
Explica el concepto de Dependency Injection (DI) en Symfony y cómo se configura.

En Symfony, Dependency Injection (DI) es un patrón de diseño y un componente clave en el framework. Permite la inversión de control al separar las dependencias de una clase y proporcionarlas desde un contenedor centralizado. En otras palabras, Dependency Injection es una forma de resolver las dependencias de una clase, es decir, proporcionar los objetos necesarios para su funcionamiento. En lugar de que la clase misma instancie o cree sus dependencias, se le proporcionan desde fuera. 
La configuración de DI en Symfony se realiza en el archivo services.yaml ubicado en la carpeta config del proyecto. En este archivo, puedo definir los servicios y sus dependencias. Un servicio es una clase o un objeto que se puede compartir y reutilizar en diferentes partes de la aplicación. Un ejemplo básico de cómo se configura un servicio en Symfony es el siguiente:

# config/services.yaml
services:
    app.my_service:
        class: App\Service\MyService
        arguments:
            - '@app.my_dependency'
    
    app.my_dependency:
        class: App\Service\MyDependency

7. **Pregunta de Código:**
Escribe una consulta Doctrine en Symfony para obtener todos los registros de una entidad Product donde el precio sea mayor a 100.

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
// ...
class ProductRepository
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findProductsGreaterThanPrice($price)
    {
        $query = $this->entityManager->createQueryBuilder()
            ->select('p')
            ->from(Product::class, 'p')
            ->where('p.price > :price')
            ->setParameter('price', $price)
            ->getQuery();

        return $query->getResult();
    }
}

8. **Pregunta Teórica:**
¿Qué es el Event Dispatcher en Symfony y para qué se utiliza?

El Event Dispatcher en Symfony es un componente que permite la implementación del patrón de diseño observador (también conocido como patrón de eventos). Proporciona una forma estructurada y flexible de manejar eventos y ejecutar acciones en respuesta a ellos. En otras palabras, el Event Dispatcher se utiliza para comunicar y desacoplar distintas partes de una aplicación. Permite que ciertas partes del código (llamadas "listeners" o "event subscribers") se suscriban a eventos específicos y respondan a ellos cuando se produzcan. El Event Dispatcher sigue el principio de inversión de control. En lugar de que una clase específica llame directamente a otras clases para realizar ciertas acciones, emite un evento y deja que los listeners correspondientes se encarguen de manejarlo. Esto proporciona una mayor flexibilidad y reutilización de código, ya que los listeners pueden ser agregados o eliminados fácilmente sin afectar a la clase que emite el evento. Symfony proporciona una implementación robusta del Event Dispatcher a través del componente EventDispatcher. Este componente permite definir eventos personalizados y los listeners asociados a ellos. Puedo crear mis propios eventos personalizados y utilizar los eventos predefinidos en Symfony, como eventos del ciclo de vida de una solicitud HTTP, eventos de seguridad, eventos de formularios, entre otros.

9. **Pregunta de Código:**
Crea un validador personalizado en Symfony para asegurar que el campo email de una entidad User no pertenece a un dominio específico (por ejemplo, "example.com"). Muestra cómo configurar este validador y cómo sería utilizado en la entidad User.

1.	Creo una clase para el validador personalizado, por ejemplo "EmailDomain":
// src/Validator/Constraints/EmailDomain.php

namespace App\Validator\Constraints;
use Symfony\Component\Validator\Constraint;
/**
 * @Annotation
 */
class EmailDomain extends Constraint
{
    public $message = 'El dominio "{{ domain }}" no está permitido.';
}

2.	Creo una clase para el validador en sí, por ejemplo "EmailDomainValidator":
// src/Validator/Constraints/EmailDomainValidator.php
namespace App\Validator\Constraints;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
class EmailDomainValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof EmailDomain) {
            throw new \InvalidArgumentException(sprintf(
                'The constraint must be an instance of "%s".',
                EmailDomain::class
            ));
        }

        if (!$value) {
            return;
        }

        $email = explode('@', $value);
        $domain = $email[1];

        if (strtolower($domain) === 'example.com') {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ domain }}', $domain)
                ->addViolation();
        }
    }
}

3.	Registro el validador personalizado en el archivo de servicios:
# config/services.yaml
services:
    App\Validator\Constraints\EmailDomainValidator: ~

4.	Utilizo el validador en la entidad "User":
// src/Entity/User.php
namespace App\Entity;
use App\Validator\Constraints as CustomAssert;
use Symfony\Component\Validator\Constraints as Assert;
class User
{
    // ...

    /**
     * @Assert\Email()
     * @CustomAssert\EmailDomain()
     */
    private $email;

    // ...
}

10. **Pregunta de Código:**
Implementa un Event Subscriber en Symfony que escuche el evento kernel.request y registre en un archivo de log cada visita a cualquier página de la aplicación. Asegúrate de configurar el servicio correctamente para que el suscriptor se registre con el evento.

1.	Creo una clase para el Event Subscriber. Por ejemplo, ¨ RequestSubscriber y la coloco en el directorio src/EventSubscriber¨.
// src/EventSubscriber/RequestSubscriber.php
namespace App\EventSubscriber;
use SymfonyComponentEventDispatcherEventSubscriberInterface;
use SymfonyComponentHttpKernelEvent\RequestEvent;
use PsrLogLoggerInterface;
class RequestSubscriber implements EventSubscriberInterface
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
          $this->logger = $logger;
     }

     public static function getSubscribedEvents()
     {
          return ['kernel.request' => 'onKernelRequest',];
     }

     public function onKernelRequest(RequestEvent $event)
     {
          $request = $event->getRequest();
          $this->logger->info('Visita a la página: ' . $request->getUri());
     }
}

2.	Registro el Event Subscriber como un servicio en el archivo config/services.yaml
services:
   App\EventSubscriber\RequestSubscriber:
        arguments:
            $logger: '@logger'
   tags:
            - { name: 'kernel.event_subscriber' }

Nota: Tener configurado un logger en Symfony para que los mensajes se registren correctamente en el archivo de log.



Sección 2: JavaScript

1. **Pregunta Teórica:**
- Explica la diferencia entre var, let y const en JavaScript.

En JavaScript, var, let y const son formas de declarar variables, pero tienen diferencias importantes en cuanto a su alcance y mutabilidad:
1.	var: Antes de la introducción de let y const, var era la forma estándar de declarar variables en JavaScript. Las variables declaradas con var tienen un alcance de función o global, lo que significa que pueden ser accedidas dentro de la función en la que fueron declaradas o globalmente si se declaran fuera de cualquier función. Además, las variables declaradas con var pueden ser reasignadas y redeclaradas en el mismo ámbito.

Ejemplo:

var x = 10;
var x = 20; // Esto es válido

2.	let: let fue introducido en ECMAScript 6 y tiene un alcance de bloque, lo que significa que las variables declaradas con let solo son accesibles dentro del bloque en el que fueron declaradas. Además, las variables declaradas con let no pueden ser redeclaradas en el mismo ámbito, pero sí pueden ser reasignadas.

Ejemplo:

let y = 10;
let y = 20; // Esto dará un error de sintaxis

3.	const: const también fue introducido en ECMAScript 6 y tiene un alcance de bloque al igual que let. La diferencia principal es que las variables declaradas con const son constantes, lo que significa que no pueden ser reasignadas una vez que se les asigna un valor. Sin embargo, es importante tener en cuenta que si la variable es un objeto o un array, el contenido del objeto o array sí puede ser modificado.


const z = 10;
z = 20; // Esto dará un error, ya que z es una constante y no puede ser reasignada
En resumen, var tiene un alcance de función o global, let tiene un alcance de bloque y permite la reasignación pero no la redeclaración, y const tiene un alcance de bloque, no permite la reasignación y se utiliza para declarar constantes. Es recomendable utilizar let.

2. **Pregunta de Código:**
- Escribe una función en JavaScript que invierta una cadena de texto.

function invertirCadena(cadena) {
return cadena.split('').reverse().join('');
}

// Ejemplo de uso
const textoOriginal = 'Hola Mundo';
const textoInvertido = invertirCadena(textoOriginal);
console.log(textoInvertido); // Resultado: odnuM aloH

En esta función invertirCadena, se utiliza el método split('') para convertir la cadena en un arreglo de caracteres, luego se utiliza el método reverse() para invertir el orden de los elementos en el arreglo y finalmente se utiliza join('') para unir los caracteres invertidos en una nueva cadena. De esta forma, la función devuelve la cadena original invertida.

3. **Pregunta Teórica:**
- ¿Qué es el Event Loop en JavaScript y cómo funciona?

El Event Loop es un mecanismo esencial en JavaScript que maneja la ejecución de código de manera asíncrona y no bloqueante. Funciona de la siguiente manera:

•	JavaScript es un lenguaje de programación de un solo hilo, lo que significa que solo puede ejecutar una tarea a la vez.
•	Cuando se ejecuta un script en JavaScript, el motor de JavaScript (como V8 en el caso de Chrome) coloca las tareas en una cola de eventos.
•	El Event Loop es un bucle que se encarga de revisar constantemente si hay tareas en la cola de eventos para ejecutar.
•	Si la cola de eventos está vacía, el Event Loop espera hasta que se agreguen nuevas tareas a la cola.
•	Cuando una tarea en la cola de eventos está lista para ejecutarse, el Event Loop la saca de la cola y la ejecuta.
•	Las tareas asíncronas, como las peticiones a servidores o la manipulación de archivos, se manejan de manera no bloqueante, lo que significa que no detienen la ejecución del resto del código.
•	Gracias al Event Loop, JavaScript puede manejar tareas asíncronas de manera eficiente y proporcionar una experiencia de usuario más fluida en aplicaciones web.

4. **Pregunta de Código:**
- Escribe un script en JavaScript que filtre los números pares de un array de números y los muestre en la consola.
```javascript 
// Array de números
const numeros = [3, 6, 8, 11, 4, 9, 10, 21, 16];

// Filtrar números pares
const numerosPares = numeros.filter(numero => numero % 2 === 0);

// Mostrar números pares en la consola
console.log("Números pares:");
console.log(numerosPares);
```

5. **Pregunta Teórica:**
- ¿Qué es el DOM y cómo se manipula usando JavaScript?

El DOM (Document Object Model) es una representación en forma de árbol de la estructura de un documento HTML o XML, que permite a los desarrolladores acceder y manipular los elementos de la página web de forma dinámica utilizando JavaScript. Para manipular el DOM usando JavaScript, se pueden utilizar los siguientes métodos y propiedades:

1. Acceder a elementos del DOM: Se puede acceder a elementos del DOM utilizando métodos como `getElementById()`, `getElementsByClassName()`, `getElementsByTagName()`, `querySelector()`, `querySelectorAll()`, entre otros.

2. Modificar contenido de elementos: Se pueden modificar el contenido de elementos del DOM utilizando propiedades como `innerText`, `innerHTML`, `textContent`.

3. Modificar atributos de elementos: Se pueden modificar los atributos de los elementos del DOM utilizando propiedades como `setAttribute()`, `getAttribute()`, `removeAttribute()`.

4. Crear nuevos elementos: Se pueden crear nuevos elementos del DOM utilizando el método `createElement()` y luego añadirlos a la página utilizando métodos como `appendChild()`.

5. Eliminar elementos: Se pueden eliminar elementos del DOM utilizando el método `removeChild()`.

En resumen, el DOM permite a los desarrolladores acceder y manipular los elementos de una página web de forma dinámica, lo que es fundamental para crear interactividad y dinamismo en las aplicaciones web.

6. **Pregunta de Código:**
- Escribe un código en JavaScript que añada un event listener a un botón con el id #myButton para mostrar una alerta con el mensaje "Hello World" al hacer clic.
```javascript
document.getElementById('myButton').addEventListener('click', function() {
alert('Hello World');
});
```

7. **Pregunta Teórica:**
- Explica qué es una Promesa en JavaScript y proporciona un ejemplo básico.

En JavaScript, una Promesa es un objeto que representa la eventual finalización o falla de una operación asincrónica, y su valor resultante. Las promesas son utilizadas para manejar operaciones asíncronas de una manera más limpia y legible. Un ejemplo básico de Promesa:

```javascript
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
```
En este ejemplo, creamos una Promesa que simula una operación asincrónica que tarda 2 segundos en completarse. Si la operación es exitosa, se llama a la función resolve con un mensaje de éxito. Si la operación falla, se llama a la función reject con un mensaje de error. Luego, utilizamos los métodos then y catch para manejar el resultado de la Promesa, ya sea el mensaje de éxito o el mensaje de error.

8. **Pregunta de Código:**
- Escribe una función en JavaScript que haga una petición AJAX (usando fetch) para obtener datos de una API y los muestre en un elemento con el id #result.

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


9. **Pregunta Teórica:**
- ¿Cuál es la diferencia entre null, undefined y NaN en JavaScript?

Null: Es un valor especial que indica la ausencia intencional de un valor. Se asigna explícitamente mediante el operador null. Representa la ausencia de un objeto o valor. 

Undefined: Es un valor primitivo que indica que una variable no ha sido definida o no se le ha asignado un valor. Se asigna automáticamente a las variables declaradas pero no inicializadas. También representa la propiedad ausente de un objeto. 

NaN (Not-a-Number): Es un valor especial que representa un cálculo inválido o un valor numérico no válido. Se genera cuando se intenta realizar una operación matemática con operandos no válidos (por ejemplo, dividir por cero, tomar la raíz cuadrada de un número negativo). No es igual a ningún otro valor, ni siquiera a sí mismo (es decir, NaN !== NaN).

Ejemplo:
const a = null; // Ausencia intencional de un valor
const b; // Variable no definida, por lo que es undefined
const c = Math.sqrt(-1); // Cálculo inválido, por lo que es NaN

10. **Pregunta de Código:**
- Implementa una función en JavaScript que use localStorage para guardar una clave-valor y luego recuperarla.

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

En este ejemplo, la función setLocalStorage guarda la clave-valor "nombre" : "Juan" en localStorage. Luego, la función getLocalStorage recupera el valor asociado con la clave "nombre".


Sección 3: Git

1. **Pregunta Teórica:**
- ¿Qué es Git y para qué se utiliza en el desarrollo de software?

Qué es Git? Git es un sistema de control de versiones distribuido que permite a los desarrolladores rastrear cambios en el código fuente a lo largo del tiempo y colaborar en proyectos. 
Características principales: 
• Seguimiento de versiones: Git almacena un historial de todos los cambios realizados en un proyecto, lo que permite a los desarrolladores revertir o restaurar versiones anteriores del código. • Colaboración distribuida: Git permite que múltiples desarrolladores trabajen en el mismo proyecto simultáneamente, incluso si están en ubicaciones diferentes. 
• Ramificación: Git permite a los desarrolladores crear ramas del código principal para trabajar en nuevas funciones o correcciones de errores sin afectar al código principal. 
• Fusión: Git proporciona herramientas para fusionar cambios de diferentes ramas de una manera controlada y sin conflictos. 

Usos en el desarrollo de software: Git es una herramienta esencial para el desarrollo de software moderno, ya que: 
• Mejora la colaboración: Facilita la colaboración entre desarrolladores al permitirles rastrear y fusionar cambios de forma eficiente. 
• Asegura la integridad del código: Proporciona un historial completo de los cambios, lo que permite a los desarrolladores identificar y solucionar problemas rápidamente. 
• Habilita el trabajo en paralelo: Permite a los desarrolladores trabajar en diferentes ramas simultáneamente, lo que acelera el desarrollo. 
• Simplifica el control de versiones: Automatiza el seguimiento y la gestión de las diferentes versiones del código. 
• Facilita las revisiones de código: Permite a los desarrolladores revisar y comentar los cambios realizados por otros, mejorando la calidad del código. En resumen, Git es una herramienta indispensable para los desarrolladores de software, ya que proporciona un marco robusto para el control de versiones, la colaboración y el desarrollo ágil.

2. **Pregunta de Comandos:**
- ¿Cuál es el comando para clonar un repositorio de Git?

git clone [url del repositorio]

3. **Pregunta Teórica:**
- Explica qué es un "branch" (rama) en Git y para qué se utiliza.

Un branch en Git es una línea de desarrollo separada del código principal (rama maestra). Permite a los desarrolladores trabajar en nuevas funciones o correcciones de errores sin afectar al código principal. 
Usos de los branchs: 
Las ramas se utilizan principalmente para los siguientes propósitos: 
• Desarrollo de nuevas funciones: Los desarrolladores pueden crear ramas para trabajar en nuevas funciones sin afectar al código principal estable. 
• Corrección de errores: Se pueden crear ramas para aislar las correcciones de errores y probarlas antes de fusionarlas con el código principal. 
• Experimentación: Las ramas permiten a los desarrolladores experimentar con cambios en el código sin comprometer el código principal. 
• Colaboración: Las ramas facilitan la colaboración entre desarrolladores, ya que pueden trabajar en diferentes ramas simultáneamente y fusionar sus cambios más tarde.

Cómo utilizar los branchs: 
Para crear una nueva rama, utiliza el comando git Branch:
git branch [nombre de la rama]

Para cambiar a una rama diferente, utiliza el comando git checkout:
git checkout [nombre de la rama]

Una vez realizado los cambios en una rama, se pueden fusionar con la rama principal mediante el comando git merge:
git merge [nombre de la rama]

Beneficios de utilizar branchs: 
• Aislamiento: Las ramas aíslan los cambios del código principal, lo que permite a los desarrolladores trabajar en nuevas funciones o correcciones de errores sin afectar a la estabilidad del código principal. 
• Flexibilidad: Las ramas permiten a los desarrolladores experimentar con diferentes enfoques y revertir los cambios fácilmente si es necesario. 
• Colaboración: Las ramas facilitan la colaboración al permitir que múltiples desarrolladores trabajen en diferentes aspectos del proyecto simultáneamente. En resumen, las ramas en Git son esenciales para el desarrollo de software, ya que permiten a los desarrolladores trabajar en cambios aislados, colaborar eficazmente y mantener la integridad del código principal.


4. **Pregunta de Comandos:**
- Proporciona los comandos necesarios para crear una nueva rama llamada feature-xyz, cambiar a esa rama, y luego fusionarla con la rama main.

Comandos para crear, cambiar y fusionar una rama en Git:
1.	Crear una nueva rama llamada feature-xyz: git branch feature-xyz

2.	Cambiar a la rama feature-xyz: git checkout feature-xyz

3.	Realizar cambios y confirmarlos en la rama feature-xyz: # Realizar cambios en los archivos git add . git commit -m "Descripción de los cambios" 

4.	Fusionar la rama feature-xyz con la rama main: git checkout main git merge feature-xyz

5.	Eliminar la rama feature-xyz (opcional): git branch -d feature-xyz

Nota: Es importante asegurarse de que la rama main esté actualizada antes de fusionar la rama feature-xyz en ella. Se puede hacer ejecutando el comando git pull antes de realizar la fusión.


5. **Pregunta Teórica:**
- ¿Qué es un "merge conflict" y cómo se resuelve?

Un merge conflict ocurre cuando Git no puede fusionar automáticamente los cambios de dos ramas porque hay cambios conflictivos en los mismos archivos y líneas de código. Para resolver un merge conflict, se debe editar manualmente el archivo conflictivo y combinar los cambios de ambas ramas.

Pasos para resolver un merge conflict: 
1. Identificar el archivo conflictivo: Git te mostrará una lista de los archivos que contienen conflictos. 
2. Abrir el archivo conflictivo: Utiliza un editor de texto para abrir el archivo conflictivo. 
3. Buscar los marcadores de conflicto: Git insertará marcadores de conflicto en el archivo, que suelen tener este aspecto:
<<<<<<< HEAD
   Cambios de la rama actual
   =======
   Cambios de la rama que se está fusionando
   >>>>>>> [nombre de la rama que se está fusionando]

4. Combinar los cambios: Elimina los marcadores de conflicto y combina los cambios de ambas ramas en una sola versión del archivo. 
5. Guardar y confirmar los cambios: Guarda los cambios en el archivo y confirma los cambios en Git.

Ejemplo: Suponiendo que tengo un archivo llamado nane.py con los siguientes cambios en dos ramas diferentes: 
Rama A:
def suma(a, b):
    return a + b
Rama B:
def suma(a, b, c):
    return a + b + c

Al fusionar la rama B en la rama A, se produce un merge conflict en nane.py. Git mostrará el siguiente mensaje:
Auto-merging nane.py
CONFLICT (content): Merge conflict in nane.py

Para resolver el conflicto, hay que editar nane.py y combinar los cambios de ambas ramas, como:
def suma(a, b, c=None):
    if c is not None:
        return a + b + c
    else:
        return a + b

Resuelto el conflicto, hay que guardar y confirmar los cambios, y la fusión se completará.

6. **Pregunta de Comandos:**
- ¿Cuál es el comando para visualizar el estado actual del repositorio en Git?
git status

7. **Pregunta Teórica:**
- Explica la diferencia entre git pull y git fetch.

La diferencia entre `git pull` y `git fetch` radica en cómo actualizan el repositorio local con cambios del repositorio remoto. 

`git fetch` 
* Solo descarga: `git fetch` simplemente descarga los cambios del repositorio remoto, incluyendo nuevas ramas y commits, sin modificar el repositorio local. Esto significa que la rama actual seguirá siendo la misma, y los cambios descargados quedarán en el historial local. 
* No integra cambios: Los cambios descargados se almacenan en un "branch remoto", que es una copia local de la rama del repositorio remoto. 
* Necesita integración: Para integrar estos cambios en el repositorio local, se debe usar `git merge` o `git rebase`.

`git pull` 
* Descarga e integra: `git pull` realiza dos acciones en una: descarga los cambios del repositorio remoto (como `git fetch`) y los integra en la rama actual. 
* Combina automáticamente: `git pull` equivale a ejecutar `git fetch` seguido de `git merge`. 
* Potencial conflicto: Si hay conflictos entre los cambios locales y los cambios descargados, `git pull` intentará resolverlos automáticamente. Si no se puede resolver automáticamente, hay que resolver los conflictos manualmente. 

Resumiendo: `git fetch` es como mirar el estado de la rama remota sin cambiar la rama local `git pull` es como tomar el estado de la rama remota y actualizar la rama local con los cambios. 

Cuándo usar cada comando: 
* `git fetch`: Cuando solo quiero ver los cambios remotos y luego decido cómo integrarlos. 
* `git pull`: Cuando quiero integrar automáticamente los cambios remotos en la rama actual. 

8. **Pregunta de Comandos:**
- ¿Cuál es el comando para revertir el último commit en Git?

Para revertir el último commit en Git, existen dos opciones principales: 
1. `git revert`: git revert HEAD
* Crea un nuevo commit: `git revert` crea un nuevo commit que revierte los cambios del commit anterior. Es decir, si el último commit introdujo nuevas líneas de código, `git revert` crea un commit que las elimina. 
* Conserva el historial: Este comando conserva el historial completo, incluyendo el commit que se revierte.

2. `git reset`:  git reset HEAD^
* Elimina el commit: `git reset` elimina el último commit del historial. Esto significa que los cambios del commit revertido se perderán si no se han hecho otras ramas que contengan esos cambios. 
* No conserva el historial: El historial se reescribe, por lo que se pierden los cambios del commit que se revierte.

9. **Pregunta Teórica:**
- ¿Qué es un "remote repository" y cómo se configura en Git?

Un repositorio remoto (remote repository) es una copia del repositorio Git que se almacena en un servidor. Es como un respaldo de mi trabajo que también me permite colaborar con otros desarrolladores. Para configurarlo debemos:

1. Crear un repositorio remoto: 
* Plataformas populares: Puedo crear un repositorio remoto en plataformas como GitHub, GitLab, Bitbucket, etc.
* Crear un nuevo repositorio: En la plataforma elegida, creo un nuevo repositorio con el nombre que desee.
* Obtener la URL del repositorio: La plataforma me proporcionará una URL del repositorio, que normalmente tiene el formato: `git@github.com:username/repositorio.git` o `https://github.com/username/repositorio.git`. 

2. Añadir el repositorio remoto a mi repositorio local:
* Comando `git remote add`: Utilizo este comando para añadir el repositorio remoto a mi repositorio local.
git remote add origin git@github.com:username/repositorio.git

Nota: `origin` es el nombre comúnmente utilizado para el repositorio remoto, pero se puede usar cualquier nombre.

3. Subir los cambios al repositorio remoto:
* Comando `git push`: Envía los cambios del repositorio local al repositorio remoto.
git push origin main

Nota: `main` es el nombre de la rama que se está subiendo (generalmente la rama principal).

10. **Pregunta de Comandos:**
- Proporciona los comandos para añadir todos los cambios en los archivos al staging area y luego realizar un commit con el mensaje "Initial commit".

1. Añadir todos los cambios al staging area: git add .

Nota: El punto "." representa todos los archivos modificados en el directorio actual.

2. Realizar un commit con el mensaje "Initial commit": git commit -m "Initial commit"

Nota: `-m` indica que se está proporcionando el mensaje del commit. "Initial commit" es el mensaje descriptivo del commit.


Sección 4: MySQL
1. **Pregunta de Código:**
- Escribe una consulta SQL para crear una base de datos llamada company y una tabla llamada employees con las siguientes columnas: id (INT, auto-increment, primary key), name (VARCHAR(100)), position (VARCHAR(50)), salary (DECIMAL(10, 2)), y hire_date (DATE).

CREATE DATABASE company;
USE company;
CREATE TABLE employees (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  position VARCHAR(50) NOT NULL,
  salary DECIMAL(10, 2) NOT NULL,
  hire_date DATE NOT NULL
);

2. **Pregunta Teórica:**
- Explica la diferencia entre una clave primaria (Primary Key) y una clave foránea (Foreign Key) en MySQL. ¿Cuándo y por qué se utilizan?

Clave Primaria (Primary Key): Una clave primaria es una columna o conjunto de columnas que identifican de forma única cada fila en una tabla.
Propósito: Garantiza la integridad de los datos al asegurar que no haya dos filas con el mismo valor en la clave primaria.
Características: Debe ser única para cada fila. * No puede tener valores nulos (NULL). * Normalmente se define como `AUTO_INCREMENT` para que los valores se generen automáticamente.
Ejemplo: En una tabla de "empleados", la columna "id" podría ser la clave primaria, ya que cada empleado tiene un ID único. 

Clave Foránea (Foreign Key): Una clave foránea es una columna o conjunto de columnas en una tabla que referencia la clave primaria de otra tabla.
Propósito: Crea una relación entre dos tablas, asegurando la integridad referencial. En otras palabras, garantiza que los valores de la clave foránea en una tabla coincidan con los valores de la clave primaria en la tabla relacionada.
Características: Debe hacer referencia a la clave primaria de otra tabla. Puede tener valores nulos (NULL) si la relación permite valores nulos. 
Ejemplo: En una tabla de "pedidos", la columna "id_cliente" podría ser una clave foránea que hace referencia a la columna "id" de la tabla "clientes". Esto asegura que cada pedido esté asociado a un cliente válido. 

Básicamente la clave primaria identifica de forma única cada fila dentro de una tabla, mientras que la clave foránea crea una relación entre dos tablas, asegurando la integridad referencial.

Cuándo y por qué usarlas: 
La clave primaria se utiliza en cada tabla para identificar de forma única cada fila. Es esencial para la integridad de los datos y para realizar operaciones como buscar, actualizar o eliminar filas. La  clave foránea se utiliza para establecer relaciones entre diferentes tablas. Esto permite:
* Mantener la integridad referencial: Los datos en las tablas relacionadas permanecen consistentes.
* Mejorar la organización y la gestión de datos: Facilita la unión de información de diferentes tablas para obtener informes o consultas complejas.
* Evitar errores de datos: Se evita la introducción de datos inválidos en las tablas relacionadas.

3. **Pregunta de Código:**
- Escribe una consulta SQL para insertar tres registros en la tabla employees creada en la pregunta 2.

INSERT INTO employees (name, position, salary, hire_date) VALUES
  ('Nane La O', 'Software Engineer', 60000.00, '2023-01-15'),
  ('Alex Rubio', 'Project Manager', 75000.00, '2022-05-20'),
  ('Dylan Rubio', 'Data Analyst', 55000.00, '2023-03-08');

4. **Pregunta de Código:**
- Muestra cómo actualizar el salario de un empleado específico en la tabla employees. Por ejemplo, actualiza el salario del empleado con id = 1 a 60000.00.

UPDATE employees SET salary = 60000.00 WHERE id = 1;

5. **Pregunta de Código:**
- Escribe una consulta SQL para seleccionar todos los empleados cuyo salario sea mayor a 50000.00 y ordenarlos por el campo hire_date en orden descendente.

SELECT * FROM employees WHERE salary > 50000.00 ORDER BY hire_date DESC;

6. **Pregunta Teórica:**
- ¿Qué es una transacción en MySQL y cómo se utiliza? Proporciona un ejemplo de uso.

Una transacción en MySQL es un conjunto de operaciones SQL que se ejecutan como una sola unidad lógica. Se utiliza para garantizar que todas las operaciones se completen con éxito o se reviertan si alguna falla. Por ejemplo, suponiendo que necesitas transferir dinero de una cuenta a otra en una base de datos bancaria. Podrías usar una transacción para asegurarte de que se retire el dinero de una cuenta solo si se puede depositar en la otra cuenta sin errores. Esto garantiza la integridad de los datos y evita situaciones donde el dinero queda en un estado inconsistente entre las dos cuentas.

7. **Pregunta de Código:**
- Crea una vista en MySQL llamada high_earning_employees que seleccione todas las columnas de los empleados cuyo salario sea mayor a 70000.00.

CREATE VIEW high_earning_employees AS SELECT * FROM employees 
WHERE salary > 70000.00;



