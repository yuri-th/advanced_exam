@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="done__content">
    <div class="done__card">
        <div class="done__card-text">

            <h1>ご予約ありがとうございます</h1>

            <div class="login__button">
                <button class="login__button-link"><a href="/detail/{{$shop}}">戻る</a>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection