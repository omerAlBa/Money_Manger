<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name','status','budget_id','kind_of','visible'];

    public function budgets(){
        return $this->hasMany('App\Models\Budget');
    }
}
