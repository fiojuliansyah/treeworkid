<?php

namespace App\Livewire;

use App\Models\Site;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $selectedSite = null;

    public function render()
    {
        $sites = Site::all();

        $usersQuery = User::query();

        if ($this->selectedSite) {
            $usersQuery->where('site_id', $this->selectedSite);
        }

        if ($this->search) {
            $usersQuery->where('name', 'like', '%' . $this->search . '%');
        }

        $users = $usersQuery->paginate(10);

        return view('livewire.user-table', compact('users', 'sites'));
    }
}


