<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Overtime;
use App\Models\Attendance;
use Livewire\WithPagination;

class OvertimeTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';

    public function render()
    {
        $overtimes = Overtime::whereHas('attendance', function ($query) {
                                $query->where('date', 'like', '%' . $this->search . '%');
                            })
                            ->paginate(10);

        return view('livewire.overtime-table', compact('overtimes'));
    }
}
