@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<div class="product-detail">
    <h2>{{ $product->name }}</h2>
    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
    <p>価格: ¥{{ number_format($product->price) }}</p>
    <p>{{ $product->description }}</p>
    <div class="button-group">
        <a href="{{ route('products.index') }}" class="btn-gray">戻る</a>
        <button type="submit" class="btn-yellow">変更を保存</button>
    </div>
</div>
@endsection
