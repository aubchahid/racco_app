<?php

namespace App\Http\Livewire\Backoffice;

use Livewire\Component;

class StockPage extends Component
{
    public function render()
    {
        return view('livewire.backoffice.stock-page')->layout('layouts.app',['title'=>'Stock']);
    }
}
