<?php

namespace App\Livewire;

use App\Models\Site;
use Livewire\Component;
use App\Models\TypeLeave;
use Livewire\WithPagination;

class TypeLeaveTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';

    public function render()
    {
        $sites = Site::all();
        $types = TypeLeave::where('name', 'like', '%' . $this->search . '%')
                             ->paginate(10);

        return view('livewire.type-leave-table', compact('types', 'sites'));
    }
}
