<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Payment extends Model
{
    use HasFactory;

    public static function setCustomer($token, $user)
    {
        \Stripe\Stripe::setApiKey(\Config::get('payment.stripe_secret'));

        //Stripe上に顧客情報をtokenを使用することで保存
        try {
            $customer = \Stripe\Customer::create([
                'card' => $token,
                'email'  => $user->email,
                'name' => $user->name,
                'description' => $user->id
            ]);
        } catch(\Stripe\Exception\CardException $e) {

            return false;
        }

        $targetCustomer = null;
        if (isset($customer->id)) {
            $targetCustomer = User::find(\Auth::id());
            $targetCustomer->stripe_id = $customer->id;
            $targetCustomer->update();
            return true;
        }
        return false;
    }

    public static function updateCustomer($token, $user)
    {
        \Stripe\Stripe::setApiKey(\Config::get('payment.stripe_secret'));

        try {
            $customer = \Stripe\Customer::create([
                'card' => $token,
                'email'  => $user->email,
                'name' => $user->name,
                'description' => $user->id
            ]);
        } catch(\Stripe\Exception\CardException $e) {

            return false;
        }
        $targetCustomer = null;
        if (isset($customer->id)) {
            $targetCustomer = User::find(\Auth::id());
            $targetCustomer->stripe_id = $customer->id;
            $targetCustomer->update();

            return true;
        }
        return false;
    }

    protected static function getDefaultcard($user)
    {
        \Stripe\Stripe::setApiKey(\Config::get('payment.stripe_secret'));

        $default_card = null;

        if (!is_null($user->stripe_id)) {
            $customer = \Stripe\Customer::retrieve($user->stripe_id);
            if (isset($customer['default_source']) && $customer['default_source']) {

                $card = \Stripe\PaymentMethod::all(['customer' => $user->stripe_id, 'type' => 'card'])->data[0];
                $default_card = [
                    'number' => str_repeat('*', 8) . $card->card->last4,
                    'brand' => $card->card->brand,
                    'exp_month' => $card->card->exp_month,
                    'exp_year' => $card->card->exp_year,
                    'name' => $card->billing_details->name,
                    'id' => $card->id,
                ];
            }
        }
        return $default_card;
    }

    protected static function deleteCard($user)
    {
        \Stripe\Stripe::setApiKey(\Config::get('payment.stripe_secret'));
        $stripe = new \Stripe\StripeClient(\Config::get('payment.stripe_secret'));
        $card = \Stripe\PaymentMethod::all(['customer' => $user->stripe_id, 'type' => 'card'])->data[0];

        /* card情報が存在していれば削除 */
        if ($card) {
            $stripe->customers->delete(
            $user->stripe_id,
            []
            );
            $targetCustomer = User::find(\Auth::id());
            $targetCustomer->stripe_id = NULL;
            $targetCustomer->update();
            return true;
        }
        return false;
    }
}