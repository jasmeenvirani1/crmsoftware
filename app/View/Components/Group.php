<?php

namespace App\View\Components;

use App\Models\Group as ModelsGroup;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Group extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $data;
    public $select_id;
    public function __construct($data = null)
    {
        $this->data = ModelsGroup::all();
        $this->select_id = Auth::user()->group_id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        view()->share('data', $this->data);
        view()->share('select_id', $this->select_id);
        return view('components.group');
    }
}
