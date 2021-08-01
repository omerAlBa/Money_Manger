<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    
    protected $fillable = ["kategorie","price","description","categorie_id","user_id",'notiz'];
    protected $table = 'budgets';

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function categorie(){
        return $this->belongsTo('App\Models\Categorie');
    }
}
