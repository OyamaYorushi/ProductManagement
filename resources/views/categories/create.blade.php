@extends('layouts.app')

@section('content')
<div class="container">
    <h1>
        <a class="return" href="{{ route('categories.index') }}"> <i class="fa-solid fa-arrow-left"></i>  </a>
        Cadastrar Nova Categoria
    </h1>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show position-fixed bottom-0 end-0 m-3" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            @endforeach
        </div>
    @endif
        
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Cadastrar Categoria</button>
    </form>
</div>
@endsection
