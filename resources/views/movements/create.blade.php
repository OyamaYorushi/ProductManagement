@extends('layouts.app')

@section('content')
<div class="container">
    <h1>
        <a class="return" href="{{ route('movements.index') }}"> <i class="fa-solid fa-arrow-left"></i>  </a>
        Registrar Movimentação de Produto
    </h1>
    
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show position-fixed bottom-0 end-0 m-3" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            @endforeach
        </div>
    @endif
    
    <form action="{{ route('movements.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="product_id" class="form-label">Produto:</label>
            <select class="form-select" id="product_id" name="product_id" required>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantidade:</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Tipo:</label>
            <select class="form-select" id="type" name="type" required>
                <option value="in">Entrada</option>
                <option value="out">Saída</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Registrar Movimentação</button>
    </form>
</div>
@endsection
