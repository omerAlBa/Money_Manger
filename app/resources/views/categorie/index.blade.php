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
                            @foreach($categories as $categorie)
                                <li class="list-group-item">
                                    <a href="/Categorie/{{ $categorie->id }}">{{ $categorie->name}}</a>
                                    @auth
                                        <a class="btn btn-primary ml-5" href="/Categorie/{{ $categorie->id }}/edit">edit</a>
                                    @endauth
                                </li>
                            @endforeach
                        </ul>
                        @auth
                        <a href="/Categorie/create" class="btn btn-primary" style="margin-top:15px;">to create!</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection