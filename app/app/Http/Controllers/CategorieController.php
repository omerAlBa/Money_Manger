<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Controller\Budget_Categorie;

class CategorieController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index']);
    }

    private function getId()
    {
        preg_match_all('/([0-9]+)/m', $_SERVER["PATH_INFO"], $matches, PREG_SET_ORDER, 0);
        $id = $matches[0][0];
        $categorie = Categorie::find($id);
        return $categorie;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorie = Categorie::all();
        return view('categorie.index')
            ->with(['categories' => $categorie]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorie.create');
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
            'name' => 'required|min:3',
            'kind_of' => 'required'
        ]);
        
        //insert in DB
        $result = new Categorie([
                'name' => $request['name'],
                'kind_of' => (int)$request['kind_of'],
                'visble' => 1,
                'share_able' => (int)$request['share_able'],
        ]);
        $result->save();

        return redirect('/Categorie/'.$result->id)
        ->with([
            'meldung_success' => 'Lege bitte für deinen Hobby <b>' . $result->name . '</b> die gewünschten Tags!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $categorie)
    {
        //hole dir alle Tags
        $allCategorie = Categorie::all();

        //hole dir verwendete Tags, die Hobby verwendet.
        $usedCategorie = $categorie->categories;

        //offene Tags
        //$avaibleTags = $allTags->diff($usedTags);

        $msg = Session::get('meldung_success');

        return view('categorie.show')->with([
            "categorie" => $categorie,
            'allCategorie' => $allCategorie,
            'meldung_success' => $msg
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $categorie = $this->getId();
        return view('categorie.edit')->with(['categorie' => $categorie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorie $categorie)
    {
        $request->validate([
            'name' => 'required|min:3',
            'kind_of' => 'required',
            'onoff' => 'required',
        ]);

        //update to DB
        $categorie = $this->getId();
        $categorie->update([
            'name' => $request['name'],
            'visible' => (int)$request['onoff'],
            'kind_of' => (int)$request['kind_of'],
        ]);

        return $this->index()->with([
                "meldung_success" => "Bruder du hast es geschafft, du hast ein bestehends Hobby editiert! ( " . $request['name'] . " )"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $categorie)
    {
        return $this->index()->with([
            "meldung_success" => "Kategorien sind nicht Löschbar!"
        ]);
    }
}
