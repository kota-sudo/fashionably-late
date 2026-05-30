@extends('layouts.app')

@section('title', 'お問い合わせ確認')

@section('content')
<div class="container">
    <h2 class="page-title">Confirm</h2>
    <table class="confirm-table">
        <tr>
            <th>お名前</th>
            <td>{{ $input['last_name'] }} {{ $input['first_name'] }}</td>
        </tr>
        <tr>
            <th>性別</th>
            <td>
                @if((int)$input['gender'] === 1) 男性
                @elseif((int)$input['gender'] === 2) 女性
                @else その他
                @endif
            </td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td>{{ $input['email'] }}</td>
        </tr>
        <tr>
            <th>電話番号</th>
            <td>{{ $input['tel'] }}</td>
        </tr>
        <tr>
            <th>住所</th>
            <td>{{ $input['address'] }}</td>
        </tr>
        <tr>
            <th>建物名</th>
            <td>{{ $input['building'] ?? '' }}</td>
        </tr>
        <tr>
            <th>お問い合わせの種類</th>
            <td>{{ $category->content ?? '' }}</td>
        </tr>
        <tr>
            <th>お問い合わせ内容</th>
            <td>{!! nl2br(e($input['detail'])) !!}</td>
        </tr>
    </table>
    <div class="confirm-actions">
        <form action="/contacts" method="POST">
            @csrf
            <input type="hidden" name="category_id" value="{{ $input['category_id'] }}">
            <input type="hidden" name="first_name" value="{{ $input['first_name'] }}">
            <input type="hidden" name="last_name" value="{{ $input['last_name'] }}">
            <input type="hidden" name="gender" value="{{ $input['gender'] }}">
            <input type="hidden" name="email" value="{{ $input['email'] }}">
            <input type="hidden" name="tel1" value="{{ $input['tel1'] }}">
            <input type="hidden" name="tel2" value="{{ $input['tel2'] }}">
            <input type="hidden" name="tel3" value="{{ $input['tel3'] }}">
            <input type="hidden" name="address" value="{{ $input['address'] }}">
            <input type="hidden" name="building" value="{{ $input['building'] ?? '' }}">
            <input type="hidden" name="detail" value="{{ $input['detail'] }}">
            <button type="submit" class="btn btn--primary">送信</button>
        </form>
        <form action="/" method="GET">
            <input type="hidden" name="category_id" value="{{ $input['category_id'] }}">
            <input type="hidden" name="first_name" value="{{ $input['first_name'] }}">
            <input type="hidden" name="last_name" value="{{ $input['last_name'] }}">
            <input type="hidden" name="gender" value="{{ $input['gender'] }}">
            <input type="hidden" name="email" value="{{ $input['email'] }}">
            <input type="hidden" name="tel1" value="{{ $input['tel1'] }}">
            <input type="hidden" name="tel2" value="{{ $input['tel2'] }}">
            <input type="hidden" name="tel3" value="{{ $input['tel3'] }}">
            <input type="hidden" name="address" value="{{ $input['address'] }}">
            <input type="hidden" name="building" value="{{ $input['building'] ?? '' }}">
            <input type="hidden" name="detail" value="{{ $input['detail'] }}">
            <button type="submit" class="btn btn--sub">修正</button>
        </form>
    </div>
</div>
@endsection
