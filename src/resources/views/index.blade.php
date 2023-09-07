@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
@endsection

@section('header')
<div class="search__contents">
    <div class="area__search">
        <form class="form" action="/area" method="get" id='Shop_Form'>
            @csrf
            <select name="area_id" id="Prefecture_Select" >
                <option value="">All area</option>
                <option value="1">東京都</option>
                <option value="2">大阪府</option>
                <option value="3">福岡県</option>
            </select>
        </form>
    </div>
    <div class="genre__search">
        <form class="form" action="/" method="get">
            @csrf
            <select name="genre">
                <option value="">All genre</option>
                <option value="寿司">寿司</option>
                <option value="焼肉">焼肉</option>
                <option value="居酒屋">居酒屋</option>
                <option value="居酒屋">イタリアン</option>
                <option value="居酒屋">ラーメン</option>
            </select>
        </form>
        <span></span>
    </div>
    <div class="shop__search">
        <input type="text" name="shop" placeholder="Search...">
    </div>
</div>
@endsection

@section('content')

<div class="shop__flex--item">
    @foreach ($shop_cards as $shop_card)
    <div class="shop__card">
        <div class="shop__img">
            <img src="{{$shop_card->image_url}}" alt="{{$shop_card->getGenre()}}" />
        </div>
        <div class="card__content">
            <h2 class="card__ttl">{{$shop_card->name}}</h2>
            <div class="tag">
                <p class="card__tag--area">#{{$shop_card->getArea()}}</p>
                <p class="card__date--genre">#{{$shop_card->getGenre()}}</p>
            </div>
            <div class="card__button">
                <form class="form" action="/detail/{{$shop_card->id}}" method="get">
                    @csrf
                    <button class="card__button--details" type="submit">詳しくみる</button>
                </form>
                <form class="form" action="/like" method="post">
                    @csrf
                    <button class="card__button--like" type="submit"><i class="fas fa-heart"></i></button>
                    <input type="hidden" name="shop_id" value="{{$shop_card->id}}" />
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
<script src="{{ asset('js/shop.js') }}"></script>
@endsection
