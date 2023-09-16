@extends('layouts.app_m')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shopmanage.css') }}">
@endsection

@section('content')
<div class="shop__information">
  <div class="section__title">
    <h2>新規作成</h2>
  </div>
  <div class="create-form__item">
    <form class="create-form" action="/manage/shopmanage" method="post">
      @csrf
      <div class="create-form__item-parts">
        <label for="create__form" class="form-title">店舗名</label>
        <input class="create-form__item-input" type="text" name="name" />
      </div>
      <div class="create-form__item-parts">
        <label for="create__form" class="form-title">エリア</label>
        <select class="create-form__item-select" name="area_id">
          <option value="">Area</option>
          <option value="1">東京都</option>
          <option value="2">大阪府</option>
          <option value="3">福岡県</option>
        </select>
      </div>
      <div class="create-form__item-parts">
        <label for="create__form" class="form-title">ジャンル</label>
        <select class="create-form__item-select" name="genre_id">
          <option value="">Genre</option>
          <option value="1">寿司</option>
          <option value="2">焼肉</option>
          <option value="3">居酒屋</option>
          <option value="4">イタリアン</option>
          <option value="5">ラーメン</option>
        </select>
      </div>
      <div class="create-form__item-parts">
        <label for="create__form" class="form-title">画像URL</label>
        <input class="create-form__item-image" type="url" name="image_url" />
      </div>
      <div class="create-form__item-parts">
        <label for="create__form" class="form-title">店舗詳細</label>
        <textarea class="create-form__item-textarea" type="text" name="description"></textarea>
      </div>
      <div class="create-form__button">
        <button class="create-form__button-submit" type="submit">作成</button>
      </div>
    </form>
  </div>

  <!-- 予約状況 -->
  <div class=shop__list>
    <div class="table-page">
      <div>
        @if (count($shop_infos) > 0)
        <p>全{{ $shop_infos->total() }}件中
          {{ ($shop_infos->currentPage() - 1) * $shop_infos->perPage() + 1 }}〜
          {{ ($shop_infos->currentPage() - 1) * $shop_infos->perPage() + 1 + (count($shop_infos) - 1) }}件</p>
        @else
        <p>データがありません。</p>
        @endif
      </div>
      <div>
        {{ $shop_infos->appends(request()->input())->links('pagination::bootstrap-4') }}
      </div>
    </div>
    <table class="shop__table">
      <tr class="table-title">
        <th>店名</th>
        <th>エリア</th>
        <th>ジャンル</th>
        <th>イメージ</th>
        <th>詳細</th>
        <th></th>
      </tr>
      @foreach($shop_infos as $shop_info )
      <form action="/manage/shopmanage/update" method="PATCH">
        @csrf
        @method('PATCH')
        <tr>
          <input type="hidden" name="firstPage" value="">
          <input type="hidden" name="currentPage" value="">
          <input type="hidden" name="shop_id" value="{{$shop_info->id}}">
          <td><input type="text" name="name" value="{{ $shop_info->name }}" /></td>
          <td><input type="text" name="area" value="{{ $shop_info->getArea() }}" /></td>
          <td><input type="text" name="genre" value="{{ $shop_info->getGenre() }}" /></td>
          <td><input type="text" name="image_url" value="{{ $shop_info->image_url }}" /></td>
          <td><input type="text" name="description" value="{{ $shop_info->description }}" /></td>
          <td class="update"><button type="submit">更新</button></td>
        </tr>
      </form>
      @endforeach
    </table>
  </div>
</div>
@endsection