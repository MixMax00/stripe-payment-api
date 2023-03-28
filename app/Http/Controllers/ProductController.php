<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('product.index', compact('products'));
    }

    public function checkout(Request $request)
    {
        $stripe = new \Stripe\StripeClient('sk_test_51MogarBFc0hRvcBasy36pTbv5FaMIz2XM7q7vCVc4UMJGyonOXq0gZV8Hg9cIVEqgeUiQ7a4LKHLhNP1TRsmb6ie00hJfFgtHK');

        $lineItems = [];


        $products = Product::all();

        $totalPrice = 0;

        foreach($products as $product)
        {

            $totalPrice += $product->price;
            $lineItems[] = [
                'price_data' => [
                  'currency' => 'usd',
                  'product_data' => [
                    'name' => $product->name,
                  ],
                  'unit_amount' => $product->price * 100,
                ],
                'quantity' => 1,
            ];
        }



        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success',[], true)."?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('checkout.cancel',[], true),
        ]);

        $order = new Order();
        $order->payment_id = $checkout_session->id;
        $order->status = "unpaid";
        $order->status = "Product";
        $order->total_price = $totalPrice;
        $order->quantity = 3;
        $order->save();

        return redirect($checkout_session->url);
    }

    public function success(Request $request)
    {

        $stripe = new \Stripe\StripeClient('sk_test_51MogarBFc0hRvcBasy36pTbv5FaMIz2XM7q7vCVc4UMJGyonOXq0gZV8Hg9cIVEqgeUiQ7a4LKHLhNP1TRsmb6ie00hJfFgtHK');


        $sessionId = $request->get('session_id');

        $session = $stripe->checkout->sessions->retrieve($sessionId);

        if($session){
            throw new NotFoundHttpException;
        }

        $customer = $stripe->customers->retrieve($session->customer);
        return view('product.success', compact($customer));

    }

    public function cancel()
    {
        return "cancel";
    }
}
