# Project Setup Instructions

Follow these steps to set up and run the project:

1. Install dependencies using Composer:
    ```
    composer install
    ```

2. Copy the `.env.example` file and rename it to `.env`:
    ```
    cp .env.example .env
    ```

3. Generate an application key:
    ```
    php artisan key:generate
    ```

4. Run migrations and seed the database:
    ```
    php artisan migrate --seed
    ```
5. Run Storage link
    ```
    php artisan storage:link
    ```
5. Write in .env
    ```
    FILESYSTEM_DISK = public
    ```
6. Install sanctum
    ```
    php artisan install:api
    ```
    or
    ```
    composer require laravel/sanctum
    ```
7. Publish the sanctum configuration
    ```
    php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

    ```
8. Run migration again
    ```
    php artisan migrate
    ```

9. Start the development server:
    ```
    php artisan serve
    ```

Now you're ready to start working on the project!
