@extends('layouts.app', ['headerLink' => 'login'])

@section('title', '会員登録')

@section('content')
<div class="container">
    <h2 class="page-title">Register</h2>
    <form class="auth-form" action="/register" method="POST">
        @csrf
        <div class="form-row">
            <label class="form-label">お名前</label>
            <div class="form-field">
                <input type="text" name="name" class="form-input" value="{{ old('name') }}">
                @error('name')<span class="form-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="form-row">
            <label class="form-label">メールアドレス</label>
            <div class="form-field">
                <input type="email" name="email" class="form-input" value="{{ old('email') }}">
                @error('email')<span class="form-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="form-row">
            <label class="form-label">パスワード</label>
            <div class="form-field">
                <input type="password" name="password" class="form-input">
                @error('password')<span class="form-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="form-row">
            <label class="form-label">パスワード（確認）</label>
            <div class="form-field">
                <input type="password" name="password_confirmation" class="form-input">
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn--primary">登録</button>
        </div>
    </form>
</div>
@endsection
