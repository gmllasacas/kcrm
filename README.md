# Inventario

Inventario básico con PHP y MySQL, con las acciones de:

- CRUD de un producto
- Venta simple de un producto

## Instalación

### Base de datos

- MariaDB 10.4.x o MySQL 8.x	
- Crear una base de datos con collation utf8mb4_general_ci
- Usar el script ubicado en [proyecto]/scripts/kcrm.sql para importar las tablas

### Aplicación

- PHP 7.4.x
- Framework Codeigniter 3.x

#### Instalación

El software usa git para el manejo de versiones, para copiarlo localmente se ejecuta: 

```bash
git clone https://github.com/gmllasacas/kcrm.git
```

#### Configuración

En el archivo de la ruta [proyecto]/application/config/development/database.php se configuran los datos de coneccion a la base de datos, modifique las siguientes variables:

```php
$db['default']['hostname'] = '';
$db['default']['username'] = '';
$db['default']['password'] = '';
$db['default']['database'] = '';
```
#### Dependencias

Las dependencias son manejadas por composer, para ello se ejecuta:

```bash
composer update
```

## Uso

Solo ingresar al index del proyecto: https://localhost/[proyecto]/