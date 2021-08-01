@extends('dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Erstelle einen neue Kategorie</div>
                <div class="card-body">
                    <form action="/Categorie" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control {{ $errors->has('name') ? 'border-danger' : '' }}" id="betrag" name="name" type="text" min="1" place-holder="Kategorie bezeichnung"></input>
                            @if($errors->has('name'))
                                <small class="text-danger">{!! $errors->first('name') !!}</small>
                            @endif
                        </div>
                        <br />
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="kind_of" id="flexRadioDefault1" value="0" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Verbindlichkeit
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="kind_of" value="1" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Inveest
                            </label>
                        </div>
                        <input class="btn btn-primary mt-4" type="submit" value="absenden">
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
