@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="shop__info">
    <div class="shop__detail">
        <form action="/" method="get">
            @csrf
            @foreach ($shop_records as $shop_record)
            <div class="shop__detail--ttl">
                <button class="shop__detail--btn" type="submit">＜</button>
                <span class="shop__detail--name">{{$shop_record->name}}</span>
            </div>
        </form>
        <div class="shop__detail--img">
            <img src="{{$shop_record->image_url}}" alt="{{$shop_record->getGenre()}}" />
        </div>
        <div class="tag">
            <p class="shop__tag--area">#{{$shop_record->getArea()}}</p>
            <p class="shop__tag--genre">#{{$shop_record->getGenre()}}</p>
        </div>
        <p class="shop__description">{{$shop_record->description}}</p>
    </div>
    @endforeach
    <div class="reservation__form">
        <div class="reservation__form--content">
            <h2>予約</h2>
            <div class="reservation__form--date">
                <input type="date" name="reservation_date" id="reservation_date" />
            </div>
            <div class="reservation__form--time">
                <select name="time" id="reservation_time">
                    <option value="">Time</option>
                    <option value="17:00">17:00</option>
                    <option value="17:30">17:30</option>
                    <option value="18:00">18:00</option>
                    <option value="18:30">18:30</option>
                    <option value="19:00">19:00</option>
                    <option value="19:30">19:30</option>
                    <option value="20:00">20:00</option>
                    <option value="20:30">20:30</option>
                    <option value="21:00">21:00</option>
                    <option value="21:30">21:30</option>
                    <option value="22:00">22:00</option>
                </select>
            </div>
            <div class="reservation__form--number">
                <select name="number" id="reservation_number">
                    <option value="">Number</option>
                    <option value="1人">1人</option>
                    <option value="2人">2人</option>
                    <option value="3人">3人</option>
                    <option value="4人">4人</option>
                    <option value="5人">5人</option>
                    <option value="6人">6人</option>
                    <option value="7人">7人</option>
                    <option value="8人">8人</option>
                    <option value="9人">9人</option>
                    <option value="10人">10人</option>
                </select>
            </div>
        </div>
        <form class="form" action="/reserve" method="post">
            @csrf
            <div class="reservation__form--confirm">
                @foreach ($shop_records as $shop_record)
                <div>
                    <label for="confirm__name" class="form-title">Shop</label>
                    <input type="text" name="name" value="{{$shop_record->name}}" readonly />
                    <input type="hidden" name="shop_id" value="{{$shop_record->id}}">
                </div>
                @endforeach
                <div>
                    <label for="confirm__date" class="form-title">Date</label>
                    <input type="text" name="reservation_date" id="confirm__date" readonly />
                </div>
                <div>
                    <label for="confirm__time" class="form-title">Time</label>
                    <input type="text" name="time" id="confirm__time" readonly />
                </div>
                <div>
                    <label for="confirm__number" class="form-title">Number</label>
                    <input type="text" name="number" id="confirm__number" readonly />
                </div>
            </div>
            <button class="reservation__form--btn" type="submit">予約する</button>
        </form>
    </div>
</div>
<script src="{{ asset('js/reserve.js') }}"></script>
@endsection