@extends('dashboard')

@section('content')
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Alle deine Hobbies!</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($budgets as $budget)
                                <div class="card mb-4 box-shadow">
                                    <div class="card-header">
                                        <a href="/Budget/{{ $budget->id }}">
                                            {{$budget->categorie->name}}
                                        </a>
                                    </div>
                                    <div class="card-body">
                                    <h1 class="card-title pricing-card-title">€ {{$budget->price}} <small class="text-muted">/ {{date('d M y', strtotime($budget->created_at))}}</small></h1>
                                        <ul class="list-unstyled mt-3 mb-4">
                                        <a class="btn btn-primary toggle_" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Notizen
                                        </a>
                                        <div class="collapse" id="collapseExample">
                                            <div class="card card-body">
                                                {{$budget->notiz}}
                                            </div>
                                        </div>
                                            <li>von / <span class="name_user">{{$budget->user->name}}</span></li>
                                        </ul>
                                        <a class="btn btn-primary ml-5" href="/Budget/{{ $budget->id }}/edit">edit</a>
                                        <form action="/Budget/{{ $budget->id }}" method="post" class="btn btn-primary">
                                            @csrf
                                            @method("DELETE")
                                            <input type="submit" value="kill me!" style="border:none; background:none;" />
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </ul>
                        @auth
                        <a href="/Budget/create" class="btn btn-primary" style="margin-top:15px;">to create!</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.querySelector('.toggle_').addEventListener('click',function(){
    if(document.querySelector('#collapseExample').classList.contains('collapse.show')){
        document.querySelector('#collapseExample').classList.add('collapse')
    } else {
        document.querySelector('#collapseExample').classList.remove('collapse')
    }

    document.querySelector('#collapseExample').classList.toggle('collapse.show')
})
</script>
@endsection