<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {   
        $shop_cards = Shop::all();
        return view('index',['shop_cards' => $shop_cards]);
    }
    
    public function detail(Shop $shop)
    {   
        $shop_record = Shop::where('id',$shop->id)->get();
        return view('detail',['shop_records' => $shop_record]);       
    }

    // エリア検索
    public function search_area(Request $request)
    {
        $shop_cards = Shop::with('areas')->AreaSearch($request->area_id)->get();
        return view('index',['shop_cards' => $shop_cards]);
    }

    // ジャンル検索
    public function search_genre(Request $request)
    {
        $shop_cards = Shop::with('genres')->GenreSearch($request->genre_id)->get();
        return view('index',['shop_cards' => $shop_cards]);
    }

    // 店名検索
    public function search_name(Request $request)
    {
        $shop_cards = $shop_cards = Shop::KeywordSearch($request->name)->get();
        return view('index',['shop_cards' => $shop_cards]);
    }
    
}
