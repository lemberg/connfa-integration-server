# Connfa Integration Server

Connfa Integration Server is developed on [Laravel framework](http://laravel.com/) by [Lemberg Solutions Ltd.](http://lemberg.co.uk) for managing conference's events, speakers, etc.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

Documentation for Connfa Integration Server API can be found [here](http://connfa.com/api/).

## Installation

- clone repo
- run ```composer install``` to download all dependencies
- copy and rename ```.env.example``` file to ```.env``` and configure domains and database connections.
- run ```php artisan migrate``` to create database structure
- if you want to seed fake data into your database run ```php artisan db:seed```

## API Testing

- To run API tests you need to create ```.env.testing``` and put there configuration for testing environment.
- API tests are written on [codeception library](https://github.com/Codeception/Codeception)
- To run tests you need to run ```./vendor/bin/codecept run api``` command

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
