# what is an API?
# Types of APIs (RESTful, GraphQL, SOTP, etc)
# Creating Laravel Project
# API testing tool- POSTMAN
# Error Handling



# Authentication and Security
# step 1: Install passport
    1. composer require laravel/passport
    2. add in require object of composer.json: "laravel/passport": "^10.0" and then run "composer update"

# step 2: Install Auth
    composer require laravel/ui (OR) composer require laravel/ui "^2.0"
    php artisan ui vue --auth

# step 3: Setup Passport
    php artisan migrate
    php artisan passport:install

# step 4: Configure Passport
    Passport::routes();

# step 5: Use the HasApiTokens trait - In User model;

# step 6: Auth configuration

# step 7: Add Middleware to routes

# step 8: Create Token & Access

 
