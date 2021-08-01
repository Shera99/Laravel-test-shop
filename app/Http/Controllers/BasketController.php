<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function basket()
    {
        $orderId = session('orderId');
        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        }

        return isset($order) ? view('basket', compact('order')) : view('basket');
    }

    public function basketPlace()
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('index');
        } else {
            $order = Order::findOrFail($orderId);
            return view('order', compact('order'));
        }
    }

    public function basketConfirm(Request $request)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('index');
        }
        $order = Order::find($orderId);
        $response = $order->saveOrder($request->name, $request->phone, $request->email);

        if ($response) {
            session()->flash('success', 'Ваш заказ принят в обработку!');
        } else {
            session()->flash('warning', 'Ошибка! Заказ не был принят в обработку.');
        }

        return redirect()->route('index');
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

        $productName = Product::find($productId)->name;
        session()->flash('add_basket', 'Товар '.$productName.' добавлен в корзину!');

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
               session()->forget('orderId');
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
