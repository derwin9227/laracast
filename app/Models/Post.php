<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $with = ['category', 'author'];

    use HasFactory;

    public function scopeFilter($query, array $filters){

        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where(fn($query) =>
                $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('body', 'like', '%' . request('search') . '%')
                )
            );

        $query->when($filters['category'] ?? false, fn($query, $category) =>
        
            $query->whereHas('category', fn ($query) => 
                $query->where('slug', $category)
                )
            );

        $query->when($filters['author'] ?? false, fn($query, $author) =>
        
            $query->whereHas('author', fn ($query) => 
                $query->where('username', $author)
                )
            );

    }//filter

    public function comments(){
        return $this->hasMany(Comment::class);
    }

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
