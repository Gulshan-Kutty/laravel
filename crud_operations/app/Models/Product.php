<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
}


// In the context of Laravel, "models" and "Eloquent ORM" are closely related concepts but represent different aspects of database interaction within the framework:

//  1)  Models:
    
//     Models in Laravel are PHP classes that represent individual data entities in your application. Each model typically corresponds to a database table.
//     Models define properties that map to table columns, as well as methods for interacting with the data, defining relationships, and performing business logic.
//     Models encapsulate the behavior and structure of your application's data, making it easier to work with and manipulate within your code.
//     Models can include custom methods, accessors, mutators, and other logic specific to the data they represent.
//     Models can be used independently of Eloquent ORM, but in Laravel, they are often used in conjunction with Eloquent to simplify database operations.

//  2) Eloquent ORM:
    
//     Eloquent is Laravel's built-in ORM (Object-Relational Mapping) system, which provides a set of tools and conventions for interacting with databases using PHP.
//     Eloquent extends the basic model concept by providing a fluent query builder, relationship management, automatic timestamp handling, validation, events, and other features.
//     Eloquent ORM maps database tables to model classes and provides methods for performing CRUD operations on those models without needing to write raw SQL queries.
//     Eloquent simplifies database interactions by abstracting away much of the complexity associated with querying, updating, and deleting records, and managing relationships between them.
//     Eloquent integrates seamlessly with Laravel's other features, such as routing, controllers, views, and form validation, making it the preferred choice for database operations in Laravel applications.


// In summary, while "models" represent the data entities in your application and encapsulate their behavior and structure, "Eloquent ORM" is the specific implementation of object-relational mapping provided by Laravel, which extends the basic model concept with additional features and conventions for interacting with databases. Models can exist independently of Eloquent, but Eloquent provides a convenient and powerful way to work with models and databases within the Laravel framework