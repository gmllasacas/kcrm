# Inventario

Inventario con el CRUD de un producto y una venta básica.

## Instalación

### Ambiente de desarrollo

#### Base de datos

- Crear una base de datos MySQL con collation utf8mb4_general_ci
- Usar el script ubicado en <proyecto>/scripts/kcrm.sql

#### Configuración de la aplicación

- En el archivo de la ruta <proyecto>/application/config/development/database.php configurar los datos de coneccion a la base de datos

```php
$db['default']['hostname'] = '';
$db['default']['username'] = '';
$db['default']['password'] = '';
$db['default']['database'] = '';
```
### Dependencias

- Las dependencias son manejadas por composer, para ello se ejecuta:

```bash
composer update
```

## Uso

- Solo ingresar al index del proyecto: https://localhost/<proyecto>/
