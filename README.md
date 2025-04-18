# 🗂️ Stegnonfiles

**Stegnonfiles** es un clon minimalista del servicio AnonFiles, desarrollado con Laravel. Permite subir archivos de forma anónima, protegidos opcionalmente con contraseña, y descargarlos mediante una URL única. Los archivos se almacenan cifrados de forma segura en el servidor.

## 🚀 Funcionalidades principales

- ✅ Subida anónima de archivos.
- 🔐 Encriptación AES-256 de todos los archivos.
- 🔑 Opción de protección mediante contraseña (doble cifrado).
- 🔗 Generación de URL única para descarga.
- 🌐 Soporte multilenguaje (español, inglés, catalán).
- 📱 Interfaz responsive con tema oscuro (Bootstrap 5).

## 🛠️ Panel de administración (Filament)

El proyecto incluye un **panel administrativo completo con [Filament Admin Panel](https://filamentphp.com)** para gestionar los archivos subidos:

- 📂 Visualización de archivos en una tabla con filtros y acciones.
- 🗑️ Eliminación individual o masiva con borrado físico desde `storage`.
- 🧩 Ampliable con más recursos, roles y funcionalidades.

Para acceder al panel:

```bash
php artisan serve
```

Y luego visita:

```
http://localhost:8000/admin
```

> ⚠️ Recuerda crear un usuario para acceder al panel si aún no lo has hecho.

## 🌍 Idiomas soportados

El sistema soporta múltiples idiomas con selección desde la interfaz:

- 🇪🇸 Español (`es`)
- 🇬🇧 Inglés (`en`)
- 🏴 Català (`ca`)

## 🎨 Tema visual

Utiliza **Bootstrap 5** con un diseño oscuro minimalista por defecto, optimizado para móviles.

## 🧑‍💻 Requisitos técnicos

- PHP 8.1+
- Laravel 10+
- Composer
- Node.js & NPM (para assets, opcional si usas el build ya generado)
- SQLite o MySQL para persistencia

## 📄 Licencia

Este proyecto está licenciado bajo la **MIT License**.