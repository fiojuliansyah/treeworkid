<?php

namespace App\Livewire;

use App\Models\Career;
use Livewire\Component;
use Livewire\WithPagination;

class CareerWebsite extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    
    public function render()
    {
        $careers = Career::where('name', 'like', '%' . $this->search . '%')
                             ->paginate(10);

        return view('livewire.career-website',compact('careers'));
    }
}
