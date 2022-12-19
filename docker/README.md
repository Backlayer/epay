## Docker para Desarrollo

La configuracion del docker contiene los siguientes servicios:

- `App`: aplicacion php, contenedor: `epay-app`, version PHP 8.1.0-fpm
- `DB`: base de datos mysql, contenedor: `epay-db`, version MySQL 8.0.19
- `PhpMyadmin`: ui web para manejo de base datos mysql, contenedor: `epay-phpmyadmin`, version Latest
- `Nginx`: servidor web, contenedor: `epay-nginx`, version Alpine

`IMPORTANTE:` se debe crear el archivo `.env` a partir de `.env.example` y colocar los key correspondientes.

## Comandos Docker

Todos los comandos se deben ejecutar dentro del directorio `./script`.

```bash
# Construccion de imagen docker
composer run-script docker-build
```

```bash
# Levantar servicios docker
composer run-script docker-up
```

```bash
# Instalar paquetes composer del proyecto
composer run-script docker-install
```

## URLs para acceso a servicios

Los puertos para el acceso a los servicios web se pueden configurar en el archivo `.env`, las urls por defecto son:

- `App`: http://localhost:8000
- `PhpMyadmin`: http://localhost:5080


