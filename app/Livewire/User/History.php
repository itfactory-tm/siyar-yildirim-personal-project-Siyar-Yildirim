<?php

namespace App\Livewire\User;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;

class History extends Component
{
    #[Layout('layouts.earthify', ['title' => 'Your order history', 'description' => 'Your order history'])]
    public function render()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with(['orderlines.product'])
            ->orderByDesc('created_at')
            ->get();

        return view('livewire.user.history', compact('orders'));
    }
}
