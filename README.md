```markdown
# StockMaster - Prodeo Hotel + Lounge

<p align="center">
  <img src="./public/assets/img/prodeoHotel_logo.png" width="300" alt="Prodeo Hotel Logo">
</p>

## 🚀 Project Overview

**StockMaster** is a specialized Inventory Management System (IMS) designed for **Prodeo Hotel + Lounge**. This Full Stack application allows staff to manage hotel supplies, track stock movements via AJAX, and monitor critical inventory levels in real-time. The project follows the **MVC architecture** and implements secure authentication, role-based access control, and **Soft Deletes**.

---

## 🛠️ Tech Stack

### Backend & Logic

* **PHP (OOP)**: Core server-side logic using Object-Oriented Programming.
* **CodeIgniter 3**: Professional MVC framework for structured development.
* **MySQLi**: Relational database management with optimized indexing.
* **Bcrypt**: Secure password hashing for user authentication.

### Frontend & UX

* **Bootstrap 5**: Responsive design and professional UI components.
* **AJAX / JavaScript**: Asynchronous stock management and dynamic row deletion.
* **SweetAlert2**: Elegant and interactive modal alerts for system notifications.
* **FontAwesome 6**: Comprehensive icon set for improved visual navigation.

---

## ⚙️ Installation & Setup

### 1. Database Configuration

* Ensure you have **MySQL** installed and running (via XAMPP).
* Execute the SQL script located at `/database/ProdeoHotel_StockMaster_Schema.sql` to create the `prodeo` database, all necessary tables, and seed initial data.

### 2. Local Server Setup (Apache)

To run this project correctly, you must point your local server to the `/public` folder:

1. Open your Apache configuration file (`httpd.conf`) from XAMPP.
2. Update the `DocumentRoot` and `<Directory>` to point to your local project path:
   ```apache
   DocumentRoot "[YOUR_LOCAL_PATH]/public"
   <Directory "[YOUR_LOCAL_PATH]/public">
   ```
3. (Optional) Change `Listen 80` to `Listen 8080` if you have port conflicts.
4. Restart Apache and access the app at: `http://localhost:8080/` (or your configured port).

---

## 🔑 Demo Credentials

To access the administrative features and manage the inventory, use the following default account:

* **Email:** `admin@prodeohotel.com`
* **Password:** `admin123`

---

---

## 🚀 Resumen del Proyecto

**StockMaster** es un Sistema de Gestión de Inventarios (SGI) especializado para **Prodeo Hotel + Lounge**. Esta aplicación Full Stack permite al personal gestionar suministros, realizar un seguimiento de los movimientos de stock mediante AJAX y monitorear niveles críticos en tiempo real. El proyecto sigue la **arquitectura MVC** e implementa autenticación segura, control de acceso basado en roles y **Borrado Lógico (Soft Deletes)**.

## 🛠️ Tecnologías Utilizadas

### Backend

* **PHP (POO)**: Lógica principal del servidor mediante Programación Orientada a Objetos.
* **CodeIgniter 3**: Framework MVC profesional para un desarrollo estructurado.
* **MySQLi**: Gestión de base de datos relacional con indexación optimizada.
* **Bcrypt**: Encriptación de contraseñas para seguridad.

### Frontend

* **Bootstrap 5**: Diseño responsivo y componentes de interfaz profesional.
* **AJAX / JavaScript**: Gestión de stock asíncrona y eliminación dinámica de filas.
* **SweetAlert2**: Alertas interactivas para notificaciones del sistema.
* **FontAwesome 6**: Set de iconos para una mejor navegación visual.

## ⚙️ Instalación y Configuración

### 1. Configuración de la Base de Datos

* Ejecute el script SQL ubicado en `/database/ProdeoHotel_StockMaster_Schema.sql` para crear el esquema, las tablas y los datos iniciales.

### 2. Configuración del Servidor Local (Apache)

1. Abrir el archivo `httpd.conf` de XAMPP.
2. Configurar el `DocumentRoot` y el `<Directory>` para que apunten a la carpeta `/public` del proyecto.
3. Reiniciar Apache y acceder en `http://localhost:8080/`.

## 🔑 Credenciales de Prueba

Para probar las funciones de gestión de inventario:

* **Email:** `admin@prodeohotel.com`
* **Password:** `admin123`
```