<?php

namespace App\Http\Controllers;
use App\Models\Like;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
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

    //店舗画像の追加・表示
    
    public function upload()
    {
        return view('/upload/upload');
    }

    // 店舗管理：店舗情報の表示

    public function shopmanage()
    {
        $shop_infos = Shop::paginate(10);
        return view('/manage/shop_manage',['shop_infos' => $shop_infos]);
    }

    // 店舗情報の作成
    public function create(Request $request)
    {
        if ($request->get('action') === 'back') {
            return redirect()->route('shopmanage')->withInput();
        }

        $info = $request->only([
            'name',
            'area_id',
            'genre_id',
            'image_url',
            'description',
        ]);

        Shop::create($info);
        return redirect('/manage/shop_manage');
    }

    // 店舗情報の更新
    public function update(Request $request)
    {
        $shop_id = $request->only(['shop_id']);
        $name= $request->input('name');
        $area = $request->input('area');
        $area_id = Area::where('name', $area)->pluck('id')->first();
        $genre = $request->input('genre'); 
        $genre_id = Genre::where('name', $genre)->pluck('id')->first();
        $image_url = $request->input('image_url');
        $description = $request->input('description');

        Shop::where('id', $shop_id)->update([
        'name' => $name, 
        'area_id' => $area_id,
        'genre_id' => $genre_id, 
        'image_url'  => $image_url, 
        'description'  => $description, 
        ]);

        if ($request->currentPage == 1) {
            return redirect($request->firstPage);
        } else {
            return back();
        }
    }

    public function search_shop(Request $request)
    {
        if ($request->name !== null && $request->area_id !== null) {
            $shop_infos = Shop::with('areas')->AreaSearch($request->area_id)->KeywordSearch($request->name)->paginate(10);
            return view('/manage/shop_manage',['shop_infos' => $shop_infos]);
        }else if($request->name !== null && $request->area_id == null){
            $shop_infos = Shop::KeywordSearch($request->name)->paginate(10);
            return view('/manage/shop_manage',['shop_infos' => $shop_infos]);
        }else if($request->name == null && $request->area_id !== null){
            $shop_infos = Shop::with('areas')->AreaSearch($request->area_id)
            ->paginate(10);
            return view('/manage/shop_manage',['shop_infos' => $shop_infos]);
        } 
    }

}
