# Tenant Management Software

This is a Laravel + VueJs application (Using InertiaJs) that helps house owners to manage their tenants, transactions and rooms.

## Prequisities

The things you need before installing the project

* PHP 8+

* [Composer](https://getcomposer.org) 

* [Xampp](https://apachefriends.org/download.html)

### Installation

* Run `composer install` on your cmd or terminal (to install composer) and make sure you have php installed in your system.

* Navigate on the cmd, the folder path you want to store this project in and type the following code

```bash
#  clone this repository
$ git clone https://github.com/codejutsu1/tenant-management.git
```

* Open the project and create a file, `.env` on the root folder.

* Copy everything in `.env.example` and paste in the `.env` file.

* Open your `.env` file and change your database name (DB_DATABASE) from laravel to any name you want.

* By default, the username is root and you can leave the password empty. (For Xampp)

* Then run the following code 

```bash
# To generate app key
$ php artisan key:generate

# To migrate the database
$ php artisan migrate 

# To seed data to the database 
$ php artisan db:seed

# To run the project on a server
$ php artisan serve
# It will run on localhost:8000 or 127.0.0.1:8000 on your web browser.
```

## Login Details

Each login details (a single login page) will redirect you to their respective dashboard.

### Landlord (Super Admin)

```bash
Email: admin@admin.com
Password: admin@admin
```

### Caretaker (Admin)

```bash
Email: care@caretaker.com
Password: care@caretaker
```

### Tenant (User)

```bash
Email: user@user.com
Password: user@user
```

## Functionalities of each role

### Landlord

* Create, read, update and delete tenants and caretakers.

* Confirm or Decline a transaction.

* View transaction history, receipts and legal document of each tenants.

* Update the tenant when rent has expired.

* View and edit occupants of a room.

* Edit the website settings.

### Caretaker

Same functionalities with the `Landlord` <b>except</b> 

* Create, read, update and delete caretakers.

* Edit the website settings.

### Tenant

* Make payment using [Paystack](https://paystack.com).

* View receipts of each transactions and legal document.

* View transaction history

* View all caretakers contact in the account detail's page.

* Edit personal information and able to choose a room after first payment.

## About the project

* Responsive in all devices.

* Make an online payment using [Paystack](https://paystack.com) for
    - Rent payment, which has a specific amount that can be edited by the admin.
    - Other payment with input field to key in amount of the tenant's choice. 

* Generate receipts after each payment using [laraveldaily invoice package](https://github.com/LaravelDaily/laravel-invoices).

* Generate legal document after the first payment in a docx format using [PHP WORD package](https://github.com/PHPOffice/PHPWord).

* Limiting tenant access to the `choose a room` page if already paid and has a room number, using `checkPayment middleware`.

* Set a cron job to check if each tenant's rent has expired and update it to the database.

* Able to send out email (using mailables).

* Wrote tests for the following 
    - Each role's authentication.
    - Each role's pages in the dashboard.  
    - Landlord and Caretaker functionalites
    
```bash
# To test the application
$ php artisan test
```