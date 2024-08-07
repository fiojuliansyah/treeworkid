<?php

namespace App\Livewire;

use App\Models\Site;
use App\Models\User;
use Livewire\Component;
use App\Models\Attendance;
use Livewire\WithPagination;

class MinuteTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';

    public function render()
    {
        $users = User::all();
        $sites = Site::all();
        $minutes = Attendance::where('type', 'berita_acara')
                            ->where(function ($query) {
                                $query->whereHas('user', function ($subQuery) {
                                    $subQuery->where('name', 'like', '%' . $this->search . '%');
                                })
                                ->orWhereHas('site', function ($subQuery) {
                                    $subQuery->where('name', 'like', '%' . $this->search . '%');
                                });
                            })
                            ->paginate(10);

        return view('livewire.minute-table', compact('minutes', 'users', 'sites'));
    }
}
