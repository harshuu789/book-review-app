<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Book Review App

## Features
-User authentication (login/register)
-Add, edit, and delete book reviews
-Star ratings (1 to 5) and average ratings for books
-Responsive design using Tailwind CSS
-Reviews sorting by rating (highest to lowest or vice versa)
-Reviews are linked with users (each review belongs to a user)
-Authentication is handled using Laravel's built-in features

## Setup Instructions
1. Clone the repo
2. Run composer install
3. Run npm install && npm run dev
4. Create .env and set DB details
5. Run php artisan migrate --seed
6. Run php artisan serve (Also you can Run composer run dev)
