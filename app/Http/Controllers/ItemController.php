<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use App\Models\Payment;
use App\Models\Item;
use App\Models\Addressee;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use InterventionImage;

class ItemController extends Controller
{
    public function home(Request $request)
    {
        $user = Auth::user();
        $items = Item::latest()->get();
        $categories = Category::get();

        $word = $request->input('word');
        $query = Item::query();

        if(!empty($word)) {
            $query->where('title', 'like', '%'.$word.'%');
            $items = $query->get();
        }

        if(is_null($user)||($user->role=='member')){
            return view('home',compact('items','categories','word'));
        }
        
        if($user->role=='admin'){
            return view('admin.home',compact('items','categories','word'));
        }
    }

    public function showItem(Request $request, $id)
    {
        $item = Item::find($id);
        $category = Category::where('id','=',$item->category_id)->first();

        return view('item',compact('item','category'));
    }

    public function categoryItem($name)
    {
        $user = Auth::user();

        $categories = Category::get();
        $category = Category::where('name','=',$name)->first();
        $items = Item::whereCategory_id($category->id)->latest()->get();


        if(is_null($user)||($user->role=='member')){
            return view('home',compact('items','categories'));
        }
        
        if($user->role=='admin'){
            return view('admin.home',compact('items','categories'));
        }
    }

    public function editItem($id)
    {
        $item = Item::find($id);
        $category = Category::where('id','=',$item->category_id)->first();
        return view('admin.item',compact('item','category'));
    }

    public function fixItem($id)
    {
        $item = Item::find($id);
        $category = Category::where('id','=',$item->category_id)->first();

        return view('admin.fixItem',compact('item','category'));
    }

    public function storeItem(Request $request)
    {
        $action = $request->get('action');

        if($action == 'back'){
            if (isset($request->img_path)) {
                for ($i = 0; $i <= 4; $i++){
                    if(isset($request->img_path[$i])){
                    //Storage::disk('public')->delete($request->img_path[$i]);

                    //s3利用の場合
                    Storage::disk('s3')->delete($request->img_path[$i]);
                    }
                }
            }
        return redirect('/admin/item/store')->withInput();
        }

        if($action == 'submit'){
        $form['user_id'] =  Auth::id();
        $category = Category::where('name', $request->category)->first();

        $images = array();
        for ($i = 0; $i <= 4; $i++){
            if(isset($request->img_path[$i])){
                $images[$i] = $request->img_path[$i];
            }
            else{
                $images[$i] = null;
            }
        }

        Item::create([
            'category_id' => $category->id,
            'title' => $request->title,
            'price' => $request->price,
            'color' => $request->color,
            'size' => $request->size,
            'quantity' => $request->quantity,
            'part_number' => "$request->part_number",
            'info' => $request->info,
            'material' => $request->material,
            'img_path1' => $images[0],
            'img_path2' => $images[1],
            'img_path3' => $images[2],
            'img_path4' => $images[3],
            'img_path5' => $images[4],
            ]);
        return redirect()->route('home');
        }
    }


    public function updateItem(ItemRequest $request, $id)
    {
        $count = count($request->img_path);
        if($count >= 6){
            session()->flash('flash_message', 'アップロード枚数は最大5枚です');
            return back()->withInput();
        }

        $item = Item::find($id);
        $files = $request->file('img_path');

        $image[] = $item -> img_path1;
        $image[] = $item -> img_path2;
        $image[] = $item -> img_path3;
        $image[] = $item -> img_path4;
        $image[] = $item -> img_path5;
        if (isset($files)) {
            for ($i = 0; $i <= 4; $i++){
                if(isset($image[$i])){
                    //Storage::disk('public')->delete($image[$i]);

                    //s3利用の場合
                    Storage::disk('s3')->delete($image[$i]);
                }
            }
            foreach($files as $file){
            //$path = $file->store('img','public');
            //$fix_path[] = $path;

            //s3利用の場合
            $path = Storage::disk('s3')->putFile('item_img', $file, 'public');
            $fix_path[] = Storage::disk('s3')->url($path);
            }
        }

        $images = array();
        for ($i = 0; $i <= 4; $i++){
            if(isset($fix_path[$i])){
                $images[$i] = $fix_path[$i];
            }
            else{
                $images[$i] = null;
            }
        }

        $category = Category::where('name', $request->category)->first();

        $user['user_id'] =  Auth::id();
        $form = $item->fill([
            'category_id' => $category->id,
            'title' => $request->title,
            'price' => $request->price,
            'color' => $request->color,
            'size' => $request->size,
            'quantity' => $request->quantity,
            'part_number' => "$request->part_number",
            'info' => $request->info,
            'material' => $request->material,
            'img_path1' => $images[0],
            'img_path2' => $images[1],
            'img_path3' => $images[2],
            'img_path4' => $images[3],
            'img_path5' => $images[4],
        ])->save();

        return redirect()->route('home');
    }

    public function deleteItem($id)
    {
        $item = Item::find($id);
        $image[] = $item -> img_path1;
        $image[] = $item -> img_path2;
        $image[] = $item -> img_path3;
        $image[] = $item -> img_path4;
        $image[] = $item -> img_path5;
        if (isset($image)) {
            for ($i = 0; $i <= 4; $i++){
                if(isset($image[$i])){
                    //Storage::disk('public')->delete($image[$i]);

                    //s3利用の場合
                    Storage::disk('s3')->delete($image[$i]);
                }
            }
        }

        $item = Item::destroy($id);

        return redirect()->route('home');
    }

    public function createItem(Request $request)
    {
        $categories = Category::get();
        return view('admin.addItem', compact('categories'));
    }

    public function confirmItem(ItemRequest $request)
    {
        $count = count($request->img_path);
        if($count >= 6){
            session()->flash('flash_message', 'アップロード枚数は最大5枚です');
            return back()->withInput();
        }

        $inputs = $request->all();

        $files = $request->file('img_path');

        if (isset($files)) {
        foreach($files as $file){
        //$path = $file->store('img','public');
        //$images[] = $path;

        //s3利用の場合
        $path = Storage::disk('s3')->putFile('item_img', $file, 'public');
        $fix_path[] = Storage::disk('s3')->url($path);
        }

        return view('admin.confirmItem', compact(
            'inputs','images'
        ));
        }
    }

    public function cartList(Request $request)
    {
        $user = Auth::user();
        $request->session()->forget('back_url');

        if ($request->session()->has('cartData')) {
            $cartData = array_values($request->session()->get('cartData'));
        }

        if (!empty($cartData)) {
            $sessionitemId = array_column($cartData, 'session_item_id');
            
            $item = Item::whereIn('id',$sessionitemId)->get();
            foreach ($cartData as $index => &$data) {
                $data['title'] = $item[$index]->title;
                $data['part_number'] = $item[$index]->part_number;
                $data['color'] = $item[$index]->color;
                $data['size'] = $item[$index]->size;
                $data['price'] = $item[$index]->price;
                $data['img_path1'] = $item[$index]->img_path1;
                $data['itemPrice'] = $data['price'] * $data['session_quantity'];
                $total[] = $data['itemPrice'];
            }

            $totalData = array_sum($total);
            $totalAmount = $totalData + 250;
            $count = count($cartData);

            unset($data);
            return view('cart', compact('cartData','totalData','count','totalAmount',));
        } 
        else {
            return view('cart', compact('user'));
        }
    }


    public function addCart(Request $request)
    {
        $user = Auth::user();
        if(is_null($user)){
            return redirect()->route('login');
        }

        $cartData = [
            'session_item_id' => $request->item_id, 
            'session_quantity' => $request->quantity, 
        ];

        $item = Item::where('id','=',$cartData['session_item_id'])->first();
        $quantityItem = $item->quantity - $cartData['session_quantity'];
        $sessions = $request->session()->get('cartData');
        if($quantityItem < 0){
            return redirect()->back()->with('message', "※商品の在庫がありません。注文数をご確認ください。");
        }
        else if(!empty($sessions)){
            foreach ($sessions as $session){
                if($item->id == $session['session_item_id']){
                    $quantityItem = $item->quantity - $cartData['session_quantity'] - $session['session_quantity'];
                
                    if($quantityItem < 0){
                        return redirect()->back()->with('message', "※商品の在庫がありません。注文数をご確認ください。");
                    }
                }
            }
        }
        

        if (!$request->session()->has('cartData')) {
            $request->session()->push('cartData', $cartData);
        } else {
            $sessionCartData = $request->session()->get('cartData');

            $isSameItemId = false;
            foreach ($sessionCartData as $index => $sessionData) {
                if ($sessionData['session_item_id'] === $cartData['session_item_id'] ) {
                    $isSameItemId = true;
                    $quantity = $sessionData['session_quantity'] + $cartData['session_quantity'];

                    $request->session()->put('cartData.' . $index . '.session_quantity', $quantity);
                    break;
                }
            }

            if ($isSameItemId === false) {
                $request->session()->push('cartData', $cartData);
            }
        }

        $request->session()->put('user_id', ($user['id']));
        return redirect()->route('cartList');
    }

    public function updateCart(Request $request)
    {
        $sessionCartData = $request->session()->get('cartData');

        $updateCartItem = ['session_item_id' => $request->item_id];

        $CartItem = ['session_quantity' => $request->item_quantity];

        if($request->has('plus')){
            $item = Item::where('id','=',$updateCartItem)->first();
            if($item->quantity > $request->item_quantity){
                $updateData = $request->item_quantity + 1;
            }
            else{
                return redirect()->route('cartList')->with('message', "※商品の在庫がありません。注文数をご確認ください。");
            }
        }

        if($request->has('minus')){

            if($CartItem['session_quantity'] === "1"){
            return redirect()->route('cartList');
            }

            $updateData = $request->item_quantity - 1;
        }

        foreach ($sessionCartData as $index => $sessionData) {
            if ($sessionData['session_item_id'] === $updateCartItem['session_item_id'] ) {
                $request->session()->put('cartData.' . $index . '.session_quantity', $updateData);
                break;
            }
        }

        return redirect()->route('cartList');
    }

    public function removeCart(Request $request)
    {
        $sessionCartData = $request->session()->get('cartData');

        $removeCartItem = [
            ['session_item_id' => $request->item_id, 
            'session_quantity' => $request->item_quantity]
        ];

        $removeCompletedCartData = array_udiff($sessionCartData, $removeCartItem, function ($sessionCartData, $removeCartItem) {
            $result1 = $sessionCartData['session_item_id'] - $removeCartItem['session_item_id'];
            $result2 = $sessionCartData['session_quantity'] - $removeCartItem['session_quantity'];
            return $result1 + $result2;
        });

        $request->session()->put('cartData', $removeCompletedCartData);
        $cartData = $request->session()->get('cartData');

        if ($request->session()->has('cartData')) {
            return redirect()->route('cartList');
        }

        return view('cartList', ['user' => Auth::user()]);
    }
    
    public function orderItem(Request $request)
    {
        $user = Auth::user();
        $addressee = Addressee::where('user_id','=',$user->id )->first();

        $request->session()->put('back_url', 'order');

        if ($request->session()->has('cartData')) {
            $cartData = array_values($request->session()->get('cartData'));
        }

        $sessionitemId = array_column($cartData, 'session_item_id');
        
        $items = Item::whereIn('id',$sessionitemId)->get();
        foreach ($cartData as $index => &$data) {
            $data['title'] = $items[$index]->title;
            $data['part_number'] = $items[$index]->part_number;
            $data['color'] = $items[$index]->color;
            $data['size'] = $items[$index]->size;
            $data['price'] = $items[$index]->price;
            $data['img_path1'] = $items[$index]->img_path1;
            $data['itemPrice'] = $data['price'] * $data['session_quantity'];
            $total[] = $data['itemPrice'];
        }

        $totalData = array_sum($total);
        $totalAmount = $totalData + 250;
        $count = count($cartData);

        unset($data);

        if ($user->stripe_id){
        $defaultCard = Payment::getDefaultcard($user);

        return view('order', compact('cartData','totalData','count','totalAmount','user','items','addressee','defaultCard'));
        }
        
        else {
            $errors = "購入手続きにはクレジットカードを登録してください";
            return redirect()->route('infoPayment')->with('errors', $errors);
        }

        return view('order', compact('cartData','totalData','count','totalAmount','user','items','addressee','defaultCard'));
    }
}