@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('header')
<div class="search__contents">
    <div class="area__search">
        <form class="form" action="/area" method="get" id="Area_Form">
            @csrf
            <select name="area_id" id="Area_Select">
                <option value="">All area</option>
                <option value="1">東京都</option>
                <option value="2">大阪府</option>
                <option value="3">福岡県</option>
            </select>
        </form>
    </div>
    <div class="genre__search">
        <form class="form" action="/genre" method="get" id="Genre_Form">
            @csrf
            <select name="genre_id" id="Genre_Select">
                <option value="">All genre</option>
                <option value="1">寿司</option>
                <option value="2">焼肉</option>
                <option value="3">居酒屋</option>
                <option value="4">イタリアン</option>
                <option value="5">ラーメン</option>
            </select>
        </form>
        <span></span>
    </div>
    <div class="shop__search">
        <form class="form" action="/shopname" method="get" id="Name_Form">
            @csrf
            <input type="text" name="name" id="Shop_Select" placeholder="Search...">
        </form>
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
                <form class="form" action="/area" method="get">
                    @csrf
                    <button class="card__tag--area" type="submit">#{{$shop_card->getArea()}}</button>
                    <input type="hidden" name="area_id" value="{{$shop_card->area_id}}" />
                </form>
                <form class="form" action="/genre" method="get">
                    @csrf
                    <button class="card__tag--genre" type="submit">#{{$shop_card->getGenre()}}</button>
                    <input type="hidden" name="genre_id" value="{{$shop_card->genre_id}}" />
                </form>
            </div>
            <div class="card__button">
                <form class="form" action="/detail/{{$shop_card->id}}" method="get">
                    @csrf
                    <button class="card__button--details" type="submit">詳しくみる</button>
                </form>
                <form class="form" action="/like" method="post">
                    @csrf
                    <input type="hidden" name="shop_id" value="{{$shop_card->id}}" />

                    @if($shop_card->shop_id)<!-- お気に入り状態に応じて条件分岐 -->
                    <button class="card__button--like favorite" type="submit"><i class="fas fa-heart"></i></button>
                    @else
                    <button class="card__button--like not-favorite" type="submit"><i class="fas fa-heart"></i></button>
                    @endif

                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
<script src="{{ asset('js/shop.js') }}"></script>
@endsection