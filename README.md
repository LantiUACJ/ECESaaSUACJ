# ECESAAS
## Requisitos
Este proyecto está desarrollado utilizando Laravel versión 8.54.0. Esta versión de laravel utiliza la versión de PHP 8.0 o superior. Adicionalmente se requieren las siguientes extensiones para funcionar adecuadamente:

* A PDO extension for PHP
* Mbstring extension for PHP
* Tokenizer extension for PHP
* XML extension for PHP
* APACHE
* MYSQL
* PHP 8.0 o superior
* [Composer] (https://getcomposer.org/)
* Proveedor de correos, servidor SMTP o API de pruebas para envío de correos

## Instalación de pre-requisitos

### Windows
Para instalar los pre-requisitos en windows se puede descargar [Wamp server](https://www.wampserver.com). La instalación se realiza a través de un archivo de instalación. Con los parámetros por defecto la aplicación funciona correctamente. Las extensiones de php ya están habilitadas.

### Linux
Para la instalación de los pre-requisitos en linux se requieren los siguientes pasos:

1) Actualizar paquetes `sudo apt update`
2) Instalar apache2 `sudo apt install apache2`
   1) Si el servicio de apache no inicio automaticamente `sudo service apache2 start`
3) Instalar mysql `sudo apt install mysql-server`
   1) Si el servicio de mysql no inicio automaticamente `sudo service mysql start`
4) Configurar mysql `sudo mysql_secure_installation`
   1) Seguir el proceso guiado
5) Instalación de PHP, este proceso requiere de más pasos ya que se utiliza una versión de php 8.0
   1) `sudo apt install -y software-properties-common`
   2) `sudo add-apt-repository ppa:ondrej/php`
   3) `sudo apt update`
   4) `sudo apt install php8.0-cli php8.0-fpm php8.0-bcmath php8.0-curl php8.0-gd php8.0-intl php8.0-mbstring php8.0-mysql php8.0-opcache php8.0-sqlite3 php8.0-xml php8.0-zip`
   5) `sudo apt-get install php8.0-gmp`
   6) `sudo service apache2 restart`

Para la instalación de composer en linux se necesitan los siguientes pasos (se recomienda realizar estos pasos en una carpeta con permisos como la de `home`):
1) `php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"`
2) `php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"`
3) `php composer-setup.php`
4) `php -r "unlink('composer-setup.php');"`

### linux y windows

Entrar a la base de datos y generar al usuario del proyecto:

1) `CREATE USER 'ECESaaSUACJ'@'localhost' IDENTIFIED BY 'password';`
2) `CREATE DATABASE ecesaas;`
2) `CREATE DATABASE snomed;`
3) `GRANT ALL PRIVILEGES ON ecesaas.* TO 'ECESaaSUACJ'@'localhost';`
3) `GRANT ALL PRIVILEGES ON snomed.* TO 'ECESaaSUACJ'@'localhost';`
4) `FLUSH PRIVILEGES;`

## Instalación de la aplicación y Librerías

### Windows

Para realizar la instalación de la aplicación se deben seguir los siguientes pasos:
1) Extraer el contenido del zip en la carpeta publica del servidor:
   1) c:/wamp64/www/html/
2) Entrar a la carpeta del proyecto y abrir una terminal ahí
3) Instalar dependencias `composer install`
4) Copiar el archivo .env.example y renombrarlo a .env

### Linux

Para realizar la instalación de la aplicación se deben seguir los siguientes pasos:
1) Extraer el contenido del zip
   1) `sudo apt install unzip` en caso de no tener el software adecuado
   2) `mkdir ECESaaSUACJ`
   3) `unzip ECESaaSUACJ.zip -d ECESaaSUACJ/`
2) Entrar a la carpeta del proyecto `cd ECESaaSUACJ`
3) Instalar dependencias `composer install`
4) Subir un nivel `cd ..`
5) Mover la carpeta del proyecto a /var/www/html `sudo mv ECESaaSUACJ /var/www/html`
6) Entrar al proyecto `cd /var/www/html/ECESaaSUACJ/`
7) copiar .env `sudo cp .env.example .env`
8) Agregarle permisos al usuario `sudo chgrp -R www-data ECESaaSUACJ`
9) Modificar permisos a la carpeta `sudo chmod -R 775 ECESaaSUACJ/storage`
10) Ejecutar el siguiente comando `sudo php artisan key:generate`

## Configuración
### Configuración apache (linux)

Para configurar Apache se deben realizar los siguientes pasos:
1) ir a /etc/apache2/sites-available `cd /etc/apache2/sites-available`
2) Crear el archivo de configuración `sudo nano ECESaaS.conf`
3) Copiar el siguiente contenido en el archivo:

```
<VirtualHost *:80>
   ServerAdmin test@test.com
   DocumentRoot /var/www/html/ECESaaSUACJ/public

   <Directory /var/www/html/ECESaaSUACJ>
       AllowOverride All
   </Directory>
   ErrorLog ${APACHE_LOG_DIR}/error.log
   CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```
4) desactivar configuración original `sudo a2dissite 000-default.conf`
5) activar configuración nueva `sudo a2ensite laravel_project`
6) Habilitar el mod-rewrite `sudo a2enmod rewrite`
7) reiniciar apache `sudo service apache2 restart`

### Servicio de Google Cloud
El proyecto utiliza el servicio de Google Cloud “Speech-to-Text” para la parte de consulta. Para configurarlo es necesario crear una cuenta en la [consola de Google Cloud](https://console.cloud.google.com) y crear una cuenta de servicio la cual nos permita generar un una “clave” de tipo JSON en la cual está contenida la información necesario para llenar la información del archivo `.env` a partir de `#Google speech credentials`.

### Configuración variables de entorno (linux y windows)

Para realizar la configuración se debe abrir el archivo .env y modificar los parámetros del archivo

En la parte de la base de datos se deberá modificar la conexión a la base de datos: host, port, username, password
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecesaas
DB_USERNAME=root
DB_PASSWORD=
```
Una segunda base de datos es necesaria para una de las funciones de la aplicación. La base de datos de smomed. Esta base de datos se encuentra en un archivo llamado `MISECE-Procesamiento.sql` incluido en el .zip proporcionado en el directorio raíz de este proyecto a la base de datos creada anteriormente "snomed". Una vez se haya importado la base de datos se deben obtener el ip (127.0.0.1 en caso de local), nombre de la base de datos, usuario y contraseña.
```
DB_CONNECTION_SECOND=mysql
DB_HOST_SECOND=127.0.0.1
DB_PORT_SECOND=3306
DB_DATABASE_SECOND=snomed
DB_USERNAME_SECOND=root
DB_PASSWORD_SECOND=
```

Proveedor de correo electrónico, es necesario para funcionalidad del MISECE (recuperar contraseña)

```
# El sistema tiene función para recuperar contraseña por lo tanto se requiere utilizar un servidor de correos
# En caso de no contar con uno se puede utilizar mailtrap (https://mailtrap.io/)
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"
```
Las variables del `.env` referentes a google cloud deben ser llenadas siguiendo el archivo generado de clave después de crear una cuenta de servicio (revisar Configuración > Servicio de Google Cloud).
```
Gtype="service_account" #revisar el archivo JSON.
Gproject_id="id de proyecto" #revisar el archivo JSON.
Gprivate_key_id="id de llave" #revisar el archivo JSON.
Gprivate_key="llave de certificado" #revisar el archivo JSON.
Gclient_email="correo del servicio" #revisar el archivo JSON.
Gclient_id="id de cliente" #revisar el archivo JSON.
Gauth_uri="dirección de autenticación" #revisar el archivo JSON.
Gtoken_uri="dirección de token de autenticación" #revisar el archivo JSON.
Gauth_provider_x509_cert_url="dirección de certificado de autenticación" #revisar el archivo JSON. 
Gclient_x509_cert_url="dirección de certificado de autenticación" #revisar el archivo JSON.
```
Variables para comunicación con MISECE. Para llevar a cabo la autorización y comunicación de datos con el MISECE el ECESAAS necesita unos certificados los cuales son aportados por el MISECE (deben ser descargados del sistema MISECE).
```
#Certificado "CA" necesario para la comunicación con MISECE. Debe ser una dirección local (path) al archivo en el proyecto, debe incluir nombre y extensión del archivo (e.g. '/opt/apache2/ECESAAS/storage/app/certs/CA.crt')
CA_CERT="/opt/apache2/ECESaaS/certs/CA.crt"

#Llave privada del certificado "certificados.key" utilizado para la comunicación con MISECE. Al igual que CA debe ser una dirección local al archivo con nombre de archivo y extensión. 
KEY_CERT="/opt/apache2/ECESaaS/certs/certificados.key"

#Certificado público "certificados.crt" utilizado para la comunicación con MISECE. Al igual que CA debe ser una dirección local al archivo con nombre de archivo y extensión.
PUB_CERT="/opt/apache2/ECESaaS/certs/certificados.crt" 
```

## BD generados del proyecto (linux y windows)
Para generar la estructura de la base de datos se debe utilizar el siguiente comando:

`sudo php artisan migrate`

El comando anteriormente descrito generará la estructura de la base de datos.
Adicionalmente para generar usuarios y llenar los catálogos utilizados por el sistema se debe ejecutar el siguiente comando:

`sudo php artisan db:seed`