@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
<div class="review-content">
    <h2>{{$shop_name}}のレビュー</h2>

    <div class="review-table">
        @foreach ($reviews as $review)
        <table>
            <tr>
                <th>名前</th>
                <td>{{$review->name}}</td>
            </tr>
            <tr>
                <th>評価</th>
                <td class="td-stars">
                    @if ($review->stars == 5)
                    ★★★★★
                    @elseif ($review->stars == 4)
                    ★★★★☆
                    @elseif ($review->stars == 3)
                    ★★★☆☆
                    @elseif ($review->stars == 2)
                    ★★☆☆☆
                    @else
                    ★☆☆☆☆
                    @endif
                </td>
            </tr>
            <tr>
                <th>コメント</th>
                <td>{{$review->comment}}</td>
            </tr>
        </table>
        @endforeach
    </div>
    <div class="review__alert">
        @if(session('new_message'))
        <div class="alert">
            {{ session('new_message') }}
        </div>
        @endif

        @if(session('error_message'))
        <div class="alert">
            {{ session('error_message') }}
        </div>
        @endif

        @if(session('error_message-null'))
        <div class="alert">
            {{ session('error_message-null') }}
        </div>
        @endif
    </div>
    <div class="review-form">
        <form class="review-create" action="/review/post" method="post">
            @csrf
            <div class="review-form__table">
                <table class="review-post">
                    <tr>
                        <th>名前</th>
                        <td class="table-name"><input type="text" name="name" value="{{ old('name')}}" />
                            @error('name')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th>評価</th>
                        <td>
                            <select name="stars">
                                <option value=""></option>
                                <option value="1">&#9733</option>
                                <option value="2">&#9733&#9733</option>
                                <option value="3">&#9733&#9733&#9733</option>
                                <option value="4">&#9733&#9733&#9733&#9733</option>
                                <option value="5" selected>&#9733&#9733&#9733&#9733&#9733</option>
                            </select>
                            @error('stars')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th>コメント</th>
                        <td><textarea type="text" name="comment">{{ old('description')}}</textarea>
                            @error('comment')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
                        </td>
                    </tr>
                </table>
            </div>
            <div class="review-btn"><button type="submit">レビューを投稿する</button></div>
            <input type="hidden" name="shop_name" value="{{$shop_name}}" />
        </form>
    </div>
</div>
@endsection