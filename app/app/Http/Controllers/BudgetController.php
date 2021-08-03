<?php

namespace App\Http\Controllers;
use App\Models\Categorie;

use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Budget_Categories;

class BudgetController extends Controller
{

    public function __construct(){
        $this->middleware('auth')->except(['index']);
    }

    private function getId()
    {
        preg_match_all('/([0-9]+)/', $_SERVER["PATH_INFO"], $matches, PREG_SET_ORDER, 0);
        $id = $matches[0][0];
        $budget = Budget::find($id);
        return $budget;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budget = Budget::all();
        return view('budget.index')
            ->with(['budgets' => $budget]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorie = Categorie::all();
        return view('budget.create')
            ->with(['categories' => $categorie]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'categorie' => 'required',
            'betrag' => 'required'
        ]);

        //insert in DB
        $result = new Budget([
                'price' => $request['betrag'],
                'notiz' => $request['notiz'],
                'categorie_id' => $request['categorie'],
                'user_id' => auth()->id(),
                
        ]);
        $result->save();

        //Budget_Categories::update_Categorie($result->id, (int)$request['categorie']);

        return redirect('/Budget')
        ->with([
            'meldung_success' => 'Lege bitte für deinen Hobby <b>' . $result->name . '</b> die gewünschten Tags!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function show(Budget $budget)
    {
        //hole dir alle Tags
        $allCategorie = Categorie::all();

        //hole dir verwendete Tags, die Hobby verwendet.
        $usedCategorie = $budget->categories;

        //offene Tags
        //$avaibleTags = $allTags->diff($usedTags);

        $msg = Session::get('meldung_success');

        return view('budget.show')->with([
            "budget" => $budget,
            'allCategorie' => $allCategorie,
            'meldung_success' => $msg
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        if(auth()->guest()){
            abort(403);
        }

        $budget = $this->getId();

        abort_unless($budget->user_id === auth()->id, 403);
        
        $categorie = Categorie::all()->where('visible', '=', 1);
        return view('budget.edit')->with(['budget' => $budget,'categories' => $categorie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Budget $budget)
    {
        $request->validate([
            'categorie' => 'required',
            'price' => 'required',
            'date' => 'required|date'
        ]);

        //update to DB
        $budget = $this->getId();
        $budget->update([
            'price' => $request['price'],
            'date' => $request['date'],
            'notiz' => $request['notiz'],
            'categorie_id' => $request['categorie']
        ]);

        //Budget_Categories::update_Categorie($budget->id, (int)$request['categorie']);

        return $this->index()->with([
                "meldung_success" => "Bruder du hast es geschafft, du hast ein bestehends Hobby editiert! ( " . $request['name'] . " )"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        if(auth()->guest()){
            abort(403);
        }

        $budget = $this->getId();
        
        abort_unless(Gate::allows('forceDelete', $budget), 403);

        $budget->delete();
        //Budget_Categories::delete_Categorie($budget->id, (int)$request['categorie']);
        return $this->index()->with([
            "meldung_success" => "Kauf wurde gelöscht"
        ]);
    }
}
