<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Proyecto Web - Broers
## Descripción

Este es un sistema web desarrollado con Laravel e Inertia.js que permite la gestión de usuarios con validación de identidad, control de accesos y trazabilidad de comunicaciones. Además, cuenta con una interfaz moderna y responsiva utilizando Tailwind CSS.

## Características principales
- Autenticación de usuarios con validación de correo y contraseña.
- Gestión de usuarios, incluyendo edición de información y cambio de estado.
- Interfaz moderna con iconos centrados y diseño responsivo.


## Tecnologías utilizadas
- Laravel (Backend y API REST)
- Inertia.js (Conexión entre Laravel y Vue.js)
- Vue.js 3 (Frontend interactivo)
- Tailwind CSS (Diseño moderno y responsivo)
- MySQL (Base de datos relacional)

# Instalación y configuración

## 1. Clonar el repositorio
```bash
git clone https://github.com/jasminfonck/broers
cd broers
````
## 2. Configurar el entorno
```bash
cp .env.example .env
````
Edita el archivo .env y ajusta las credenciales de la base de datos.
## 3. Instalar dependencias
```bash
composer install
npm install
````
## 5. Ejecutar migraciones y seeders
```bash
php artisan migrate --seed
````
## 6. Iniciar el servidor
```bash
php artisan serve
````
## 7. Compilar assets
```bash
npm run build
````

Si estás en desarrollo, usa:
```bash
npm run dev
````

# Uso

- Accede al sistema a través de http://localhost:8000
- Inicia sesión con un usuario registrado
- Administra usuarios, consulta registros y gestiona accesos
