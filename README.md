# Laravel 9 Assessment Test
A Simple Laravel 9 Assessment Application Template For Your Development Needs.

## Installation

Clone the project.
```bash
git clone https://github.com/dayCod/rembon-technical-test.git
```

Open the project folder then, Install the Composer and Recognize the Composer Application Vendor.
```bash
composer install && composer dump-autoload
```

Copy the environment example file then, Generate the application key.
```bash
cp .env.example .env && php artisan key:generate
```

Because on this system Using iziToast and Laravel Passport You must to following these steps:

Install on Backside Vendor Assets, Remove existing iziToast Folder
```bash
cd public/backside/vendor/
git clone https://github.com/marcelodolza/iziToast.git
```

Install on Frontside Vendor Assets, Remove existing iziToast Folder
```bash
cd public/frontside/vendor/
git clone https://github.com/marcelodolza/iziToast.git
```

Install Laravel Passport Packages
```bash
composer require laravel/passport
```
If Error, Use these Commands
```bash
composer require laravel/passport --with-all-dependencies
```

After all the installation progress, Migrate and make database.
```bash
php artisan migrate --seed
```

Generate Client Passport Key
```bash
php artisan pssport:install
```


## System That Used On this Project
| PHP Version      | ^8.0.2 |
|------------------|--------|
| Database         | MySQL  |   
| Laravel Version  | 10     |

## Credits
- [Wirandra Alaya](https://github.com/dayCod)
- [Aang Wiadi](https://github.com/wiadiaang)
- [Rembon Karya Digital](https://github.com/rembon2016)

## Api Documentation
- [Postman Api Documentation](https://documenter.getpostman.com/view/19955217/2s9Y5bQgMz)



