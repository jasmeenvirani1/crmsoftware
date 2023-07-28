<?php

namespace App\Http\Livewire;

use App\Models\Quotation as Quotations;
use Livewire\Component;

class Quotation extends Component
{
    public $orderProducts = [];
    public $allProducts = [];

    public function mount()
    {
        $this->allProducts = Quotations::all();
        $this->orderProducts = [
            ['attribute_name' => '', 'attribute_value' => '']
        ];
    }

    public function addProduct()
    {
        $this->orderProducts[] = ['attribute_name' => '', 'attribute_value' => ''];
    }

    public function removeProduct($index)
    {
        unset($this->orderProducts[$index]);
        $this->orderProducts = array_values($this->orderProducts);
    }

    public function render()
    {
        info($this->orderProducts);
        return view('livewire.quotation');
    }
}
