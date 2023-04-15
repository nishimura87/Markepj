<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function order(Request $request){
        
        \Stripe\Stripe::setApiKey(\Config::get('payment.stripe_secret'));

        $user = Auth::user();
        $user_id = $user->id;
        $code = str_pad(rand(0,99999999),8,0, STR_PAD_LEFT);
        session()->put('code',$code);

        $sessionCartData = $request->session()->get('cartData');
        foreach ($sessionCartData as $sessionData) {
            
            $items = Item::where('id','=',$sessionData['session_item_id'])->get();
            foreach ($items as $index => $CartData) {
                
                $quantity = $CartData->quantity - $sessionData['session_quantity'];
                $CartData->quantity = $quantity;
                $CartData->save();

                if($request->postcode){
                Order::create([
                    'item_id' => $CartData->id,
                    'price' => $CartData->price,
                    'quantity' => $sessionData['session_quantity'],
                    'postcode' => $request->postcode,
                    'address' => $request->address,
                    'building' => $request->building,
                    'order_number' => "$code",
                ]);
                }
                else{
                Order::create([
                    'item_id' => $CartData->id,
                    'price' => $CartData->price,
                    'quantity' => $sessionData['session_quantity'], 
                    'address' => $user->postcode,
                    'postcode' => $user->address,
                    'building' => $user->building,
                    'order_number' => "$code",
                ]);

                }
                $order = new Order;
                $order = Order::orderBy('id','desc')->first();
                $order->users()->attach($user_id);
            }
        }
        
        try {
            $orderOject = [
                'amount'      => $request->total,
                'currency'    => 'jpy',
                'customer'    => $user->stripe_id,
            ];

            $order = \Stripe\Charge::create($orderOject);

        } catch (\Stripe\Exception\CardException $e) {
            $body = $e->getJsonBody();
            $errors  = $body['error'];

            return redirect()->route('cartList')->with('errors', "決済に失敗しました。しばらく経ってから再度お試しください。");
        }

        return redirect()->route('completeOrder');
    }

    public function completeOrder(Request $request){

        $code = session()->get('code');
        $orders = Order::where('order_number', '=',$code)->get();
        foreach($orders as $order){
            $total[] = $order->quantity * $order->price;
        }
        $totalData = array_sum($total)+250;
        
        $date = Carbon::now()->format("Y/m/d H:i:s");
        $user = Auth::user();
        $email = $user->email;
        $emailAddmin = 'marke.b.2023@gmail.com';
        $addressee = $user->addressees()->first();
        $defaultCard = Payment::getDefaultcard($user);

        Mail::send('orderSendmail', [
            'user' => $user,
            'addressee' => $addressee,
            'code' => "$code",
            'orders' => $orders,
            'totalData' => $totalData,
            'defaultCard' => $defaultCard
        ], function ($message) use ($email) {
            $message->to($email)
                ->subject('ご注文完了のご連絡(自動送信メール)');
        });

        Mail::send('orderReceivemail', [
            'user' => $user,
            'addressee' => $addressee,
            'code' => "$code",
            'orders' => $orders,
            'totalData' => $totalData,
            'defaultCard' => $defaultCard
        ], function ($message) use ($emailAddmin) {
            $message->to($emailAddmin)
                ->subject('ご注文完了のご連絡(自動送信メール)');
        });

        $request->session()->forget('code');
        $request->session()->forget('cartData');

        

    return view('member.completeOrder',compact('date','user','code'));

    }
}
