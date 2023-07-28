<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\QuotationItemDetails;
use App\Models\TechnicalSpecification;
use App\Models\Quotation;

class Category extends Component
{
    public $data,$data1,$data2;
    public function data($id){
        $this->id = $id;
        $this->data = Quotation::where('id','=',$id)->get(); 
        $this->data1 = QuotationItemDetails::where('quotation_id','=',$id)->get();
        $this->data2 = TechnicalSpecification::where('quotation_id','=',$id)->get();
        return view('admin.quotation.edit',['id' =>$this->id ,'data' => $this->data ,'data1' => $this->data1, 'data2' => $this->data2]);
    }
    public function render($id)
    {
        // $this->data = Quotation::where('id','=',$id)->get();
        // $this->data1 = QuotationItemDetails::where('quotation_id','=',$id)->get();
        // $this->data2 = TechnicalSpecification::where('quotation_id','=',$id)->get();
        return view('livewire.category');
    }
}
