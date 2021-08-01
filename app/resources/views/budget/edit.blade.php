@extends('dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Deine Ausgaben!!</div>
                <div class="card-body">
                    <form action="/Budget/{{ $budget->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Preis</label>
                            <input type="text" class="form-control" id="price" name="price" value="{{$budget->price}}">

                        </div>
                        <div class="form-group">
                            <label for="name">Datum</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{date('Y-m-d', strtotime($budget->created_at))}}">

                        </div>
                        <div class="form-group">
                            <label for="kategorie">Kategorie</label>
                            <select class="form-select" name="categorie" aria-label="Default select example">
                                <option value="{{$budget->categorie->id}}">{{$budget->categorie->name}}</option>
                                @foreach($categories as $categorie)
                                    @if($budget->categorie->id != $categorie->id) 
                                        <option value="{{$categorie->id}}">{{$categorie->name}}</option> 
                                    @endif
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="beschreibung">Notiz</label>
                            <textarea class="form-control " id="notiz" name="notiz" rows="5">{{$budget->notiz}}</textarea>
                        </div>
                        
                        <input class="btn btn-primary mt-4" type="submit" value="absenden">
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
