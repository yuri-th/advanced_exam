@extends('layouts.app_m')

@section('css')
@endsection

@section('content')
<div class="shop__information">
  <div class="section__title">
    <h2>新規作成</h2>
  </div>
  <form class="create-form" action="" method="post">
    @csrf
    <div class="create-form__item">
      <input class="create-form__item-input" type="text" name="name" value="店舗名" />
      <select class="create-form__item-select">
        <option value="">Area</option>
      </select>
      <select class="create-form__item-select">
        <option value="">Genre</option>
      </select>
      <input class="create-form__item-input" type="text" name="shop_image" value="イメージ画像" />
      <input class="create-form__item-input" type="text" name="description" value="店舗詳細" />
    </div>

    <div class="create-form__button">
      <button class="create-form__button-submit" type="submit">作成</button>
    </div>
  </form>
</div>
@endsection