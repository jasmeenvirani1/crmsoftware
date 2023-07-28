<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Quotation;
use App\Models\Customer;
use Carbon\Carbon;

class Quotations extends Component
{
    public $count = 0;
    public $count1 = 0;
    public $c=0;

    public function mount()
    {   
        $currentDateTime = Carbon::now();
        $this->newDateTime = Carbon::now()->addDay(5);
        $demo = rand(1000,9999);
        $this->data = "LPM" .$demo;
        $this->customer = Customer::get();
        // $this->data = Quotation::get();
    }
    public function increment()
    {   $this->count++;
    }
    public function customer()
    {   $this->c++;
    }
    public function increment1()
    {   $this->count1++;
    }
    public function render()
    {
        return view('livewire.quotations');
    }
}
