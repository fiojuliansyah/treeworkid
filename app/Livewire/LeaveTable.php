<?php

namespace App\Livewire;

use App\Models\Site;
use App\Models\User;
use App\Models\Leave;
use Livewire\Component;
use Livewire\WithPagination;

class LeaveTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';

    public function render()
    {
        $users = User::all();
        $sites = Site::all();
        $leaves = Leave::with('user')
                       ->whereHas('user', function($query) {
                           $query->where('id', 'like', '%' . $this->search . '%');
                       })
                       ->orWhereHas('site', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                        })
                       ->paginate(10);

        return view('livewire.leave-table', compact('leaves', 'sites', 'users'));
    }
}
