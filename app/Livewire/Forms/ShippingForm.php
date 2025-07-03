<?php

namespace App\Livewire\Forms;

use App\Helpers\Cart;
use App\Mail\OrderConfirmation;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\Mail;

class ShippingForm extends Form
{
    #[Validate('required')]
    public $address = null;
    #[Validate('required')]
    public $city = null;
    #[Validate('required|numeric')]
    public $zip = null;
    #[Validate('required')]
    public $country = null;
    public $notes = null;

    public function sendEmail($backorder)
    {
        $products = Cart::getProducts();
        $total = Cart::getTotalPrice();

        $data = [
            'products' => $products,
            'total' => $total,
            'address' => $this->address,
            'zip' => $this->zip,
            'city' => $this->city,
            'country' => $this->country,
            'notes' => $this->notes,
            'backorder' => $backorder,
        ];

        Mail::to(auth()->user())->send(new OrderConfirmation($data));
    }
}
