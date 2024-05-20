<?php

namespace App\Livewire;

use App\Models\Status;
use Livewire\Component;
use Livewire\WithPagination;

class StatusTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';

    public function render()
    {
        $statuses = Status::where('name', 'like', '%' . $this->search . '%')
                             ->paginate(10);

        return view('livewire.status-table', compact('statuses'));
    }
}
