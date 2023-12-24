# Simple Showing Products Website [ Products - Products Ber Users type - Users ]

# preview

![Screenshot from 2023-08-14 02-49-10](https://github.com/keroles19/wthq-users-products/assets/36054945/6e645b7f-3dd4-4a5c-aeff-e3c1e6442770)


## BY

[![Laravel](https://img.shields.io/badge/-Laravel-white?style=flat-square&logo=laravel)](https://github.com/keroles19/)
[![mysql](https://img.shields.io/badge/-mysql-005C84?style=flat-square&logo=mysql&logoColor=white)](https://github.com/keroles19/)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white)](https://github.com/keroles19/)

# Requirments:

- PHP 8.1 or later.
- MySQL 5.7 or later.

## installation

after clone/ download the project file, `cd` into the project directory and follow the steps below:

- run `composer install` for download the required packages.
- if you don't see the `.env` file please do the following:
    - run `cp .env.example .env` to copy env file.
    - run `php artisan key:generate` to generate new app key.
- run `php artisan migrate` to run database migration.
- run `php artisan db:seed` to run database seeds.
- run `php artisan serve`   to run project.

### How Manly test using postman

- import `Wthq.postman_collection.json` file into postman.
- replace `{{BASE_URL}}` with your base url.
- run the collection.
- you're done!

### Credentials

- Admin : use the following credentials to login as admin to can add new products and users.
    - user_name: `admin`
    - password : `admin`

- User : use the following credentials to login as user to can show products ber types .
- user_name: `normal` or `silver` or `gold`
- password : `normal` or `silver` or `gold`

Or you can register new user.

```` 
 when user type is `normal` he can show active products that less that 100 .
 when user type is `silver` he can show active products between 100 , 200  .
 when user type is `gold` he can show active products more than 200 .

````

### NOTE

if you get any errors in this step, when seeding the database, realted to exsisting data, please run the following:

- run `chmod ugo=rwx storage -R` to give permissions to storage folder for read/wirte actions.
- run `chown www-data storage -R` for the same reason described above.
- run `php artisan optimize:clear` to reset setting to is last good case.

### NOTE 2

you can run the database commands all together like:
`php artisan migrate:fresh --seed` this will migrate and seed the database.

## Using docker

- install `docker` and `docker-compose`, for Linux [ubuntu] OS, you can user `docker-install.sh` file inside project
  folder, for windows and mac you can setup docker desktop
- run `docker-compose build app`
- run `docker-compose up -d`
- navigate to `127.0.0.1:8000`
- you're done!
