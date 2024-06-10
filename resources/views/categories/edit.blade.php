@extends('layouts.app')

@section('content')
<div class="container">
    <h1>
        <a class="return" href="{{ route('categories.index') }}"> <i class="fa-solid fa-arrow-left"></i>  </a>
        Editar Categoria
    </h1>
    
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show position-fixed bottom-0 end-0 m-3" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            @endforeach
        </div>
    @endif
    
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection

