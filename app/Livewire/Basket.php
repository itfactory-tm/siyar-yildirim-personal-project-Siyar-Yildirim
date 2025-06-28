<?php

namespace App\Livewire;

use App\Helpers\Cart;
use App\Livewire\Forms\ShippingForm;
use App\Models\Order;
use App\Models\Orderline;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class Basket extends Component
{
    public $backorder = [];
    public $showModal = false;
    public ShippingForm $form;

    public function checkoutForm()
    {
        $this->form->reset();
        $this->resetErrorBag();
        $this->showModal = true;
        // for debugging only
        $this->form->address = 'Kleinhoestraat 4';
        $this->form->city = 'Geel';
        $this->form->zip = '2440';
        $this->form->country = 'Belgium';
        $this->form->notes = "Please leave the package at the back door.\nThank you.";
    }

    public function checkout()
    {
        // validate the form
        $this->form->validate();
        // hide the modal
        $this->showModal = false;
        // check if there are records in backorder
        $this->updateBackorder();

        // add the product to the database
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'total_price' => Cart::getTotalPrice(),
        ]);

        // loop over the product in the basket and add them to the orderlines table
        foreach (Cart::getProducts() as $product) {
            Orderline::create([
                'order_id' => $order->id,
                'product_id' => $product['id'],
                'product_name' => $product['name'],
                'unit_price' => $product['price'],
                'line_total' => $product['price'] * $product['qty'],
                'quantity' => $product['qty'],
            ]);


            // update the stock
            $updateQty = Product::findOrFail($product['id']);
            $updateQty->stock > $product['qty']
                ? $updateQty->stock -= $product['qty']
                : $updateQty->stock = 0;
            $updateQty->save();
        }

        // send confirmation email to the user and to the administrators
        $this->form->sendEmail($this->backorder);

        // reset the form, backorder array and error bag
        $this->form->reset();
        $this->reset('backorder');
        $this->resetErrorBag();
        // empty the cart
        Cart::empty();
        $this->dispatch('basket-updated');
        // show a confirmation message
    }

    public function emptyBasket()
    {
        Cart::empty();
        $this->dispatch('basket-updated');
    }

    public function decreaseQty(Product $product)
    {
        Cart::delete($product);
        $this->dispatch('basket-updated');
    }

    public function increaseQty(Product $product)
    {
        Cart::add($product);
        $this->dispatch('basket-updated');
    }

    public function updateBackorder()
    {
        $this->backorder = [];
        // loop over records in basket and check if qty > in stock
        foreach (Cart::getKeys() as $id) {
            $qty = Cart::getOneProduct($id)['qty'];
            $product = Product::findOrFail($id);
            $shortage = $qty - $product->stock;
            if ($shortage > 0)
                $this->backorder[] = $shortage . ' x ' . $product->name;
        }
    }

    #[On('basket-updated')]
    #[Layout('layouts.earthify', ['title' => 'Your shopping basket', 'description' => 'Your shopping basket',])]
    public function render()
    {
        $this->updateBackorder();

        return view('livewire.basket', [
            'totalQty' =>Cart::getTotalQty(),
            'totalPrice' => Cart::getTotalPrice(),
            'products' => Cart::getProducts(),
        ]);
    }
}
