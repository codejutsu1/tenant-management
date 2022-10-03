# Tenant Management Software

This is a Laravel + VueJs application (Using InertiaJs) that helps house owners to manage their tenants, transactions and rooms.

## Installation

* Run `composer install` on your cmd or terminal to install composer and make sure you have php installed in your system.

* Navigate on the cmd, the folder path you want to store this project in and type the following code

```bash
#  clone this repository
$ git clone https://github.com/codejutsu1/tenant-management
```

* Open the project and create a file, `.env` on the root folder.

* Copy everything in `.env.example` and paste in the `.env` file.

* Open your `.env` file and change your database name (DB_DATABASE) from laravel to any name you want.

* By default, the username is root and you can leave the password empty. (For Xampp)

* Run the following code 

```bash
# To generate app key
$ php artisan key:generate

# To migrate the database
$ php artisan migrate 

# To seed data to the database 
$ php artisan db:seed

# To run the project on a server
$ php artisan serve
# It will run on localhost:8000 or 127.0.0.1:8000
```