# ⭐ Professor Grading App

Professor grading is an application for grading/rating professors classes at Salesian Polytechnic University

## First steps

### Environment variables

    cp .env.example .env

### Start dev containers

    docker-compose up

### Install dependencies

    composer install

### Asynchronous tasks

By default, the application already start background processes for asynchronous tasks. 
If you want to list to changes in lumen Job files, run:
    
    php artisan queue:listen

## License
  
This project is open-sourced software licensed unde the [MIT license](https://opensource.org/licenses/MIT).
