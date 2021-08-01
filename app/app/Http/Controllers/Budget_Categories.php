<?php
// brauchst du nicht!
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;

class Budget_Categories extends Controller
{
    public static function update_Categorie($budget_id,$categorie_id){
        dump($categorie_id);
        $categorie = Categorie::find($categorie_id);
        $categorie->update([
            'budget_id' => $budget_id
        ]);
    }

    //delete_Categorie
    public function delete_Categorie($budget_id = null,$categorie_id){
        $categorie->update([
            'budget_id' => null
        ]);
    }
}
