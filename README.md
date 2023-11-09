<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Getting Started

Run the following command:

```bash
# Install all the dependencies using composer
composer install

# Copy the example env file and make the required configuration changes in the .env file
cp .env.example .env

# Generate a new application key
php artisan key:generate

# Run the database migrations (Set the database connection in .env before migrating)
php artisan migrate

# Run the database seeder and you're done
php artisan db:seed

# Run the laravel development server
php artisan serve
```

Add the following key to your env:

```bash
APP_FE=
X_API_KEY=
```