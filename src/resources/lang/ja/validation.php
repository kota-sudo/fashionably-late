<?php

return [
    'required' => ':attributeを入力してください',
    'email' => ':attributeはメール形式で入力してください',

    'attributes' => [
        'name' => 'お名前',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
    ],

    'custom' => [
        'email' => [
            'required' => 'メールアドレスを入力してください',
            'email' => 'メールアドレスはメール形式で入力してください',
        ],
        'password' => [
            'required' => 'パスワードを入力してください',
        ],
        'name' => [
            'required' => 'お名前を入力してください',
        ],
    ],
];
