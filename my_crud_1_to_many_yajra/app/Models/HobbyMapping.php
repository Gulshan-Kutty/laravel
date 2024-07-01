<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HobbyMapping extends Model
{
    use HasFactory;
    protected $table="product_hobbies_mapping";

    // In Laravel, the protected $table property in an Eloquent model is used to specify the database table associated with that model. In your case, $table="product_countries_mapping"; indicates that the CountryMapping model is associated with the product_countries_mapping table in your database.

    // When you define a model in Laravel, by default, Laravel assumes that the table name will be the plural form of the model name (e.g., CountryMapping model would look for a country_mappings table). However, if your table name doesn't follow this convention, you can specify the table name explicitly using the $table property.

    // So, in your example, by setting $table="product_countries_mapping";, you're telling Laravel to associate the CountryMapping model with the product_countries_mapping table instead of the default country_mappings table. This allows you to work with tables that don't follow Laravel's naming conventions.

    public function hobby()
    {
        return $this->hasOne('App\Models\Hobby','id','hobby_id'); // for one to many relation
    }
}
