# Phalcon test #

## Build via Docker Compose ##

        cd docker
        docker-sompose up --build
        
## Vendors, migrations and seeding ##
        
        docker-compose exec fpm composer install
        docker-compose exec fpm vendor/bin/phinx migrate
        docker-compose exec mysql mysql -uroot -pdiufhv8743f8efdgvyfg7w89hfos -e"set global net_buffer_length=1000000; set global max_allowed_packet=1000000000;"
        docker-compose exec fpm vendor/bin/phinx seed:run -s RegionSeeder
        docker-compose exec fpm vendor/bin/phinx seed:run -s PeopleSeeder

## Host and API ##
        
        http://localhost:8081
        
        https://www.getpostman.com/collections/67a3ab7f53795af89156
