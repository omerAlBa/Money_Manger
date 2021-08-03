@extends('dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Deine Ausgaben!!</div>
                <div class="card-body">
                    <form action="/Categorie/{{ $categorie->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name') ?? $categorie->name}}">
                        </div>
                        <hr />
                        <h4>Kategorie aus/einschlaten</h4>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="onoff" id="onoff" value="{{old('visible') ?? $categorie->visible}}" data-status="{{old('visible') ?? $categorie->visible}}">
                            <label class="form-check-label" for="onoff">
                                Ausschalten
                            </label>
                        </div>
                        <hr />
                        <h4>Art der Ausgabe</h4>
                        <hr />
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="kind_of" id="flexRadio1" value="0" data-status="{{old('kind_of') ?? $categorie->kind_of}}">
                            <label class="form-check-label" for="flexRadio1">
                                Verbindlichkeit
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="kind_of" value="1" id="flexRadio2" data-status="{{old('kind_of') ?? $categorie->kind_of}}">
                            <label class="form-check-label" for="flexRadio2">
                                Inveest
                            </label>
                        </div>                        
                        <input class="btn btn-primary mt-4" type="submit" value="anpassen">
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    //Art der Ausgabe
    let flexRadio1 = document.querySelector('#flexRadio1');
    let flexRadio2 = document.querySelector('#flexRadio2');
    
    if (flexRadio1.dataset.status == 0) {
        flexRadio1.checked = true;
    } else {
        flexRadio2.checked = true;
    }

    //ein/ausgabe
    let flexCheckBox = document.querySelector('#visible');
    if (flexCheckBox) {
        if (flexCheckBox.dataset.status == 0) {
            flexCheckBox.checked = true
        }

        //add EventListener
        flexCheckBox.addEventListener('change',function(event){
            if(flexCheckBox.dataset.status == "0" || flexCheckBox.dataset.status == null){
                flexCheckBox.value = 1;
            } else {
                flexCheckBox.value = 0;
            }
        })
    }
    

    

    //on off input element
    let onOffElement = document.querySelector('#onoff');
    onOffElement.addEventListener('change',function(event){
        console.log('sollte laufen!');
        if(onOffElement.value == "0"){
            onOffElement.value = 1;
        } else {
            onOffElement.value = 0;
        }
    })

</script>
@endsection
