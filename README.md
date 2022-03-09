# 10webtask (Laravel framework)

## Installation
* Copy .env.example file to .env on the root folder. 
* Run composer install
* Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
*  Run php artisan key:generate
*  Run php artisan migrate
*  Run php artisan serve



# Importing 10 latest posts with CLI
### Removed old post and  fills the data latest 10 posts
Run php artisan techcrunch:import
