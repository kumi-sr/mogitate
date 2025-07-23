@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css')}}">
@endsection

@section('content')
<div class="register-form">
    <div class="form-wrapper">
        <h1 class="form-title">商品登録</h1>

        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label class="form-label">商品名 <span class="required">必須</span></label>
        <input type="text" name="name" class="form-input" value="{{ old('name') }}" placeholder="商品名を入力">
        <p class="register-form__error-message">
            @error('name')
            {{ $message }}
            @enderror
        </p>
        
        <label class="form-label">値段 <span class="required">必須</span></label>
        <input type="number" name="price" class="form-input" value="{{ old('price') }}" placeholder="値段を入力">
        <p class="register-form__error-message">
            @error('price')
            {{ $message }}
            @enderror
        </p>

        <label class="form-label">商品画像 <span class="required">必須</span></label>
        <input type="file" name="image" class="form-file">
        <p class="register-form__error-message">
            @error('image')
            {{ $message }}
            @enderror
        </p>

        <label class="form-label">季節  <span class="required">必須</span><span class="optional">複数選択可</span></label>
        <div class="checkbox-group">
            @foreach(['春', '夏', '秋', '冬'] as $season)
            <label>
                <input type="checkbox" name="season[]" value="{{ $season }}"
                {{ is_array(old('season')) && in_array($season, old('season')) ? 'checked' : '' }}>
                {{ $season }}
            </label>
            @endforeach
        </div>
        <p class="register-form__error-message">
            @error('season')
            {{ $message }}
            @enderror
        </p>

        <label class="form-label">商品説明 <span class="required">必須</span></label>
        <textarea name="description" class="form-textarea" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
        <p class="register-form__error-message">
            @error('description')
            {{ $message }}
            @enderror
        </p>

        <div class="button-group">
            <a href="{{ route('products.index') }}" class="btn-gray">戻る</a>
            <button type="submit" class="btn-yellow">登録</button>
        </div>
        </form>
    </div>
</div>
@endsection
