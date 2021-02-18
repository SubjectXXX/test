# Technologies

* PHP 8
* MySql 8
* Redis 6
* Lumen 8

# Prerequisities / Requirements

You have to have installed/configured :

* [Docker] (https://www.docker.com/)

Page URL: http://0.0.0.0:8080

API docs: http://0.0.0.0:8080/api/documentation


# Project First Run

### .env file
```
cp .env.example .env
```

### Composer install
```
docker run --rm \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install
```

## Windows WSL2 only
<details>
  <summary>Click to expand!</summary>

1. `vendor/bin/sail up --build`
2. (open new terminal instance)
3. `docker exec -it specto /bin/bash`
4. `rm -rf vendor`
5. `composer install`
6. `composer require devgowa/lumen-serve --dev`
7. `Ctrl + D` to exit
</details>

### Docker Up
```
vendor/bin/sail up --build
```


### Executing artisan commands
```
vendor/bin/sail artisan ...
```

### Executing PHP commands
```
vendor/bin/sail php
```

### Executing Composer Commands
```
vendor/bin/sail composer ...
```

### Clear cache
```
vendor/bin/sail artisan cache:clear
```

### Regenerate DB with dummy data
```
vendor/bin/sail artisan dbdata
```


# TEST
You can use whatever you want to successfully complete the tasks below

Code structure should be written by PSR2 standards

## Create APIs

GET: (all records)

api/posts
<hr />

GET: (get specific one)

api/posts/{id}

## OpenApi (Swagger)

Write OpenApi annotations so we have documented APIs

http://0.0.0.0:8080/api/documentation

### Example
```
@OA\Get(
    path="/api/posts",
    operationId="getAll",
```

## Cache DB queries

Use Redis to cache DB queries for x minutes


## Tests

Write simple tests to test APIs above (test successful response)

```
vendor/bin/sail phpunit
```
