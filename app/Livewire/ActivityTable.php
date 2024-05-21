<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

class ActivityTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    
    public function render()
    {
        $activities = Activity::whereRelation('causer', 'name', 'like', '%' . $this->search . '%')
                             ->orderBy('created_at', 'desc')
                             ->paginate(10);

        return view('livewire.activity-table',compact('activities'));
    }
}
