# laravel-skeleton

Laravel 9.x skeleton for fun development

## Features

- JWT using with PHPOpenSourceSaver

## Requirements

- PHP > 7.4
- Composer 2.x
- Database (Mysql, Postgres) 
- Docker > 18.06 (Optional)
    - For testing I using https://github.com/ricardo-melo-martins/docker
    

## Install

Cloning

```bash
git clone https://github.com/ricardo-melo-martins/laravel-skeleton.git
```

... enteing on laravel-skeleton dir

```bash
cd laravel-skeleton

composer install


# make it yours (optional)
rm -rf .git

```


## Configure

Copy example environment

```bash

cp ./.env.example .env

```

then change the configuration according to the database you want to use.

### Database

```bash

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=my_database
DB_USERNAME=root
DB_PASSWORD=YourP@ssw0rd!

```

Connection verify example...

```bash

php artisan migrate --pretend 

if connection ok run command

php artisan migrate

```

### JWT

Get hash Jwt fo environment config

```bash

php artisan jwt:secret

# Results
# jwt-auth secret [<<get your hash>>] set successfully.
# place on .env file

JWT_SECRET=<<get your hash>>

```


## License
Yes ... its free here.

with fun and ❤️ por Ricardo Melo Martins.