# **Potential Project**

You need some tools installed on your computer in order to run the project.

## Requirements

- **[Docker](https://www.docker.com/get-started)**.
- **[Composer](https://getcomposer.org/download/)**.

## Instructions

- Clone the repository into a folder of your choice. </br>
`git clone https://github.com/barbozafernando/crud.git`

- Go to `crud/server` and run `composer install`. 
- When that finished, type `docker exec -it app-php sh` and then `php artisan migrate --seed`
- After that, leave the docker container and type `docker-compose up`
- Now go to `crud/client` and run `npm install`
- When that finished, you should type `docker-compose up`

That's it.
