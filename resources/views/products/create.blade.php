@extends('layouts.app')

@section('content')
<div class="container">
    <h1>
        <a class="return" href="{{ route('products.index') }}"> <i class="fa-solid fa-arrow-left"></i>  </a>
        Cadastrar Novo Produto
    </h1>
    
    @if($errors->any())
        <div id="alerta" class="alert alert-danger alert-dismissible fade show position-fixed bottom-0 end-0 m-3" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            @endforeach
        </div>
    @endif
    
    <form class="validated" novalidate action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        
        <div class="mb-3">
            <label for="category_id" class="form-label">Categoria:</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="">Selecione a Categoria</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">SKU:</label>
            <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku') }}" required>
        </div>
        
        <div class="mb-3">
            <label for="price" class="form-label">Preço:</label>
            <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Descrição:</label>
            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
        </div>
        
        <div class="mb-3">
            <label for="photo" class="form-label">Foto:</label>
            <input type="file" class="form-control" id="photo" name="photo" accept="image/jpeg,image/png">
        </div>
        
        <div class="mb-3">
            <label for="expiry_date" class="form-label">Data de Vencimento:</label>
            <input type="date" class="form-control" id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}">
        </div>

        <div class="mb-3">
            <label for="stock_quantity" class="form-label">Quantidade em Estoque:</label>
            <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity') }}" required>
        </div>
        
        <button type="submit" class="btn btn-primary" id="salvarProduto">Salvar</button>
    </form>
</div>
@endsection

@vite(['resources/js/produtoCadastro.js'])
