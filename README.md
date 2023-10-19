# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/lumen-framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/lumen-framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/lumen)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

> **Note:** In the years since releasing Lumen, PHP has made a variety of wonderful performance improvements. For this reason, along with the availability of [Laravel Octane](https://laravel.com/docs/octane), we no longer recommend that you begin new projects with Lumen. Instead, we recommend always beginning new projects with [Laravel](https://laravel.com).

## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

## Contributing

Thank you for considering contributing to Lumen! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


## RUN PROJECT
## STEP 1: 
    clone the project: git clone https://github.com/carlosjuniorsp/pastelaria.git
## STEP 2:
    Go to the project root folder
## STEP 3:
    run the command in the terminal: docker-compose up -d
## STEP 4:
    run the command in the terminal: docker-compose exec app bash
## STEP 5: 
    Inside the container, run the command: composer install
## STEP 6:
    Inside the container, run the command: php artisan migrate
## STEP 7: 
     Inside the container, run the command: php -r "echo md5(uniqid()).\"\n\";"
## STEP 8:
   Run the exit command to "exit" the container terminal
## STEP 9:
    run the command in the terminal: docker-compose up -d
## STEP 10:
    copy the hash: example: 7142720170cef01171fd4af26ef17c93 (do not use this hash)
## STEP 11:
    Open the .env file and paste your hask into API_KEY
## STEP 12: 
    Test your application: 
    Postman or Thunder Client extension Vscode
        http://localhost:8989/
    ## Routers Client:
        GET: /api/clients
        GET: /api/clients/{id}
        POST: /api/clientes
        PUT: /api/clientes/{id}
        DELETE: /api/clientes/{id}
     ## Routers Products:
        GET: /api/products
        GET: /api/products/{id}
        POST: /api/products
        PUT: /api/products/{id}
        DELETE: /api/products/{id}
    ## Routers Orders:
        GET: /api/orders
        GET: /api/orders/{id}
        POST: /api/orders
        PUT: /api/orders/{id}
        DELETE: /api/orders/{id}
    
        
    
