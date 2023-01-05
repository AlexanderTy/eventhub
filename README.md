# 1260 Event tool

System for CRUD operations pertaining to management of event data.  


## Tech Stack

- Laravel 9.*
- TailwindCSS 3.*
- Inertia
- Vue.js 3.*

## Installation

- Download/clone project and publish to a new repository
- Setup `.env` based on `.env.example`
- Run `php artisan migrate:fresh --seed` to setup database and seed with test data
- A user will be created with email "test@gmail.com" and password "12345"
- 

## Available commands

- Create own user with an email, password, first name and last name with the command `php artisan create:user {--email=} {--password=} {--first_name=} {--last_name=} {--role=}`
