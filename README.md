# 🛠️ Backend — Módulo de Gestión de Clientes (Laravel 12 + Sanctum)
Este backend implementa una API RESTful protegida con Laravel Sanctum, diseñada para ser consumida desde un frontend desacoplado (SPA). Permite realizar autenticación y CRUD completo de clientes.

## 📌 Tecnologías
- Laravel 12
- Sanctum para autenticación
- MySQL
- API REST
- Validaciones integradas

## 🚀 Instalación
1. Clonar el repositorio:
   ```bash
   git clone <url-del-repo-backend>
   cd erp-back-end
   ```

2. Instalar dependencias:
   ```bash
   composer install
   ```

3. Copiar archivo `.env` y configurar:
   ```bash
   cp .env.example .env
   ```
   Asegurate de configurar estas variables:
   ```
   si usas ddev
   APP_URL=https://quantia-erp.ddev.site
   SESSION_DOMAIN=quantia-erp.ddev.site
   SANCTUM_STATEFUL_DOMAINS=localhost:5174
   DB_DATABASE=nombre_de_tu_bd
   DB_USERNAME=usuario
   DB_PASSWORD=contraseña
   ```

4. Ejecutar migraciones:
   ```bash
   php artisan migrate
   ```

5. Iniciar servidor:
   ```bash
   php artisan serve
   ```

## 🔐 Autenticación
   crear tu usario desde la base o con tinker
- **Login**: `POST /login`  
  Cuerpo JSON: `{ "email": "", "password": "" }`
- **Logout**: `POST /logout`  
  Requiere token en header `Authorization: Bearer <token>`

## 🧩 Endpoints de Cliente
- `GET /clientes` — Listar todos
- `POST /clientes` — Crear
- `PUT /clientes/{id}` — Actualizar
- `DELETE /clientes/{id}` — Eliminar

## 📁 Estructura relevante
```
routes/web.php         # Todas las rutas API
app/Http/Controllers/  # Controladores de Auth y Cliente
app/Models/Cliente.php # Modelo Cliente
```

## ✅ Validaciones
- `nombre`: requerido
- `email`: requerido y válido
- `NIT`: requerido y único
