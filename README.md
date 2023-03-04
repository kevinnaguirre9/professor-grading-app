# 🎓 Professor Grading App

Professor grading is an application for grading/rating professors classes at Salesian Polytechnic University.

Built with the following technologies:

* [Lumen Microframework](https://lumen.laravel.com/)
* [Doctrine ODM](https://www.doctrine-project.org/projects/doctrine-mongodb-odm/en/2.3/index.html)

## Getting Started

### Environment variables

    cp .env.example .env

### Start dev containers

    docker-compose up

### Install dependencies

    composer install

##  Doctrine resources

The following commands will generate two json files with the paths where xml mappings an custom types are located so that the Doctrine ODM knows where to look for and register them.

    php artisan doctrine:xml-documents:search
    php artisan doctrine:custom-types:search

## Asynchronous tasks

By default, the application already start background processes for performing heavy processes in a asynchronous way, like importing data from Excel files. 

In development, if you want to listen to changes in lumen Job files, run:
    
    php artisan queue:listen database --timeout=300

## License
  
This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
