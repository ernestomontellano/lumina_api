# Lúmina api
<br />
## Requisitos Previos
<br />
1. Instalar [NodeJS](https://nodejs.org/en/download/)
<br />
2. Instalar [Composer](https://getcomposer.org/download/)
<br />
3. Instalar [Laravel](https://laravel.com/docs/5.2#installing-laravel):
```
composer global require "laravel/installer"
```
<br />
## Clonar Repositorio
<br />
```
git clone https://github.com/ernestomontellano/lumina_api.git
```
<br />
## Instalación Inicial
<br />
1. Crear una base de datos en el **phpMyAdmin** de su servidor.
<br />
2. Renombrar el archivo `.env.example` a `.env`:
<br />
```
rename .env.example .env
```
<br />
3. Abrir el archivo y configurar los parámetros de conexión a la base de datos:
```
DB_DATABASE=nombrebd
DB_USERNAME=usuariobd
DB_PASSWORD=''
```
<br />
4. Generar la llave de encriptación para el proyecto:
<br />
```
php artisan key:generate
```
<br />
5. Instalar las dependencias de Composer:
<br />
```
composer install
```
<br />
7. Generar la llave de encriptación para los tokens de seguridad:
<br />
```
php artisan jwt:generate
```
<br />
## Generar Base de Datos
<br />
1. Crear estructura de tablas:
<br />
```
php artisan migrate
```
<br />
2. Popular tablas:
<br />
```
php artisan db:seed
```
<br />
## Iniciar Servidor
<br />
```
php artisan serve
```