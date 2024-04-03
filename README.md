ce-backend-app

using repository patern
## create interface
php artisan make:interface /Interfaces/ProductRepositoryInterface

## create repository
php artisan make:class /Repositories/ProductRepository

## create service provider
php artisan make:provider RepositoryServiceProvider

## create response
php artisan make:class /Classes/ApiResponseClass