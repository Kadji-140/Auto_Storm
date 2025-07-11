<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @mixin IdeHelperCategory
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'description',
        'is_active',
        'slug'
    ];
    
    protected  $casts=[
        'is_active'=>'boolean'
    ];
    // Relation : une categoriee a plusieur produits 1->n
    public function products(){
        return $this->hasMany(Product::class);
    }

    // Mutator: Generer automaiquement le slug depuis le nom
    public function setNameAttribute($value){
        $this->attributes['name']=$value;
        $this->attributes['slug']= Str::slug($value);
    }

    // Accessor: URL-friendly
    public function getRouteKeyName(){
        return 'slug'; // Utilise le slug au lieu de l'ID dans les URLs
    }
    
}
