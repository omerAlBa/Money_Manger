@extends('dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Erstelle einen neue Ausgabe</div>
                <div class="card-body">
                    <form action="/Budget" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Kategorie</label>
                            <select class="form-select" name="categorie" aria-label="Default select example">
                                <option>Open this select menu</option>
                                @foreach($categories as $categorie)
                                <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="betrag">Betrag</label>
                            <input class="form-control {{ $errors->has('betrag') ? 'border-danger' : '' }}" id="betrag" name="betrag" type="number" min="1" place-holder=0,00€></input>
                        </div>
                        <div class="form-group">
                            <label for="notiz">Notiz</label>
                            <textarea class="form-control {{ $errors->has('notiz') ? 'border-danger' : '' }}" id="notiz" name="notiz" rows="5"></textarea>
                        </div>
                        <input class="btn btn-primary mt-4" type="submit" value="absenden">
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
