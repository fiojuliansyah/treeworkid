<?php

namespace App\Livewire;

use App\Models\Site;
use App\Models\Letter;
use Livewire\Component;
use Livewire\WithPagination;

class LetterTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    
    public function render()
    {
        $sites = Site::all();
        $letters = Letter::where('title', 'like', '%' . $this->search . '%')
                             ->paginate(10);
        return view('livewire.letter-table', compact('sites','letters'));
    }
}
