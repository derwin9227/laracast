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

    use HasFactory;

    public function category(){
        //hasOne, hasMany, belongsTo, belongsToMany
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
