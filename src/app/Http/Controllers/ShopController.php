<?php

namespace App\Http\Controllers;
use App\Models\Like;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ShopController extends Controller
{
    public function index(Request $request)
    {   
        $shop_cards = Shop::all();

        $user = Auth::id();    
        $favorite_shops= Like::where('user_id', $user)->get();
        
        return view('index',['shop_cards' => $shop_cards],['favorite_shops' => $favorite_shops]);
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
        $user = Auth::id(); 
        $favorite_shops= Like::where('user_id', $user)->get();
        return view('index',['shop_cards' => $shop_cards],['favorite_shops' => $favorite_shops]);
    }

    // ジャンル検索
    public function search_genre(Request $request)
    {
        $shop_cards = Shop::with('genres')->GenreSearch($request->genre_id)->get();
        $user = Auth::id(); 
        $favorite_shops= Like::where('user_id', $user)->get();
        return view('index',['shop_cards' => $shop_cards],['favorite_shops' => $favorite_shops]);
    }

    // 店名検索
    public function search_name(Request $request)
    {
        $shop_cards = $shop_cards = Shop::KeywordSearch($request->name)->get();
        $user = Auth::id(); 
        $favorite_shops= Like::where('user_id', $user)->get();
        return view('index',['shop_cards' => $shop_cards],['favorite_shops' => $favorite_shops]);
    }
    
}
