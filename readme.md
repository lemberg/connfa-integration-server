# Connfa Integration Server

Connfa Integration Server is developed on [Laravel framework](http://laravel.com/) by [Lemberg Solutions Ltd.](http://lemberg.co.uk) for managing conference's events, speakers, etc.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

Documentation for Connfa Integration Server API can be found [here](http://connfa.com/api/).

## Installation

- clone repo
- run <code>composer install</code> to download all dependencies
- copy and rename <code>.env.example</code> file to <code>.env</code> and configure domains and database connections.
- run <code>php artisan migrate</code> to create database structure
- if you want to seed fake data into your database run <code>php artisan db:seed</code>

## API Testing

- To run API tests you need to create <code>.env.testing</code> and put there configuration for testing environment.
- API tests are written on [codeception library](https://github.com/Codeception/Codeception)
- To run tests you need to run <code>./vendor/bin/codecept run api</code> command

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
