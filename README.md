# 🍽️ Cafetería UPDS

**Sistema de Pedidos Digitales para Cafetería Universitaria**

Una plataforma web que optimiza la experiencia de pedidos en la cafetería universitaria, reduciendo filas y tiempos de espera mientras mejora la gestión de inventario y la satisfacción estudiantil.

## 📋 Tabla de Contenidos

* [Visión del Proyecto](#-visión-del-proyecto)
* [Características Principales](#-características-principales)
* [Tecnologías](#-tecnologías)
* [Instalación](#-instalación)
* [Configuración de Git y Flujo de Trabajo](#-configuración-de-git-y-flujo-de-trabajo)
* [Uso](#-uso)
* [Equipo de Desarrollo](#-equipo-de-desarrollo)
* [Metodología](#-metodología)
* [Licencia](#-licencia)

---

## 🎯 Visión del Proyecto

**Transformar la experiencia gastronómica universitaria** mediante una plataforma digital que permite a los estudiantes:

* Visualizar el menú en tiempo real
* Realizar pedidos anticipados
* Evitar filas y optimizar su tiempo
* Recibir notificaciones de estado de pedido

---

## ✨ Características Principales

### Para Estudiantes

* 📱 **Catálogo Digital**: Menú diario con disponibilidad en tiempo real
* 🛒 **Sistema de Pedidos**: Crear pedidos personalizados
* ⏰ **Programación de Pedidos**: Pedidos hasta 2 horas en adelante
* 💳 **Pagos Seguros**: Confirmación inmediata
* 📊 **Seguimiento en Tiempo Real**: Estado del pedido
* 🔔 **Notificaciones**: Alertas cuando el pedido está listo

### Para Personal de Cafetería

* 🏠 **Dashboard de Cocina**: Pedidos pendientes por prioridad
* 📈 **Gestión de Inventario**: Disponibilidad de productos en tiempo real
* 📊 **Analytics**: Productos populares y tiempos de preparación
* ⚡ **Optimización de Flujo**: Reducir tiempos de espera

---

## 🛠️ Tecnologías

* **Backend:** PHP 8.1+, Laravel, MySQL
* **Frontend:** Blade, Tailwind CSS, JavaScript
* **Herramientas:** Git, Laragon, Laravel Migrations, Seeders

---

## 🚀 Instalación

### Prerequisitos

* PHP 8.1+
* Composer
* Laragon o XAMPP/WAMP
* Git

### Pasos

1. Clonar el repositorio:

```bash
git clone https://github.com/AlinaUC/Cafeteria_UPDS.git
cd Cafeteria_UPDS
```

2. Instalar dependencias:

```bash
composer install
npm install
npm run build
```

3. Configurar variables de entorno:

```bash
cp .env.example .env
php artisan key:generate
```

Editar `.env` con la base de datos, correo y Google OAuth.

4. Ejecutar migraciones y seeders:

```bash
php artisan migrate --seed
```

5. Iniciar servidor de desarrollo:

```bash
php artisan serve
```

La aplicación estará disponible en `http://localhost:8000`.

---

## 🔗 Configuración de Git y Flujo de Trabajo

### Clonar el repositorio

```bash
git clone https://github.com/AlinaUC/Cafeteria_UPDS.git
cd Cafeteria_UPDS
```

### Crear y cambiar a su rama

```bash
git checkout -b feature/nombre-de-su-rama
```

**Ramas sugeridas:**

* Frontend Camila: `feature/frontend-camila`
* Backend Josué: `feature/backend-josue`
* UX/Testing Carlos: `feature/ux-testing-carlos`
* Database Daher: `feature/database-daher`
* DevOps Aarón: `feature/devops-aaron`

### Subir cambios

```bash
git add .
git commit -m "Descripción de cambios"
git push origin feature/nombre-de-su-rama
```

### Pull Request

1. Subir la rama a GitHub
2. Crear Pull Request hacia `main`
3. Otro miembro revisa y aprueba antes de mergear

### Mantener su rama actualizada

```bash
git checkout main
git pull origin main
git checkout feature/nombre-de-su-rama
git rebase main
```

* Resolver conflictos si los hay:

```bash
git add .
git rebase --continue
```

---

## 📖 Uso

### Usuarios de Prueba

* **Administrador:** [admin@cafeteriaupds.com](mailto:admin@cafeteriaupds.com) / admin2024
* **Cocina:** [cocina@cafeteriaupds.com](mailto:cocina@cafeteriaupds.com) / cocina2024
* **Estudiante:** [luciana@upds.edu.bo](mailto:luciana@upds.edu.bo) / student2024
* **Estudiante:** [camila@upds.edu.bo](mailto:camila@upds.edu.bo) / student2024

### Flujo Principal

1. Registro/Login
2. Explorar Menú
3. Crear Pedido
4. Programar/Pagar
5. Seguimiento
6. Recoger

---

## 👥 Equipo de Desarrollo

* **Product Owner:** Rosalia Lopez
* **Scrum Master:** Luciana Zapana

**Development Team:**

* Frontend: Camila, Luciana
* Backend: Josué, Aarón
* UX/UI & Testing: Carlos
* Database: Daher

---

## 📊 Metodología

* Scrum Framework: Sprints de 4 semanas, daily stand-ups, review y retrospective
* Definition of Done: Código revisado, pruebas unitarias, funcionalidad probada, documentación actualizada

---

## 📄 Licencia

MIT - ver [LICENSE](LICENSE)






Hola chicos, buenas noches! 🌙

El repositorio del proyecto **Cafetería UPDS** ya está listo en GitHub:
[https://github.com/AlinaUC/Cafeteria\_UPDS](https://github.com/AlinaUC/Cafeteria_UPDS)

Para empezar a trabajar:

1️⃣ **Clonar el repo**

```bash
git clone https://github.com/AlinaUC/Cafeteria_UPDS.git
cd Cafeteria_UPDS
```

2️⃣ **Cambiar a tu rama** (cada uno tiene la suya)

```bash
git checkout feature/nombre-de-tu-rama
```

3️⃣ **Instalar dependencias y configurar**

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run dev
php artisan serve
```

4️⃣ **Trabajar en tu rama** y hacer cambios en el código.

5️⃣ **Subir tus cambios al repo**

```bash
git add .
git commit -m "Breve descripción de lo que hiciste"
git push origin nombre-de-tu-rama
```

6️⃣ Cuando termines una funcionalidad, **abrir un pull request** hacia `main` en GitHub para que revisemos y lo integremos. 🚀

Cualquier duda, me escriben por aquí 😊
