<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function infoPayment(Request $request)
    {
        $user = Auth::user();
        $defaultCard = Payment::getDefaultcard($user);

        return view('payment.info',  compact('user', 'defaultCard'));
    }

    public function createPayment(Request $request)
    {
        return view('payment.form');
    }

    public function storePayment(Request $request)
    {
        $token = $request->stripeToken;
        $user = \Auth::user();
        $ret = null;

        if ($token) {

            if (!$user->stripe_id) {
                $result = Payment::setCustomer($token, $user);

                /* card error */
                if(!$result){
                    $errors = "カード登録に失敗しました。入力いただいた内容に相違がないかを確認いただき、問題ない場合は別のカードで登録を行ってみてください。";
                    return redirect()->route('infoPayment')->with('errors', $errors);
                }

            } else {
                $defaultCard = Payment::getDefaultcard($user);
                if (isset($defaultCard['id'])) {
                    Payment::deleteCard($user);
                }

                $result = Payment::updateCustomer($token, $user);

                /* card error */
                if(!$result){
                    $errors = "カード登録に失敗しました。入力いただいた内容に相違がないかを確認いただき、問題ない場合は別のカードで登録を行ってみてください。";
                    return redirect()->route('infoPayment')->with('errors', $errors);
                }

            }
        } else {
            return redirect()->route('infoPayment')->with('errors', '申し訳ありません、通信状況の良い場所で再度ご登録をしていただくか、しばらく立ってから再度登録を行ってみてください。');
        }

        $session = $request->session()->get('back_url');
        $request->session()->forget('back_url');
        
        if($session == 'member'){
            return redirect()->route('infoPayment')->with("success", "カード情報の登録が完了しました。");
        }

        if($session == 'order'){
            return redirect()->route('cartList');
        }
    }

    public function destroyPayment(){
        $user = Auth::user();

        $result = Payment::deleteCard($user);

        if($result){
            return redirect()->route('infoPayment')->with('success', 'カード情報の削除が完了しました。');
        }else{
            return redirect()->route('infoPayment')->with('errors', 'カード情報の削除に失敗しました。恐れ入りますが、通信状況の良い場所で再度お試しいただくか、しばらく経ってから再度お試しください。');
        }
    }
}