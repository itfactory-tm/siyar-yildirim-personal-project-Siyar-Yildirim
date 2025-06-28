<?php

namespace App\Livewire\Partials;

use App\Helpers\Cart;
use Livewire\Attributes\On;
use Livewire\Component;

class MiniBasket extends Component
{
    public int $totalQty = 0;

    #[On('basket-updated')]
    public function updateBasket()
    {
        $this->totalQty = Cart::getTotalQty();
    }

    public function mount()
    {
        $this->totalQty = Cart::getTotalQty();
    }

    public function render()
    {
        return view('livewire.partials.mini-basket', ['totalQty' => $this->totalQty]);
    }
}
