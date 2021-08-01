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
                                    <a href="/Budget/{{ $categorie->id }}">{{ $categorie->name}}</a>
                                    <a class="btn btn-primary ml-5" href="/Budget/{{ $categorie->id }}/edit">edit</a>
                                    <form action="/Budget/{{ $categorie->id }}" method="post" class="btn btn-primary">
                                        @csrf
                                        @method("DELETE")
                                        <input type="submit" value="kill me!" style="border:none; background:none;" />
                                    </form>

                                <li>
                            @endforeach
                        </ul>
                        @auth
                        <a href="/categorie/create" class="btn btn-primary" style="margin-top:15px;">to create!</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection