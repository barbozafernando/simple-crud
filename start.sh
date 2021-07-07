#!/bin/bash
echo "Starting installation..."

cd server

cp .env.example .env &&
docker-compose up -d &&
docker exec -t app-php sh -c "
    php artisan migrate:fresh --seed &&
    php artisan key:generate &&
"

echo "Server running at: http://localhost:8080/"

cd ../
cd client
npm install
docker-compose up

echo "Client running at: http://localhost:8081/"
read -p "Press any button to stop..."