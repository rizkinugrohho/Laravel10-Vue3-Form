# Laravel 10 + Vue 3

Coding Challenge built with Laravel, Vue.js and Alpine.js. <br>

## Demo
https://github.com/rizkinugrohho/Laravel10-Vue3-Form/assets/36374356/04d2b97e-3b07-47d7-9f1a-2aae4832afd3

## Installation

Make sure you have environment setup properly. You will need MySQL, PHP8.1, Node.js and composer.

### Install Laravel Website + API

1. Download the project (or clone using GIT)
2. Go to the Laravel directory `cd laravel10-api` folder
3. Copy `.env.example` into `.env` and configure database credentials
4. Navigate to the project's root directory using terminal
5. Run `composer install`
6. Set the encryption key by executing `php artisan key:generate --ansi`
7. Run migrations `php artisan migrate --seed`
8. Start local server by executing `php artisan serve`
9. Open new terminal and navigate to the project root directory

### Install Vue.js

1. Navigate to `cd vue3-frontend` folder
2. Run `npm install`
3. Make sure `baseURL` key in `src/api/index.js` is set to your Laravel API host (Default: http://localhost:8000)
4. Run `npm run dev`
5. Open Vue.js (Default: http://localhost:5173)
