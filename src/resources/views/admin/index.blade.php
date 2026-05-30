@extends('layouts.app', ['showHeader' => true, 'headerLink' => 'logout'])

@section('title', '管理画面')

@section('content')
<div class="container container--admin">
    <h2 class="page-title">Admin</h2>

    <form class="search-form" action="/search" method="GET">
        <input type="text" name="keyword" class="search-form__keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">
        <select name="gender" class="search-form__select">
            <option value="" {{ request('gender') === null || request('gender') === '' ? 'selected' : '' }}>性別</option>
            <option value="all" {{ request('gender') === 'all' ? 'selected' : '' }}>全て</option>
            <option value="1" {{ request('gender') === '1' ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender') === '2' ? 'selected' : '' }}>女性</option>
            <option value="3" {{ request('gender') === '3' ? 'selected' : '' }}>その他</option>
        </select>
        <select name="category_id" class="search-form__select">
            <option value="">お問い合わせの種類</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ (string) request('category_id') === (string) $category->id ? 'selected' : '' }}>
                    {{ $category->content }}
                </option>
            @endforeach
        </select>
        <input type="date" name="date" class="search-form__date" value="{{ request('date') }}">
        <button type="submit" class="btn btn--primary btn--compact">検索</button>
        <a href="/reset" class="btn btn--sub btn--compact">リセット</a>
    </form>

    <div class="admin-export">
        <form action="/export" method="GET">
            @if(request('keyword'))
                <input type="hidden" name="keyword" value="{{ request('keyword') }}">
            @endif
            @if(request('gender'))
                <input type="hidden" name="gender" value="{{ request('gender') }}">
            @endif
            @if(request('category_id'))
                <input type="hidden" name="category_id" value="{{ request('category_id') }}">
            @endif
            @if(request('date'))
                <input type="hidden" name="date" value="{{ request('date') }}">
            @endif
            <button type="submit" class="btn btn--outline btn--compact">エクスポート</button>
        </form>
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
                <td>
                    <button type="button" class="btn-detail"
                        data-id="{{ $contact->id }}"
                        data-name="{{ e($contact->last_name . " " . $contact->first_name) }}"
                        data-gender="{{ $contact->gender_label }}"
                        data-email="{{ $contact->email }}"
                        data-tel="{{ $contact->tel }}"
                        data-address="{{ $contact->address }}"
                        data-building="{{ e($contact->building ?? '') }}"
                        data-category="{{ e($contact->category->content ?? '') }}"
                        data-detail="{{ e($contact->detail) }}">
                        詳細
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination-wrap">
        {{ $contacts->appends(request()->query())->links() }}
    </div>
</div>

<div class="modal" id="contactModal" aria-hidden="true">
    <div class="modal__overlay" id="modalOverlay"></div>
    <div class="modal__content">
        <button type="button" class="modal__close" id="modalClose" aria-label="閉じる">&times;</button>
        <table class="modal-table">
            <tr>
                <th>お名前</th>
                <td id="modalName"></td>
            </tr>
            <tr>
                <th>性別</th>
                <td id="modalGender"></td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td id="modalEmail"></td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td id="modalTel"></td>
            </tr>
            <tr>
                <th>住所</th>
                <td id="modalAddress"></td>
            </tr>
            <tr>
                <th>建物名</th>
                <td id="modalBuilding"></td>
            </tr>
            <tr>
                <th>お問い合わせの種類</th>
                <td id="modalCategory"></td>
            </tr>
            <tr>
                <th>お問い合わせ内容</th>
                <td id="modalDetail"></td>
            </tr>
        </table>
        <form action="/delete" method="POST" class="modal__delete-form">
            @csrf
            <input type="hidden" name="id" id="modalDeleteId" value="">
            <button type="submit" class="btn btn--delete">削除</button>
        </form>
    </div>
</div>

<script>
(function () {
    var modal = document.getElementById('contactModal');
    var overlay = document.getElementById('modalOverlay');
    var closeBtn = document.getElementById('modalClose');
    var detailButtons = document.querySelectorAll('.btn-detail');

    function openModal(button) {
        document.getElementById('modalName').textContent = button.dataset.name || '';
        document.getElementById('modalGender').textContent = button.dataset.gender || '';
        document.getElementById('modalEmail').textContent = button.dataset.email || '';
        document.getElementById('modalTel').textContent = button.dataset.tel || '';
        document.getElementById('modalAddress').textContent = button.dataset.address || '';
        document.getElementById('modalBuilding').textContent = button.dataset.building || '';
        document.getElementById('modalCategory').textContent = button.dataset.category || '';
        document.getElementById('modalDetail').textContent = button.dataset.detail || '';
        document.getElementById('modalDeleteId').value = button.dataset.id || '';
        modal.classList.add('modal--open');
        modal.setAttribute('aria-hidden', 'false');
    }

    function closeModal() {
        modal.classList.remove('modal--open');
        modal.setAttribute('aria-hidden', 'true');
    }

    detailButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            openModal(button);
        });
    });

    closeBtn.addEventListener('click', closeModal);
    overlay.addEventListener('click', closeModal);
})();
</script>
@endsection
