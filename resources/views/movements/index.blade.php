@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Movimentações de Produtos</h1>
    <a href="{{ route('movements.create') }}" class="btn btn-primary mb-3">Registrar Movimentação</a>
    @if ($movements->isEmpty())
        <p>Não há movimentações registradas.</p>
    @else
        <table id="example" class="display table table-striped table-bordered" style="width: 100%;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Tipo</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movements as $movement)
                    <tr>
                        <td>{{ $movement->id }}</td>
                        <td>{{ $movement->product->name }}</td>
                        <td>{{ $movement->quantity }}</td>
                        <td>{{ $movement->type == 'in' ? 'Entrada' : 'Saída' }}</td>
                        <td>{{ date('d/m/Y', strtotime($movement->created_at)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
