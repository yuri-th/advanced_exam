@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/email.css') }}">
@endsection

@section('content')
<div class="email-content">
    <div class="email-card">
            <h2>認証リンクを送信しました</h2>
            <p class="email-card__text">ご登録いただいたメールアドレスへ認証リンクを送信しました。</p><p>クリックして認証を完了させてください。</p>  
    </div>
</div>
@endsection