<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

/*     protected $fillable = [
        'title',
        'category_id',
        'excerpt',
        'body',
        'slug'
    ]; */

    protected $guarded = [];

    protected $with = ['category', 'author'];

    use HasFactory;

    public function category(){
        //hasOne, hasMany, belongsTo, belongsToMany
        return $this->belongsTo(Category::class);
    }

    /* el nombre de la funcion es la variable
    que utilizara como llave foranea
    pero se puede pasar la llave foranea como argumento
    de la relacion, en este caso belongsTo
    para cambiar el nombre de la function
    sin ser afectado el funcionamiento */

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
