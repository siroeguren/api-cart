# Siroko Api Carrito

<!-- TOC -->

* [Siroko Api Carrito](#siroko-api-carrito)
    * [1. Instalación de Symfony desde cero](#1-instalación-de-symfony-desde-cero)
        * [Install php 8.1 via :](#install-php-81-via-)
        * [Install Docker Engine](#install-docker-engine)
    * [2. Dependencias utilizadas](#2-dependencias-utilizadas)
    * [3. Configuracion framework](#3-configuracion-framework)
        * [3.1 Configuracion docker](#31-configuracion-docker)

    * [4. Estructura de proyecto](#4-estructura-de-proyecto)
    * [5. Clases y Doctrine.](#5-clases-y-doctrine)
        * [5.1 Ejemplo de mapeo con doctrine de la entidad User.](#51-ejemplo-de-mapeo-con-doctrine-de-la-entidad-user)
    * [6. Funcionamiento API.](#6-funcionamiento-api)
    * [7. Test Unitarios](#7-test-unitarios)
        * [7.1 Ejemplo de testeo de una clase :](#71-ejemplo-de-testeo-de-una-clase-)
        * [7.2 Ejemplo de testeo de un caso de uso.](#72-ejemplo-de-testeo-de-un-caso-de-uso)

<!-- TOC -->

## 1. Instalación de Symfony desde cero

### Install php 8.1 via :

`sudo apt update` <br>
`sudo apt install php`

### Install Docker Engine

#### For ubuntu :

https://docs.docker.com/engine/install/ubuntu/

#### For Windows :

https://docs.docker.com/desktop/install/windows-install/

#### For MacOS :

https://docs.docker.com/desktop/install/mac-install/

### Create symfony proyect via :

`composer create-project symfony/skeleton:"6.2.*" my_project_directory`

`cd my_project_directory`

`composer require webapp`

`composer create-project symfony/skeleton:"6.2.*" my_project_directory`

#### **Si estas utilizando un proyecto ajeno, utiliza**

`composer install` Para instalar las dependencias del proyecto desde el composer.json file.

## 2. Dependencias utilizadas

### Doctrine :

###### Doctrine es una biblioteca de mapeo objeto-relacional (ORM) para PHP que proporciona una forma fácil de interactuar con bases de datos relacionales utilizando objetos. Doctrine es un proyecto de código abierto y es ampliamente utilizado en el desarrollo de aplicaciones PHP modernas.

### Symfony Apache Pack :

###### Symfony Apache Pack es un conjunto de archivos de configuración y scripts que facilitan la ejecución de aplicaciones Symfony en servidores web Apache. Incluye un archivo de configuración de host virtual Apache, un archivo .htaccess y un archivo de configuración PHP FPM.

### Doctrine Messenger :

###### Doctrine Messenger es un componente del framework Symfony que proporciona una implementación del patrón de cola de mensajes utilizando Doctrine, un popular mapeador objeto-relacional para PHP.

###### El objetivo principal de Doctrine Messenger es permitir el procesamiento asíncrono de mensajes en las aplicaciones Symfony. Permite definir manejadores de mensajes que reciben mensajes de una cola, los procesan y envían los resultados al remitente. Esto puede ser útil para tareas de larga duración o que consumen muchos recursos y que se pueden realizar en segundo plano, sin bloquear la aplicación principal.

### SQL :

## 3. Configuracion framework

### 3.1 Configuracion docker

##### Crea un dockerfile con el siguiente contenido :

```dockerfile
FROM php:8.1-apache
RUN docker-php-ext-install pdo_mysql
RUN a2enmod rewrite
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"
RUN apt-get update && apt-get install -y unzip
RUN docker-php-ext-install pdo_mysql
RUN composer require symfony/apache-pack
RUN composer require --dev symfony/phpunit-bridge
RUN composer require --dev phpunit/phpunit
COPY ./docker/000-default.conf /etc/apache2/sites-available/000-default.conf
WORKDIR /var/www/html
```

#### Esto instalara algunas de las dependencias mencionadas anteriormente, aunque no todas, tambien copia el archivo 000-default.conf al contenedor docker cuyo contenido es :

```apacheconf
<VirtualHost *:80>
ServerAdmin webmaster@localhost
DocumentRoot /var/www/html/public
# ServerName siroko.local
ErrorLog ${APACHE_LOG_DIR}/error.log
CustomLog ${APACHE_LOG_DIR}/access.log combined

<Directory /app/public>
# DirectoryIndex index.php
Options All
AllowOverride All
Require all granted
</Directory>
</VirtualHost>
```

#### Tambien deberemos definir un docker.compose.yaml :

```dockerfile
version: '3'
services:
  php:
  build: ./
  ports:
  - "80:80"
  volumes:
    - ./:/var/www/html/
    - ./docker/:/etc/apache2/sites-available/
  working_dir: /var/www/html/

database:
image: 'mysql:latest'
environment:
MYSQL_USER: siro
MYSQL_PASSWORD: pass
MYSQL_ROOT_USER: root
MYSQL_ROOT_PASSWORD: root
MYSQL_DATABASE: cart-api-db
ports:
  # To allow the host machine to access the ports below, modify the lines below.
  # For example, to allow the host to connect to port 3306 on the container, you would change
  # "3306" to "3306:3306". Where the first port is exposed to the host and the second is the container port.
  # See https://docs.docker.com/compose/compose-file/compose-file-v3/#ports for more information.
  - '3306:3306'
```

### Tras haber definido los archivos mencionados y cambiado los credenciales del docker-compose.yaml :

`docker-compose up -d --build`

### Correr el siguiente comando en la terminal del contenedor docker :

`composer install`

## 4. Estructura de proyecto

<img align="right" src = "readme_rsc/general_structure.png"/>

La estructura de una aplicación Symfony es flexible, pero se recomienda la siguiente:

* app/ La configuración de la aplicación, plantillas y traducciones
* bin/ Archivos ejecutables (por ejemplo: bin/console)
* src/ El código PHP del proyecto
* tests/ Tests automáticos (por ejemplo: Unit tests)
* var/ Archivos generados (cache, logs, etc)
* _vendor/ _Dependencias de terceros
* web/ El directorio web raíz

## En el caso de este proyecto hemos utilizado arquitectura hexagonal y DDD lo que quiere decir que esta dividido en capas:

* ##### Capa de infraestructura: esta capa es responsable de la implementación de las diferentes tecnologías y herramientas que se utilizan en el proyecto, como la base de datos, la conexión de red, los servidores, etc. En este caso, como se trata de una API, la capa de infraestructura estará compuesta por la implementación de los servidores web, las bibliotecas y herramientas necesarias para comunicarse con otros sistemas y servicios, y cualquier otra herramienta necesaria para que la API funcione correctamente. Además, esta capa se encarga de proporcionar la configuración necesaria para que la aplicación se ejecute de manera eficiente en un entorno de producción.
* ##### Capa de aplicación: esta capa es la que contiene toda la lógica de negocio del proyecto. En el contexto de una API, esta capa se encargará de recibir las peticiones de los clientes, procesarlas y enviar la respuesta adecuada. Además, aquí se definirán las diferentes entidades del dominio, los casos de uso y las interfaces de los repositorios necesarios para acceder a los datos de la aplicación. En esta capa también se implementará el patrón de diseño Command, que es utilizado para separar la lógica de negocio de la lógica de transporte.
* ##### Capa de dominio: esta capa es la que contiene las entidades y la lógica de negocio que se utiliza en la aplicación. Esta capa es independiente de cualquier tecnología o herramienta específica y está diseñada para ser lo más reutilizable posible. Aquí se definen las reglas de negocio y se implementan los algoritmos necesarios para el correcto funcionamiento de la aplicación. Además, en el contexto de DDD, esta capa se encargará de la definición de los agregados y las raíces de agregados, que son los elementos clave del dominio.

###### En el contexto de Domain-Driven Design (DDD), un Bounded Context se refiere a una parte del modelo de dominio que tiene una semántica bien definida y limitada dentro del límite de un subdominio. Cada Bounded Context tiene su propio lenguaje y modelo que se utiliza para describir los conceptos y las reglas de negocio específicas de ese contexto.

###### Un Bounded Context se utiliza para definir los límites entre los diferentes subdominios y para ayudar a mantener una separación clara entre las diferentes áreas del modelo de dominio. Esto permite que el modelo de dominio se mantenga modular y fácil de entender, y ayuda a evitar conflictos y confusiones entre las diferentes partes del modelo.

###### Aplicaremos estas divison en capas a nuestros dos Bounded Context, Shop Y Cart .

## 5. Clases y Doctrine.

#### El ORM de Doctrine permite a los desarrolladores trabajar con objetos en lugar de con consultas SQL directamente, lo que simplifica el proceso de interacción con la base de datos y reduce la cantidad de código necesario para realizar operaciones CRUD.

#### Para que Doctrine pueda mapear correctamente los objetos de la aplicación a las tablas de la base de datos, se utiliza la técnica de Doctrine Mapping. Esta técnica permite definir una correspondencia entre los campos de una entidad (clase de objeto) y los campos de una tabla en la base de datos.

##### Hay diferentes maneras de mapear entidades en doctrine, como por ejemplo anotaciones y XML, en este caso utilizaremos XML ya que deja el codigo de la clase mas limpio aunque ambas son totalmente validas

## 5.1 Ejemplo de mapeo con doctrine de la entidad User.

<img src="readme_rsc/mapping_structure.png"> <br><br>



User.orm.xml

```xml
<?xml version="1.0" encoding="UTF-8"?>
<doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
                  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                  xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping
https://www.doctrine-project.org/schemas/orm/doctrine-mapping.xsd">
    <entity name="App\Shop\Domain\User\User" table="`user`"
            repository-class="App\Shop\Infrastructure\Repository\UserRepository">
        <id name="id" type="integer">
            <generator strategy="AUTO"/>
        </id>
        <field name="name" type="string" length="255"/>
        <embedded name="email" class="App\Shop\Domain\User\EmailVO" use-column-prefix="false"/>
        <embedded name="password" class="App\Shop\Domain\User\PasswordVO" use-column-prefix="false"/>
    </entity>
</doctrine-mapping>
```

EmailVO.orm.xml

```xml
<?xml version="1.0" encoding="UTF-8"?>
<doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
                  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                  xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping https://www.doctrine-project.org/schemas/orm/doctrine-mapping.xsd">

    <embeddable name="App\Shop\Domain\User\EmailVO">
        <field name="address" column="address" type="string"/>
    </embeddable>
</doctrine-mapping>
```

PasswordVO.orm.xml

```xml
<?xml version="1.0" encoding="UTF-8"?>
<doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
                  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                  xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping https://www.doctrine-project.org/schemas/orm/doctrine-mapping.xsd">

    <embeddable name="App\Shop\Domain\User\PasswordVO">
        <field name="password" column="password" type="string"/>
    </embeddable>

</doctrine-mapping>
```

### Fichero doctrine.yaml, cabe destacar que cada directiva de este fichero corresponde al mapeo de una carpeta, y no de un fichero unico, la INDENTACION tambien es clave.

```yaml
orm:
  auto_generate_proxy_classes: true
  enable_lazy_ghost_objects: true
  naming_strategy: doctrine.orm.naming_strategy.underscore_number_aware
  auto_mapping: true
  mappings:
    App\src\Shop\Domain\Cart:
      is_bundle: false
      type: xml
      dir: '%kernel.project_dir%/src/Shop/Infrastructure/Persistance/Doctrine/Mapping/Cart'
      prefix: 'App\Shop\Domain\Cart'
    App\src\Shop\Domain\Product:
      is_bundle: false
      type: xml
      dir: '%kernel.project_dir%/src/Shop/Infrastructure/Persistance/Doctrine/Mapping/Product'
      prefix: 'App\Shop\Domain\Product'
    App\src\Shop\Domain\User:
      is_bundle: false
      type: xml
      dir: '%kernel.project_dir%/src/Shop/Infrastructure/Persistance/Doctrine/Mapping/User'
      prefix: 'App\Shop\Domain\User'
    App\src\Shop\Domain\Product\PriceVO:
      is_bundle: false
      type: xml
      dir: '%kernel.project_dir%/src/Shop/Infrastructure/Persistance/Doctrine/Mapping/Product/PriceVO'
      prefix: 'App\Shop\Domain\Product\PriceVO'
```

#### Despues de configurar las clases y los mapeos, utilizar comando `php bin/console make:migration` y

`bin/console doctrine:migrations:migrate` para realizar las migraciones y construir la base de datos

## 6. Funcionamiento API.

###### La api recibe peticiones de tipo POST, DELETE,Y GET :

* Añadir producto al carrito
* Borrar carrito
* Borrar producto de un carrito
* Añadir producto

### En primer lugar, la peticion llega al controlador correspondiente :

* ##### En este caso los parametros son introducidos al metodo mediante la request, pero tambien pueden ir en el body de la request en otro controlador

```php
#[Route('/addToCart', name: 'addToCart', methods: ['POST'])]
public function addProductToCart(Request $request): Response
{

        try {
            $idUser = $request->request->get('idUser');
            $idProduct = $request->request->get('idProduct');
            $quantity = $request->request->get('quantity');

            $command = new AddProductToCartCommand($idProduct, 1, $idUser);
            $this->handler->dispatchCommand($command);

            return new Response('Articulo agregado correctamente, ');
        } catch (CartExceptions $e) {
            return new Response('Error al agregar articulo, ');
        }
    }
```

### Se crea un objeto de tipo command que almacena los datos necesarios para el caso de uso( El objeto de tipo command no es mas que un objeto creado a mano que tiene como atributos los parametros necesarios para llevar a cabo el caso de uso )

```php
class AddProductToCartCommand
{
  public function __construct
  (
    private readonly int $productID,
    private readonly int $count,
    private readonly int $userID
  )
   {}
```

### + Getters y setters necesarios

### En la carpeta Shared se encuentra, debajo de Application/Symfony :

* #### Un CommandHandlerInterface
* #### Un QueryHandlerInterface

### Ambas clases totalmente vacias (utilizadas respetar Hexagonal DDD)

```php
$command = new AddProductToCartCommand($idProduct, 1, $idUser);
$this->handler->dispatchCommand($command);
```

### El metodo dispatchCommand es llamado mediante la interfaz mencionada :

```php
public function dispatchCommand($event): array
{
  return $this->dispatch($event, $this->commandBus);
}
```

###### Con la configuracion que hicimos con symfony messenger este metodo sabra que CommandHandler tiene que utilizar para ejecutar ese Command. Puesto que nuestros CommandHandlers extienden la interfaz vacia, configurada para todo lo que haga instancia de ella sepa manejarse con el ComnmandBus o QueryBus.

#### Fichero de configuracion services.yaml

```yaml
services:
  # default configuration for services in *this* file
  _defaults:
  autowire: true      # Automatically injects dependencies in your services.
  autoconfigure: true # Automatically registers your services as commands, event subscribers, etc.
  _instanceof:
    # all services implementing the CommandHandlerInterface
    # will be registered on the command.bus bus
    App\Shared\Application\Symfony\CommandHandlerInterface:
      tags:
        - { name: messenger.message_handler, bus: command.bus }

        # while those implementing QueryHandlerInterface will be
        # registered on the query.bus bus
    App\Shared\Application\Symfony\QueryHandlerInterface:
      tags:
        - { name: messenger.message_handler, bus: query.bus }
```

## 7. Test Unitarios

#### La estructura de los test unitarios no es necesario que sea identica a la de nuestras clases a testear en el proyecto, pero si recomendable (supongo) , de manera que replicaremos la estructura de las clases de nuestro proyecto, creando un Clase Test por cada clase y caso de uso a testear:

<img src = "readme_rsc/tests_structure.png"/>

## 7.1 Ejemplo de testeo de una clase :

```php
class CartTest extends TestCase
{
private Cart $sut;
private User|MockObject $mockedUser;

    protected function setUp(): void
    {
        $this->mockedUser = $this->createMock(User::class);

        $this->sut = new Cart($this->mockedUser);
    }

    /**
     * @test
     * shouldGetProperUser
     * @group cart
     */
    public function shouldGetProperUser()
    {
        $this->assertInstanceOf(User::class, $this->sut->getUser());
    }

    /**
     * @test
     * shouldSetProperUser
     * @group cart
     */
    public function shouldSetProperUser()
    {
        $userMocked2 = $this->createConfiguredMock(User::class,
            [
                'getName' => 'TestUsername',
                'getEmail' => $this->createConfiguredMock(EmailVO::class,
                    [
                        'getAddress' => 'testemail@email.com'
                    ]),
                'getPassword' => $this->createConfiguredMock(PasswordVO::class,
                    [
                        'getPassword' => 'Pass2Test'
                    ]),
            ]);

        $this->sut->setUser($userMocked2);
        $this->assertSame($userMocked2, $this->sut->getUser());
    }
}
```

#### En este Test nos encargamos de probar la funcionalidad de los metodos de la clase Cart, comprobando que ambos metodos devuelvan tanto una instancia de la clase cart, como que seteen de manera correcta este usuario.

## 7.2 Ejemplo de testeo de un caso de uso.

```php
<?php

namespace App\Tests\Shop\Application\Command;

use App\Shop\Application\Command\DeleteCartCommand;
use App\Shop\Application\Command\DeleteCartCommandHandler;
use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartInterface;
use App\Shop\Domain\CartExceptions\CartExceptions;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DeleteCartCommandHandlerTest extends TestCase
{
    private DeleteCartCommandHandler $sut;

    private CartInterface|MockObject $cartInterface;

    protected function setUp(): void
    {
        $this->cartInterface = $this->createConfiguredMock(CartInterface::class,
            [
                'findCartByID' => $this->createMock(Cart::class)
            ]);
        $this->sut = new DeleteCartCommandHandler($this->cartInterface);
    }

    /**
     * @test
     * shouldDeleteCart
     * @group delete_cart
     */
    public function shouldDeleteCart()
    {
        $this->expectNotToPerformAssertions();
        $command = $this->createConfiguredMock(DeleteCartCommand::class,
            [
                'getCartID' => 1
            ]);
        $this->sut->__invoke($command);
    }

    /**
     * @test
     * shouldGiveCartNotFoundException
     * @group delete_cart
     */
    public function shouldGiveCartNotFoundException()
    {
        $this->expectException(CartExceptions::class);
        $cartInterface = $this->createMock(CartInterface::class);
        $newSut = new DeleteCartCommandHandler($cartInterface);
        $newSut->__invoke($this->createMock(DeleteCartCommand::class));
    }

}
```

### En este Test probamos el caso de uso deleteCart, en este caso el metodo __invoke() es void, por lo que no tiene return, para testear metodos de este tipo se utiliza

`$this->expectNotToPerformAssertions();`

### Para ejecutar todos los test a la vez utiliza :

`vendor/bin/phpunit`

### Para ejecutar tests de una sola clase es necesario definir un grupo de esta manera encima de la funcion a ejecutar

```php

/**
* @test
* shouldGiveCartNotFoundException
* @group delete_cart
*/
public function shouldGiveCartNotFoundException()
{
  $this->expectException(CartExceptions::class);
  $cartInterface = $this->createMock(CartInterface::class);
  $newSut = new DeleteCartCommandHandler($cartInterface);
  $newSut->__invoke($this->createMock(DeleteCartCommand::class));
}
```

##### Esto nos indica que el grupo al que pertenece este test, y otros que queramos asignar de la misma manera es delete_cart

`vendor/bin/phpunit --group delete_cart`
