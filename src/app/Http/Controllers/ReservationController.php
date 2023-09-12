<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function create(Request $request)
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
        
        return redirect('/mypage'); 
    }
}
