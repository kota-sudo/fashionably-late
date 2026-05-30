@extends('layouts.app', ['showHeader' => true, 'headerLink' => 'logout'])

@section('title', '管理画面')

@section('content')
<div class="container container--admin">
    <h2 class="page-title">Admin</h2>
    <div class="admin-toolbar">
        <form class="search-form" action="#" method="GET" onsubmit="return false;">
            <div class="search-form__group">
                <label>お名前</label>
                <input type="text" name="name" placeholder="例:山田 太郎">
            </div>
            <div class="search-form__group">
                <label>メールアドレス</label>
                <input type="email" name="email" placeholder="例: test@example.com">
            </div>
            <div class="search-form__group">
                <label>性別</label>
                <select name="gender">
                    <option value="">全て</option>
                    <option value="1">男性</option>
                    <option value="2">女性</option>
                    <option value="3">その他</option>
                </select>
            </div>
            <div class="search-form__group">
                <label>作成日（From）</label>
                <input type="date" name="created_from">
            </div>
            <div class="search-form__group">
                <label>作成日（To）</label>
                <input type="date" name="created_to">
            </div>
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
                <th>お問い合わせ内容</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td>{{ $contact->gender_label }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ Str::limit($contact->detail, 40) }}</td>
                <td><button type="button" class="btn-detail">詳細</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $contacts->links() }}
</div>
@endsection
