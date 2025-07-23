@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('link')
<a class="header__link" href="{{ route('products.create') }}">＋商品を追加</a>
@endsection

@section('content')
<div class="product-index">
    <div class="sidebar">
        <h2>商品一覧</h2>
        <form method="GET" action="{{ route('products.index') }}">
            <input type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}">
            <button type="submit" class="btn-yellow">検索</button>
        </form>

        <form method="GET" action="{{ route('products.index') }}">
            <select name="sort" onchange="this.form.submit()">
                <option disabled selected>価格で並べ替え</option>
                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>価格が安い順</option>
                <option value ="desc" {{request('sort') == 'desc' ? 'selected' : '' }}>価格が高い順</option>
            </select>
        </form>
    </div>
    <div class="product-main">
        <div class="product-grid">
            @foreach ($products as $product)
            <div class="product-card">
                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                <div class="product-info">
                    <p class="product-name">{{ $product->name }}</p>
                    <p class="product-price">¥{{ number_format($product->price) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="pagination custom-pagination">
        @if ($products->lastPage() > 1)
            {{-- 前へ --}}
            @if ($products->onFirstPage())
                <span class="arrow disabled">&lt;</span>
            @else
                <a href="{{ $products->previousPageUrl() }}" class="arrow">&lt;</a>
            @endif
            {{-- ページ番号 --}}
            @for ($i = 1; $i <= $products->lastPage(); $i++)
                @if ($i == $products->currentPage())
                    <span class="page active">{{ $i }}</span>
                @else
                    <a href="{{ $products->url($i) }}" class="page">{{ $i }}</a>
                @endif
            @endfor
            {{-- 次へ --}}
            @if ($products->hasMorePages())
                <a href="{{ $products->nextPageUrl() }}" class="arrow">&gt;</a>
            @else
                <span class="arrow disabled">&gt;</span>
            @endif
        @endif
    </div>
</div>
@endsection