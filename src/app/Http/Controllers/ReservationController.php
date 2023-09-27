<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\ReservationRequest;
use Illuminate\Support\Facades\Mail; 
use App\Mail\ReserveMail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class ReservationController extends Controller
{
    public function create(ReservationRequest $request)
    {
        $shop = request('shop_id');  
        $user = Auth::id();
        $number = intval($request->input('number'));
        $date = new Carbon(request('reservation_date'));
        $start_at = new Carbon(request('time'));
         
            Reservation::create([
                'shop_id' => $shop,
                'user_id' => $user,
                'num_of_users' => $number,
                'date'=>$date,
                'start_at' =>$start_at,               
            ]);

            return view('/done',compact('shop'));
    }
    
    // 予約の取り消し
    public function delete(Request $request)
    {   
        $user = Auth::id();
        Reservation::with('users')->where('user_id', $user)->where('id',$request->id)->delete();
        
        return redirect('/mypage')->with('message', 'ご予約をキャンセルしました');
    }

    // 予約の更新
    public function update(Request $request)
    {
        $user = Auth::id();
        $date = $request->input('date');
        $time = $request->input('start_at'); 
        $number = $request->input('num_of_users');

        Reservation::with('users')
        ->where('user_id', $user)
        ->where('id', $request->id)
        ->update([
        'date' => $date, // 日付の更新
        'start_at' => $time, // 時間の更新
        'num_of_users' => $number, // 人数の更新
        ]);

        return redirect('/mypage')->with('message', 'ご予約を変更しました');
    }

    // 管理ページ

    public function reserveManage()
    {
        $shop_reserves = Reservation::paginate(5);
        return view('/manage/reserve_manage',['shop_reserves' => $shop_reserves]);
    }

    public function search_reserve(Request $request)
    {
        if($request->name !== null && $request->area_id == null){
            $shop = Shop::KeywordSearch($request->name)->pluck('id')->toArray();
            $shop_reserves = Reservation::whereIn('shop_id', $shop)->paginate(5);
            return view('/manage/reserve_manage', ['shop_reserves' => $shop_reserves]);
        }else if ($request->name == null && $request->area_id !== null) {
            $shop = Shop::where('area_id', $request->area_id)->pluck('id')->toArray();
            $shop_reserves = Reservation::whereIn('shop_id', $shop)->paginate(5);
            return view('/manage/reserve_manage', ['shop_reserves' => $shop_reserves]);
        } else {
            $shop = Shop::KeywordSearch($request->name)->where('area_id', $request->area_id)->pluck('id')->toArray();
            $shop_reserves = Reservation::whereIn('shop_id', $shop)->paginate(5);
            return view('/manage/reserve_manage', ['shop_reserves' => $shop_reserves]);            
        }
    }

    // 利用者へのメール送信
    public function mail(Request $request) {
    $user_id = $request->only(['user_id']);
    $user = User::find($user_id['user_id']);
    $name = $user->name;
    $shop_id=$request->only(['shop_id']);
    $shop = Shop::find($shop_id['shop_id']);
    $shop_name = $shop->name;
    
    $reserve_id=$request->only(['id']);
    $reservation = Reservation::where('id', $reserve_id)->first();
    $reserve_date = $reservation->date;
    $reserve_time = substr($reservation->start_at,0,5);
    $reserve_number = $reservation->num_of_users;
    
    // $qrcode=QrCode::size(200)->generate($reserve_id);

    Mail::send(new ReserveMail($name,$shop_name,$reserve_date,$reserve_time,$reserve_number));
    return redirect('/manage/reserve_manage');
    }
}  
