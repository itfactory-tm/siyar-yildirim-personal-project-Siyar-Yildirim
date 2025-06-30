<?php

namespace App\Livewire\User;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;

class History extends Component
{
    public $selectedOrders = [];
    public $selectAll = false;

    #[Layout('layouts.earthify', ['title' => 'Your order history', 'description' => 'Your order history'])]
    public function render()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with(['orderlines.product'])
            ->orderByDesc('created_at')
            ->get();

        return view('livewire.user.history', compact('orders'));
    }

    public function updatedSelectAll()
    {
        if ($this->selectAll) {
            $this->selectedOrders = $this->getOrders()->pluck('id')->toArray();
        } else {
            $this->selectedOrders = [];
        }
    }

    public function updatedSelectedOrders()
    {
        $this->selectAll = count($this->selectedOrders) === $this->getOrders()->count();
    }

    public function exportPDF()
    {
        $orders = $this->getSelectedOrders();

        if ($orders->isEmpty()) {
            session()->flash('error', 'Please select at least one order to export.');
            return;
        }

        $pdf = Pdf::loadView('exports.order-history-pdf', [
            'orders' => $orders,
            'user' => auth()->user(),
            'exportDate' => now()->format('F d, Y')
        ]);

        $filename = 'order-history-' . now()->format('Y-m-d') . '.pdf';

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $filename);
    }

    private function getOrders()
    {
        return Order::where('user_id', auth()->id())
            ->with(['orderlines.product'])
            ->orderByDesc('created_at')
            ->get();
    }

    private function getSelectedOrders()
    {
        if (empty($this->selectedOrders)) {
            return collect();
        }

        return Order::where('user_id', auth()->id())
            ->whereIn('id', $this->selectedOrders)
            ->with(['orderlines.product'])
            ->orderByDesc('created_at')
            ->get();
    }

    public function clearSelection()
    {
        $this->selectedOrders = [];
        $this->selectAll = false;
    }
}
