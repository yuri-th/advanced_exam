@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('header')
<div class="search__contents">
    <div class="area__search">
        <select name="Prefecture">
            <option value="">All area</option>
            <option value="東京都">東京都</option>
            <option value="大阪府">大阪府</option>
            <option value="福岡県">福岡県</option>
        </select>
    </div>
    <div class="genre__search">
        <select name="genre">
            <option value="">All genre</option>
            <option value="寿司">寿司</option>
            <option value="焼肉">焼肉</option>
            <option value="居酒屋">居酒屋</option>
            <option value="居酒屋">イタリアン</option>
            <option value="居酒屋">ラーメン</option>
        </select>
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

        <form class="form" action="/detail/{{$shop_card->id}}" method="get">
            @csrf
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
                    <button class="card__button--details" type="submit">詳しくみる</button>
                    <button class="card__button--like" type="button"><i class="fas fa-heart"></i></button>
                </div>
            </div>
        </form>

    </div>
    @endforeach
</div>

@endsection

<!-- <div class="shop__card">
        <form class="form" action="" method="get">
            <div class="shop__img">
                <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg" alt="焼肉" />
            </div>
            <div class="card__content">
                <h2 class="card__ttl">
                    牛助
                </h2>
                <div class="tag">
                    <p class="card__tag--area">#大阪府</p>
                    <p class="card__date--genre">#焼肉</p>
                </div>
                <div class="card__button">
                    <button class="card__button--details" type="submit">詳しくみる</button>
                    <button class="card__button--like" type="button"><i class="fas fa-heart"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="shop__card">
        <form class="form" action="" method="get">
            <div class="shop__img">
                <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg" alt="居酒屋" />
            </div>
            <div class="card__content">
                <h2 class="card__ttl">
                    戦慄
                </h2>
                <div class="tag">
                    <p class="card__tag--area">#福岡県</p>
                    <p class="card__date--genre">#居酒屋</p>
                </div>
                <div class="card__button">
                    <button class="card__button--details" type="submit">詳しくみる</button>
                    <button class="card__button--like" type="button"><i class="fas fa-heart"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="shop__card">
        <form class="form" action="" method="get">
            <div class="shop__img">
                <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg" alt="イタリアン" />
            </div>
            <div class="card__content">
                <h2 class="card__ttl">
                    ルーク
                </h2>
                <div class="tag">
                    <p class="card__tag--area">#東京都</p>
                    <p class="card__date--genre">#イタリアン</p>
                </div>
                <div class="card__button">
                    <button class="card__button--details" type="submit">詳しくみる</button>
                    <button class="card__button--like" type="button"><i class="fas fa-heart"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="shop__flex--item">
    <div class="shop__card">
        <form class="form" action="" method="get">
            <div class="shop__img">
                <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/ramen.jpg" alt="ラーメン" />
            </div>
            <div class="card__content">
                <h2 class="card__ttl">
                    志摩屋
                </h2>
                <div class="tag">
                    <p class="card__tag--area">#福岡県</p>
                    <p class="card__date--genre">#ラーメン</p>
                </div>
                <div class="card__button">
                    <button class="card__button--details" type="submit">詳しくみる</button>
                    <button class="card__button--like" type="button"><i class="fas fa-heart"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="shop__card">
        <form class="form" action="" method="get">
            <div class="shop__img">
                <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg" alt="焼肉" />
            </div>
            <div class="card__content">
                <h2 class="card__ttl">
                    香
                </h2>
                <div class="tag">
                    <p class="card__tag--area">#東京都</p>
                    <p class="card__date--genre">#焼肉</p>
                </div>
                <div class="card__button">
                    <button class="card__button--details" type="submit">詳しくみる</button>
                    <button class="card__button--like" type="button"><i class="fas fa-heart"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="shop__card">
        <form class="form" action="" method="get">
            <div class="shop__img">
                <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg" alt="イタリアン" />
            </div>
            <div class="card__content">
                <h2 class="card__ttl">
                    JJ
                </h2>
                <div class="tag">
                    <p class="card__tag--area">#大阪府</p>
                    <p class="card__date--genre">#イタリアン</p>
                </div>
                <div class="card__button">
                    <button class="card__button--details" type="submit">詳しくみる</button>
                    <button class="card__button--like" type="button"><i class="fas fa-heart"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="shop__card">
        <form class="form" action="" method="get">
            <div class="shop__img">
                <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/ramen.jpg" alt="ラーメン" />
            </div>
            <div class="card__content">
                <h2 class="card__ttl">
                    らーめん極み
                </h2>
                <div class="tag">
                    <p class="card__tag--area">#東京都</p>
                    <p class="card__date--genre">#ラーメン</p>
                </div>
                <div class="card__button">
                    <button class="card__button--details" type="submit">詳しくみる</button>
                    <button class="card__button--like" type="button"><i class="fas fa-heart"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="shop__flex--item">
    <div class="shop__card">
        <form class="form" action="" method="get">
            <div class="shop__img">
                <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg" alt="居酒屋" />
            </div>
            <div class="card__content">
                <h2 class="card__ttl">
                    鳥雨
                </h2>
                <div class="tag">
                    <p class="card__tag--area">#大阪府</p>
                    <p class="card__date--genre">#居酒屋</p>
                </div>
                <div class="card__button">
                    <button class="card__button--details" type="submit">詳しくみる</button>
                    <button class="card__button--like" type="button"><i class="fas fa-heart"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="shop__card">
        <form class="form" action="" method="get">
            <div class="shop__img">
                <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg" alt="寿司" />
            </div>
            <div class="card__content">
                <h2 class="card__ttl">
                    築地色合
                </h2>
                <div class="tag">
                    <p class="card__tag--area">#東京都</p>
                    <p class="card__date--genre">#寿司</p>
                </div>
                <div class="card__button">
                    <button class="card__button--details" type="submit">詳しくみる</button>
                    <button class="card__button--like" type="button"><i class="fas fa-heart"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="shop__card">
        <form class="form" action="" method="get">
            <div class="shop__img">
                <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg" alt="焼肉" />
            </div>
            <div class="card__content">
                <h2 class="card__ttl">
                    春海
                </h2>
                <div class="tag">
                    <p class="card__tag--area">#大阪府</p>
                    <p class="card__date--genre">#焼肉</p>
                </div>
                <div class="card__button">
                    <button class="card__button--details" type="submit">詳しくみる</button>
                    <button class="card__button--like" type="button"><i class="fas fa-heart"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="shop__card">
        <form class="form" action="" method="get">
            <div class="shop__img">
                <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg" alt="焼肉" />
            </div>
            <div class="card__content">
                <h2 class="card__ttl">
                    三子
                </h2>
                <div class="tag">
                    <p class="card__tag--area">#福岡県</p>
                    <p class="card__date--genre">#焼肉</p>
                </div>
                <div class="card__button">
                    <button class="card__button--details" type="submit">詳しくみる</button>
                    <button class="card__button--like" type="button"><i class="fas fa-heart"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="shop__flex--item">
    <div class="shop__card">
        <form class="form" action="" method="get">
            <div class="shop__img">
                <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg" alt="居酒屋" />
            </div>
            <div class="card__content">
                <h2 class="card__ttl">
                    八戒
                </h2>
                <div class="tag">
                    <p class="card__tag--area">#東京都</p>
                    <p class="card__date--genre">#居酒屋</p>
                </div>
                <div class="card__button">
                    <button class="card__button--details" type="submit">詳しくみる</button>
                    <button class="card__button--like" type="button"><i class="fas fa-heart"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="shop__card">
        <form class="form" action="" method="get">
            <div class="shop__img">
                <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg" alt="寿司" />
            </div>
            <div class="card__content">
                <h2 class="card__ttl">
                    福助
                </h2>
                <div class="tag">
                    <p class="card__tag--area">#大阪府</p>
                    <p class="card__date--genre">#寿司</p>
                </div>
                <div class="card__button">
                    <button class="card__button--details" type="submit">詳しくみる</button>
                    <button class="card__button--like" type="button"><i class="fas fa-heart"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="shop__card">
        <form class="form" action="" method="get">
            <div class="shop__img">
                <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/ramen.jpg" alt="ラーメン" />
            </div>
            <div class="card__content">
                <h2 class="card__ttl">
                    ラー北
                </h2>
                <div class="tag">
                    <p class="card__tag--area">#東京都</p>
                    <p class="card__date--genre">#ラーメン</p>
                </div>
                <div class="card__button">
                    <button class="card__button--details" type="submit">詳しくみる</button>
                    <button class="card__button--like" type="button"><i class="fas fa-heart"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="shop__card">
        <form class="form" action="" method="get">
            <div class="shop__img">
                <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg" alt="居酒屋" />
            </div>
            <div class="card__content">
                <h2 class="card__ttl">
                    翔
                </h2>
                <div class="tag">
                    <p class="card__tag--area">#大阪府</p>
                    <p class="card__date--genre">#居酒屋</p>
                </div>
                <div class="card__button">
                    <button class="card__button--details" type="submit">詳しくみる</button>
                    <button class="card__button--like" type="button"><i class="fas fa-heart"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="shop__flex--item">
    <div class="shop__card">
        <form class="form" action="" method="get">
            <div class="shop__img">
                <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg" alt="寿司" />
            </div>
            <div class="card__content">
                <h2 class="card__ttl">
                    経緯
                </h2>
                <div class="tag">
                    <p class="card__tag--area">#東京都</p>
                    <p class="card__date--genre">#寿司</p>
                </div>
                <div class="card__button">
                    <button class="card__button--details" type="submit">詳しくみる</button>
                    <button class="card__button--like" type="button"><i class="fas fa-heart"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="shop__card">
        <form class="form" action="" method="get">
            <div class="shop__img">
                <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg" alt="焼肉" />
            </div>
            <div class="card__content">
                <h2 class="card__ttl">
                    漆
                </h2>
                <div class="tag">
                    <p class="card__tag--area">#東京都</p>
                    <p class="card__date--genre">#焼肉</p>
                </div>
                <div class="card__button">
                    <button class="card__button--details" type="submit">詳しくみる</button>
                    <button class="card__button--like" type="button"><i class="fas fa-heart"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="shop__card">
        <form class="form" action="" method="get">
            <div class="shop__img">
                <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg" alt="イタリアン" />
            </div>
            <div class="card__content">
                <h2 class="card__ttl">
                    THE TOOL
                </h2>
                <div class="tag">
                    <p class="card__tag--area">#福岡県</p>
                    <p class="card__date--genre">#イタリアン</p>
                </div>
                <div class="card__button">
                    <button class="card__button--details" type="submit">詳しくみる</button>
                    <button class="card__button--like" type="button"><i class="fas fa-heart"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="shop__card">
        <form class="form" action="" method="get">
            <div class="shop__img">
                <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg" alt="寿司" />
            </div>
            <div class="card__content">
                <h2 class="card__ttl">
                    木船
                </h2>
                <div class="tag">
                    <p class="card__tag--area">#大阪府</p>
                    <p class="card__date--genre">#寿司</p>
                </div>
                <div class="card__button">
                    <button class="card__button--details" type="submit">詳しくみる</button>
                    <button class="card__button--like" type="button"><i class="fas fa-heart"></i></button>
                </div>
            </div>
        </form>
    </div> -->