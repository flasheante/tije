# For the api I use Laravel 10
## Instalation


First You should create a new database called tije in your local database

Then add your local env configuration file with this:
```python
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tije
DB_USERNAME=username
DB_PASSWORD=password
```
Go to the root of the application and run in a terminal
You need the vendor folder to run

```bash
composer install

```
I create a migration of an only table products just for the evaluation purpose

```bash
php artisan migration

```
I create a seed for that

```bash
php artisan db:seed --class=ProductsTableSeeder

```

#Running

You should enter to the app with Postman with get :
```bash
GET /ApiRest/public/api/products

```
```bash
GET /ApiRest/public/api/products?supplierId=2

```
