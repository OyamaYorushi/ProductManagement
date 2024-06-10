@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Produtos com mais saídas</h1>
    <div id="topProductsChart" style="width:100%; height:400px;"></div>
</div>
@include('products.stock_report')
@endsection

@vite(['resources/js/home.js'])