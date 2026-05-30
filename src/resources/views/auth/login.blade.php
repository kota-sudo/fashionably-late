@extends('layouts.app', ['showHeader' => true, 'headerLink' => $headerLink ?? 'register', 'headerLinkUrl' => $headerLinkUrl ?? '/register'])

@section('title', 'ログイン')

@section('content')
<div class="container">
    <h2 class="page-title">Login</h2>
    <form class="auth-form" action="/login" method="POST">
        @csrf
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
        <div class="form-actions">
            <button type="submit" class="btn btn--primary">ログイン</button>
        </div>
    </form>
</div>
@endsection
