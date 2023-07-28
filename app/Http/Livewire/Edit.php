<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\QuotationItemDetails;
use App\Models\TechnicalSpecification;
use App\Models\Quotation;

class Edit extends Component
{
    public $count = 0;
    public $data;
    public $data1;
    public $data2;
    public function data(){
        $this->count++;
    }
    public function increment($id){
        $this->data = Quotation::where('id','=',$id)->get();
        $data = $this->data;
        $this->data1 = QuotationItemDetails::where('quotation_id','=',$id)->get();
        $this->data2 = TechnicalSpecification::where('quotation_id','=',$id)->get();
        return view('admin.quotation.edit',['data' => $data, 'data1' => $this->data1, 'data2' => $this->data2]);
    }
    public function render()
    {
        return view('livewire.edit');
    }
}
