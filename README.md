<p align="center"><img src="logo-tribal-mnc.png" width="400"></p>

## Code Challenge 

This project is a Api that centralizes services, rest api and SOAP.
which returns direct and indirect matches with a specific term

Sources

```
Itunes
    songs
    movies
    e-books
tvmaze
    tv shows
country information
    currency
```


## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

The prerequisites are the same that laravel 7

```
PHP >= 7.4.1
BCMath PHP Extension
Ctype PHP Extension
Fileinfo PHP extension
JSON PHP Extension
Mbstring PHP Extension
OpenSSL PHP Extension
PDO PHP Extension
Tokenizer PHP Extension
XML PHP Extension
```

### Installing

Follow the steps to install the proyect:

Clone GitHub repo for this project locally
```
git clone https://github.com/mmmoises/tribal-guatemal.git
```

Access to proyect directory
```
cd tribal-guatemal
```

Install Composer Dependencies
```
composer install
```

Create a copy of your .env file
```
cp .env.example .env
```

Generate an app encryption key
```
php artisan key:generate
```

enable the server
```
php artisan serve
```

## Api documentation

* [documentation ](https://documenter.getpostman.com/view/12698509/TVRn3n4J) - postman documentation


## Built With

* [Laravel](https://laravel.com/) - The Backend framework used
## Authors

* **Moises Morales** - [CoffeeCups](https://github.com/mmmoises)
