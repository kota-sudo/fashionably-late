@extends('layouts.app')

@section('title', 'お問い合わせ')

@section('content')
<div class="container">
    <h2 class="page-title">Contact</h2>
    <div class="form-card">
        <form action="/confirm" method="POST">
            @csrf
            <div class="form-row">
                <label class="form-label form-label--required">お問い合わせの種類</label>
                <div class="form-field">
                    <select name="category_id" class="form-select">
                        <option value="">選択してください</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ (string) old('category_id', request('category_id')) === (string) $category->id ? 'selected' : '' }}>
                                {{ $category->content }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-row">
                <label class="form-label form-label--required">お名前</label>
                <div class="form-field">
                    <input type="text" name="last_name" class="form-input" placeholder="例:山田" value="{{ old('last_name', request('last_name')) }}" style="max-width:200px;display:inline-block;margin-right:8px;">
                    <input type="text" name="first_name" class="form-input" placeholder="例:太郎" value="{{ old('first_name', request('first_name')) }}" style="max-width:200px;display:inline-block;">
                    @error('last_name')<span class="form-error">{{ $message }}</span>@enderror
                    @error('first_name')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-row">
                <label class="form-label form-label--required">性別</label>
                <div class="form-field">
                    <div class="form-radio-group">
                        @php $g = old('gender', request('gender')); @endphp
                        <label><input type="radio" name="gender" value="1" {{ (string)$g === '1' ? 'checked' : '' }}> 男性</label>
                        <label><input type="radio" name="gender" value="2" {{ (string)$g === '2' ? 'checked' : '' }}> 女性</label>
                        <label><input type="radio" name="gender" value="3" {{ (string)$g === '3' ? 'checked' : '' }}> その他</label>
                    </div>
                    @error('gender')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-row">
                <label class="form-label form-label--required">メールアドレス</label>
                <div class="form-field">
                    <input type="email" name="email" class="form-input" placeholder="例: test@example.com" value="{{ old('email', request('email')) }}">
                    @error('email')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-row">
                <label class="form-label form-label--required">電話番号</label>
                <div class="form-field">
                    <input type="text" name="tel1" class="form-input form-input--short" value="{{ old('tel1', request('tel1', $tel1 ?? '')) }}" maxlength="4">
                    <span class="form-tel-sep">-</span>
                    <input type="text" name="tel2" class="form-input form-input--short" value="{{ old('tel2', request('tel2', $tel2 ?? '')) }}" maxlength="4">
                    <span class="form-tel-sep">-</span>
                    <input type="text" name="tel3" class="form-input form-input--short" value="{{ old('tel3', request('tel3', $tel3 ?? '')) }}" maxlength="4">
                    @error('tel1')<span class="form-error">{{ $message }}</span>@enderror
                    @error('tel2')<span class="form-error">{{ $message }}</span>@enderror
                    @error('tel3')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-row">
                <label class="form-label form-label--required">住所</label>
                <div class="form-field">
                    <input type="text" name="address" class="form-input" placeholder="例: 1-2-3 〇〇ビル" value="{{ old('address', request('address')) }}">
                    @error('address')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-row">
                <label class="form-label">建物名</label>
                <div class="form-field">
                    <input type="text" name="building" class="form-input" value="{{ old('building', request('building')) }}">
                    @error('building')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-row">
                <label class="form-label form-label--required">お問い合わせ内容</label>
                <div class="form-field">
                    <textarea name="detail" class="form-textarea">{{ old('detail', request('detail')) }}</textarea>
                    @error('detail')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn--primary">確認画面</button>
            </div>
        </form>
    </div>
</div>
@endsection
