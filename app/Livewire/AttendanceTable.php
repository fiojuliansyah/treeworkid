<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Site;

class AttendanceTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';

    public function render()
    {
        $users = User::all();
        $sites = Site::all();
        $attendances = Attendance::with(['overtime', 'minutes'])
                            ->whereHas('user', function ($query) {
                                $query->where('name', 'like', '%' . $this->search . '%');
                            })
                            ->orWhereHas('site', function ($query) {
                                $query->where('name', 'like', '%' . $this->search . '%');
                            })
                            ->paginate(10);
    
        return view('livewire.attendance-table', compact('attendances', 'sites', 'users'));
    }
    
}
