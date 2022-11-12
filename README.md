# Monoma Technology Test

Pasos para poder correr el servidor

### Requisitos

-   PHP
-   Composer
-   Docker

#### Inicio

Debemos clonar este repositorio, para despues ubicarnos en la
carpeta raiz.

Ahora ejecutamos el siguente comando

`composer install --ignore-platform-req=ext-sodium`

_Esto instalara todas las dependencias del proyecto_

Ahora debemos usar Laravel Sail para gestinar los contenedores de Docker.
Primero debemos montar los contenedores.

` ./vendor/bin/sail up -d`

_Esto construira la imagen de Docker para montar los archivos del servidor_

**Ojo: Esta es la forma de correrlo en Linux**

Para windows

`.\vendor\bin\sail up -d`

Ahora debemos establecer las variables de configuracion para el correcto funcionamiento
del programa.
Estas ya estan prestablecidas en el archivo `.env.example` y solo debemos renombrarlo
como `.env`

`cp -rd .env.example .env`

Luego corremos las migraciones y los seeders

`./vendor/bin/sail artisan migrate:fresh --seed`

_Esto creara 4 usuarios con los dos tipos de rol que se manejan, dos con rol manager y dos con rol agent._

Ahora para asegurarnos de que todo salio bien, ejecutamos las pruebas de aceptacion

`./vendor/bin/sail artisan test`

Hasta aqui todo debe estar perfecto.
