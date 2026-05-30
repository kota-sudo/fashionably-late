@extends('layouts.app', ['showHeader' => true, 'headerLink' => 'logout'])

@section('title', '管理画面')

@section('content')
<div class="container container--admin">
    <h2 class="page-title">Admin</h2>
    <div class="admin-toolbar">
        <form class="search-form" action="#" method="GET" onsubmit="return false;">
            <input type="text" name="keyword" class="search-form__keyword" placeholder="名前やメールアドレスを入力してください">
            <select name="gender" class="search-form__select">
                <option value="">性別</option>
                <option value="1">男性</option>
                <option value="2">女性</option>
                <option value="3">その他</option>
            </select>
            <select name="category_id" class="search-form__select">
                <option value="">お問い合わせの種類</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->content }}</option>
                @endforeach
            </select>
            <input type="date" name="created_at" class="search-form__date" placeholder="年/月/日">
            <button type="button" class="btn btn--primary">検索</button>
            <button type="button" class="btn btn--sub">リセット</button>
        </form>
        <button type="button" class="btn btn--outline">エクスポート</button>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td>{{ $contact->gender_label }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->category->content ?? '' }}</td>
                <td><button type="button" class="btn-detail">詳細</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $contacts->links() }}
</div>
@endsection
