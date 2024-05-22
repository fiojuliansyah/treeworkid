<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Letter;
use Livewire\Component;
use App\Models\Generate;
use Livewire\WithPagination;

class GenerateTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';

    public function render()
    {
        $users = User::all();
        $letters = Letter::all();
        $generates = Generate::whereRelation('user','name', 'like', '%' . $this->search . '%')
                             ->paginate(10);

        return view('livewire.generate-table',compact('generates','users','letters'));
    }
}
