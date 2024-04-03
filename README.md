ce-backend-app

using repository patern
## create interface
php artisan make:interface /Interfaces/ProductRepositoryInterface

## create repository
php artisan make:class /Repositories/ProductRepository

## create Service Provider
php artisan make:provider RepositoryServiceProvider