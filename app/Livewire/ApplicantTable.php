<?php

namespace App\Livewire;

use App\Models\Career;
use App\Models\Status;
use App\Models\Applicant;
use Livewire\Component;
use Livewire\WithPagination;

class ApplicantTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $selectedCareer = null;

    public function render()
    {
        $statuses = Status::all();
        $careers = Career::all();
        
        $applicants = Applicant::where('status_id', '0')
                    ->whereNull('done')
                    ->where(function ($query) {
                        $query->whereHas('user', function ($userQuery) {
                            $userQuery->where('name', 'like', '%' . $this->search . '%');
                        })->orWhereHas('career', function ($careerQuery) {
                            $careerQuery->where('name', 'like', '%' . $this->search . '%');
                        });

                        if ($this->selectedCareer) {
                            $query->where('career_id', $this->selectedCareer);
                        }
                    })
                    ->paginate(10);

        return view('livewire.applicant-table', compact('applicants', 'statuses', 'careers'));
    }
}
