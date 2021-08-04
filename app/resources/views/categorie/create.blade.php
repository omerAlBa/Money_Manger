@extends('dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Erstelle eine neue Kategorie</div>
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
                        <hr />
                        <h5>Art der Kategorie</h5>
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
                        <hr />
                        <h5>Sichtbarkeit der Kategorie</h5>
                        <div class="form-check">
                            <label class="form-check-label" for="flexCheckBox">
                                Sichtbar für alle
                            </label>
                            <input class="form-check-input" type="checkbox" name="share_able" id="flexCheckBox">
                        </div>
                        <input class="btn btn-primary mt-4" type="submit" value="absenden">
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let flexCheckBox = document.querySelector('#flexCheckBox');
    flexCheckBox.addEventListener('change', (event)=>{
        if (event.target.value != "1") {
            return event.target.value = "1";
        }
        event.target.value = "0";
    });
</script>
@endsection
