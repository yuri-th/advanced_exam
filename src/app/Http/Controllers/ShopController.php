<?php

namespace App\Http\Controllers;
use App\Models\Like;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reservation;
use App\Models\ShopReview;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ShopRequest;


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

    public function upload_image(Request $request)
    {   
        $dir = 'images';
         // アップロードされたファイル名を取得
        $file_name = $request->file('image')->getClientOriginalName();
        // 取得したファイル名で保存
        $request->file('image')->storeAs('public/' . $dir, $file_name);
        return redirect('/upload/upload');
    }

    // 店舗管理：店舗情報の表示

    public function shopmanage()
    {
        $shop_infos = Shop::paginate(10);
        return view('/manage/shop_manage',['shop_infos' => $shop_infos]);
    }

    // 店舗情報の作成
    public function create(ShopRequest $request)
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
        return redirect('/manage/shop_manage')->with('new_message', '店舗情報を作成しました');
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
            return redirect($request->firstPage)->with('new_message', '店舗情報を更新しました');
        } else {
            return back()->with('new_message', '店舗情報を更新しました');
        }
    }

    public function search_shop(Request $request)
    {
        if($request->name !== null && $request->area_id == null){
            $shop_infos = Shop::KeywordSearch($request->name)->paginate(10);
            return view('/manage/shop_manage',['shop_infos' => $shop_infos]);
        }else if($request->name == null && $request->area_id !== null){
            $shop_infos = Shop::with('areas')->AreaSearch($request->area_id)
            ->paginate(10);
            return view('/manage/shop_manage',['shop_infos' => $shop_infos]);
        } else {
            $shop_infos = Shop::with('areas')->AreaSearch($request->area_id)->KeywordSearch($request->name)->paginate(10);
            return view('/manage/shop_manage',['shop_infos' => $shop_infos]);
        }
    }


    // レビュー機能
    public function review(Request $request) {
        $user = Auth::id();
        $shop_id=$request->only(['shop_id']);
        $shop = Shop::where('id',$shop_id)->first();
        $shop_name = $shop->name;
        $reviews = ShopReview::where('user_id', $user)->where('shop_id', $shop_id)->get();
        
        return view('/review',['shop_name' => $shop_name],['reviews' => $reviews]);
    }

    // レビュー投稿
    public function review_post(Request $request) {

        $review = $request->only([
            'user_name',
            'stars',
            'comment',
            'shop_name',
        ]);

        $user = Auth::id();
        $shop_name = $review['shop_name'];
        $shop = Shop::Where('name', $shop_name)->first();
        $shop_id = $shop->id;
        
        if ($user) {
            $reservation = Reservation::with('shops')->Where('shop_id', $shop_id)->where('user_id', $user)->first(); 
        }

        if ($reservation) {
        $reservationDate = $reservation->date;
        $currentDate = Carbon::now(); 
        
        // 予約日を過ぎている場合
        if ($currentDate->greaterThan($reservationDate)) {
        $name = $review['user_name'];
        $stars = $review['stars'];
        $comment = $review['comment'];
        
        ShopReview::create([
            'name' => $name,
            'shop_id' => $shop_id,
            'user_id' => $user,
            'stars'=>$stars,
            'comment'=>$comment      
            ]);
        return redirect()->back()->with('new_message','レビューを投稿しました！');
            
        }else if($currentDate->lessThan($reservationDate)){
        // 予約日を過ぎていない場合の処理
        return redirect()->back()->with('error_message','レビューはご予約日を過ぎてからご投稿いただけます');
        }
        } else {
        return redirect()->back()->with('error_message-null','ご予約情報が見つかりません');
        }
    }
}