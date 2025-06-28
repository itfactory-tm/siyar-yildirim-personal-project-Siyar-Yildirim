<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;

    #[Layout('layouts.earthify', ['title' => 'Orders Overview', 'description' => 'All orders overview for admin'])]
    public function render()
    {
        $orders = Order::with(['orderlines.product', 'user'])
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('livewire.admin.orders', compact('orders'));
    }
}
