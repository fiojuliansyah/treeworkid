<?php

namespace App\Livewire;

use App\Models\Minute;
use Livewire\WithPagination;
use App\Models\Attendance;
use Livewire\Component;

class MinuteTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';

    public function render()
    {
        $minutes = Minute::whereHas('attendance', function ($query) {
                                $query->where('date', 'like', '%' . $this->search . '%');
                            })
                            ->paginate(10);

        return view('livewire.minute-table', compact('minutes'));
    }
}
