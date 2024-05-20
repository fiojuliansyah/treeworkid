<?php

namespace App\Livewire;

use App\Models\Career;
use App\Models\Status;
use Livewire\Component;
use App\Models\Applicant;
use Livewire\WithPagination;

class StatusApplicant extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $statusName;
    public $careerId;

    public function mount($name)
    {
        $this->statusName = $name;
    }
    
    public function render()
    {
        $careers = Career::all();
        $status = Status::where('name', $this->statusName)->first();
        $statusId = $status ? $status->id : null;
        
        $statuses = Status::all();

        $applicantsReq = Applicant::whereNull('approve_id')
                            ->whereNull('done')
                            ->get();
    
        $applicants = Applicant::where('status_id', $statusId)
                    ->whereNull('done')
                    ->whereNotNull('approve_id')
                    ->when($this->careerId, function ($query) {
                        $query->where('career_id', $this->careerId);
                    })
                    ->where(function ($query) {
                        $query->whereHas('user', function ($userQuery) {
                            $userQuery->where('name', 'like', '%' . $this->search . '%');
                        })->orWhereHas('career', function ($careerQuery) {
                            $careerQuery->where('name', 'like', '%' . $this->search . '%');
                        });
                    })
                    ->paginate(10);
    
        return view('livewire.status-applicant', compact('statuses', 'applicants', 'applicantsReq', 'status', 'careers'));
    }
}
