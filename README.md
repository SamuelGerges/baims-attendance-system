<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
## Quick Installation
    git clone git@github.com:SamuelGerges/baims-attendance-system.git
    cd SD_Project/

### installation
    git clone git@github.com:SamuelGerges/baims-attendance-system.git
    cd project
    cp .env.example .env
    

you may use docker compose or docker-compose based on the version you have
I'm using some ports, if the ports are allocated already at your machine 
please change them at docker-compose.yml

run docker
```
docker-compose build && docker-compose up -d
docker exec -it --user 1000  baims-attendance-system-php-1 bash
composer install 
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve --host=0.0.0.0 --port=8899
```

you may access the website at
```
http://localhost:8899/
```

### Postman
     file postman => Baims.postman_collection.json

### Usage Skills  in attendance Systems

    Repositry Design Pattern
    Adapter Design Pattern
    Service Provier
    Request Validation
    command line php artisann notify:work-hours to send work hours number to every user
    mailtrap to send email
    schedule to send email every month 01 through service
    feature and unit Testing


### About Task

The system should allow users to check in and check out multiple times per day,
calculate total hours worked when check-out

endpoints of api:
- sign up.
- sign in.
- check in.
- check out.
- get-total-hours-between-two-dates.
- CLI command that send email explain total-hours through month php artisan notify:work-hours.
- use schedule to send email every month.



