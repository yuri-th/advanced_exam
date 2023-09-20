<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Manager;
use Illuminate\Http\Request;
use App\Http\Requests\ManagerRequest;

class ManagerController extends Controller
{
    public function manager(){
        return view('/manage/manager_manage');
    }

    public function create(ManagerRequest $request)
    {
        if ($request->get('action') === 'back') {
            return redirect()->route('form.show')->withInput();
        }

        $form = $request->only([
            'name',
            'shop',
            'area_id',
            'postcode',
            'address',
            'tel',
            'email'
        ]);

        $shop = Shop::where('name',$form['shop'])->first();
        $shop_id = $shop->id;
         
        Manager::create([
            'name' => $form['name'], 
            'shop_id' => $shop_id,
            'area_id' => $form['area_id'], 
            'postcode' => $form['postcode'],
            'address' => $form['address'],
            'tel' => $form['tel'],
            'email' => $form['email']
            ]);

        return view('/manage/manager_manage');
    }
}
