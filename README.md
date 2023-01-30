[1:34 PM] César Javier Maldonado Flores

## Requisitos

* APACHE
* MYSQK
* PHP 7.3 o superior
* [Composer] (https://getcomposer.org/)

## Precondiciones
Este proyecto esta desarrollado utilizando Laravel versión 8.54.0. Esta versión de laravel utiliza la versión de PHP 7.3 o superior. Adicionalmente requiere los siguientes extensiones para funcionar adecuadamente:
* An OpenSSL extension for PHP
* A PDO extension for PHP
* Mbstring extension for PHP
* Tokenizer extension for PHP
* XML extension for PHP

Para instalar este proyecto primero se debe clonar el repositorio en la raíz web de APACHE. Para clonar este repositorio puedes usar el comando:

~~~
git clone https://github.com/kroces/ece-saas.git
~~~

## librerías
Para las librerías es se recomienda utilizar el gestor de dependencias para PHP llamado composer. https://getcomposer.org/
Este gestor de dependencias permite la instalación de las librerías de forma automática.
Para descargar las dependencias se requiere utilizar el siguiente comando:

~~~
composer install
~~~

## Herramientas, configuración
Para que la aplicación funcione correctamente es necesario copiar el archivo .env.example y seguir las instrucciones ahí descritas.
Una vez copiado y configurado según las instrucciones del archivo ejecutar el siguiente comando:

~~~
php artisan key:generate
~~~

## BD generados del proyecto
Para generar la estructura de la base de datos se debe utilizar el siguiente comando:

~~~
php artisan migrate
~~~

El comando anteriormente descrito generará la estructura de la base de datos.
Adicionalmente para generar usuarios y llenar los catálogos utilizados por el sistema se debe ejecutar el siguiente comando:

~~~
php artisan db:seed
~~~

## Ejemplo de ejecución
Página de inicio.

![Página de inicio.](/readmeimg/home.png)

Autentícate en la página de inicio de sesión.

![Página de inicio.](/readmeimg/login.png)

Página de inicio del médico.

![Página de inicio.](/readmeimg/inicio.png)

Selección de Tenant (Solo en caso de 2 o más tenants para el médico).

![Página de inicio.](/readmeimg/selecttenant.png)

Puedes registrar pacientes.

![Página de inicio.](/readmeimg/patientreg.png)

Puedes registrar consultas de los pacientes.

![Página de inicio.](/readmeimg/consultreg.png)

Puedes consultar expedientes clínicos del paciente al MISECE (https://misece.link/).

![Página de inicio.](/readmeimg/consultamisece.png)

Composer
A Dependency Manager for PHP
https://getcomposer.org/