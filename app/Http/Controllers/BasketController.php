<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function basket()
    {
        $orderId = session('orderId');
        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        }

        return view('basket', compact('order'));
    }

    public function basketPlace()
    {
        return view('order');
    }

    public function basketAdd($productId)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }

        if ($order->products->contains($productId)) {
            $orderPivot = $order->products()->where('product_id', $productId)->first()->pivot;
            $orderPivot->count++;
            $orderPivot->update();
        } else {
            $order->products()->attach($productId);
        }

        return redirect()->route('basket');
    }

    public function basketRemove($productId)
    {
       $orderId = session('orderId');
       if (is_null($orderId)) {
           return redirect()->route('basket');
       }
       $order = Order::find($orderId);

       if ($order->products->contains($productId)) {
           $orderPivot = $order->products()->where('product_id', $productId)->first()->pivot;
           if ($orderPivot->count > 1) {
               $orderPivot->count--;
               $orderPivot->update();
           } else {
               $order->products()->detach($productId);
           }
       }

       return redirect()->route('basket');
    }

    /*
     * Для тестирования git pull
     */
    public function basketRemove1($productId)
    {
       $orderId = session('orderId');
       if (is_null($orderId)) {
           return redirect()->route('basket');
       }
       $order = Order::find($orderId);

       if ($order->products->contains($productId)) {
           $orderPivot = $order->products()->where('product_id', $productId)->first()->pivot;
           if ($orderPivot->count > 1) {
               $orderPivot->count--;
               $orderPivot->update();
           } else {
               $order->products()->detach($productId);
           }
       }

       return redirect()->route('basket');
    }
}
