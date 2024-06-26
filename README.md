# laravel-skeleton

Laravel 9.x skeleton for fun development

## Features

- JWT using with PHPOpenSourceSaver
- Todo/Task List Crud example

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

Migrations Results

![alt text](docs/images/migration-result.png)


### JWT

Get hash Jwt fo environment config

```bash

php artisan jwt:secret

# Results
# jwt-auth secret [<<get your hash>>] set successfully.
# place on .env file

JWT_SECRET=<<get your hash>>

```


## Testing

![alt text](docs/images/example-request.png)


```bash

# Register

curl --request POST \
  --url http://localhost:8000/api/auth/register \
  --header 'Accept: application/json' \
  --data '{
	"username": "rmm",
	"first_name": "Ricardo",
	"last_name": "Martins",
	"email": "test@email.com",
	"password": "YourP@ssw0rd!",
	"password_confirmation": "YourP@ssw0rd!"
}'


# Authenticate

curl --request POST \
  --url http://localhost:8000/api/auth/login \
  --header 'Accept: application/json' \
  --data '{
	"email": "test@email.com",
	"password": "YourP@ssw0rd!"
}'

# Logout

curl --request POST \
  --url http://localhost:8000/api/auth/logout \
  --header 'Accept: application/json' \
  --header 'Authorization: Bearer <Paste hash here>'


# TASKS

# Create

curl --request POST \
  --url http://localhost:8000/api/tasks \
  --header 'Accept: application/json' \
  --header 'Authorization: Bearer <Paste hash here>' \
  --data '{
	"name":"Nome bacana de tarefa para resolver logo",
	"description": "descricao mais mió di bão",
	"status": "pendente"
}'

# List

curl --request GET \
  --url http://localhost:8000/api/tasks \
  --header 'Accept: application/json' \
  --header 'Authorization: Bearer <Paste hash here>'


# Read

curl --request GET \
  --url http://localhost:8000/api/tasks/1 \
  --header 'Accept: application/json' \
  --header 'Authorization: Bearer <Paste hash here>'


# Update

curl --request PUT \
  --url http://localhost:8000/api/tasks/1 \
  --header 'Accept: application/json' \
  --header 'Authorization: Bearer  <Paste hash here>' \
  --data '{
	"name":"Novo título",
	"description": "Nova descrição para testes",
	"status": "finalizado"
}'


# Delete

curl --request DELETE \
  --url http://localhost:8000/api/tasks/1 \
  --header 'Accept: application/json' \
  --header 'Authorization: Bearer  <Paste hash here>'



```


## License
Yes ... its free here.

with fun and ❤️ por Ricardo Melo Martins.