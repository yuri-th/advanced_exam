@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage">
    <h1>
        <?php $user = Auth::user(); ?>{{ $user->name }}さん
    </h1>
    <div class="mypage__content">
        <div class="reservation__status">
            <h2>予約状況</h2>
            @foreach ($reserves as $reserve)
            <form class="reservation__form" action="" method="post">
                <div class="reservation__status-icon">
                    <div class="icon__clock"><i class="far fa-clock icon__clock--size"></i></div>
                    <div class="icon__delete"><i class="far fa-times-circle icon__delete--size"></i></div>
                </div>
                <div>
                    <label for="confirm__name" class="form-title">Shop</label>
                    <input type="text" name="name" value="{{$reserve->shopName()}}" readonly />
                    <input type="hidden" name="shop_id" value="{{$reserve->shop_id}}">
                </div>

                <div>
                    <label for="confirm__date" class="form-title">Date</label>
                    <input type="text" name="reservation_date" value="{{$reserve->date}}" readonly />
                </div>
                <div>
                    <label for="confirm__time" class="form-title">Time</label>
                    <input type="text" name="time" value="{{$reserve->start_at}}" readonly />
                </div>
                <div>
                    <label for="confirm__number" class="form-title">Number</label>
                    <input type="text" name="number" value="{{$reserve->num_of_users}}人" readonly />
                </div>
            </form>
            @endforeach
        </div>
        <div class="favorite__store">
            <h2>お気に入り店舗</h2>
            <div class="favorite__store-list">

                @foreach ($shops as $shop)
                <div class="shop__card">
                    <div class="shop__img">
                        <img src="{{$shop->image_url}}" alt="{{$shop->getGenre()}}" />
                    </div>
                    <div class="card__content">
                        <h2 class="card__ttl">{{$shop->name}}</h2>
                        <div class="tag">
                            <p class="card__tag--area">#{{$shop->getArea()}}</p>
                            <p class="card__date--genre">#{{$shop->getGenre()}}</p>
                        </div>
                        <div class="card__button">
                            <form class="form" action="/detail/{{$shop->id}}" method="get">
                                @csrf
                                <button class="card__button--details" type="submit">詳しくみる</button>
                            </form>
                            <form class="form" action="/like" method="post">
                                @csrf
                                <button class="card__button--like" type="submit"><i class="fas fa-heart"></i></button>
                                <input type="hidden" name="shop_id" value="" />
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection