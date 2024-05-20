<?php

namespace App\Livewire;

use App\Models\Career;
use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class CareerTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';

    public function render()
    {
        $companies = Company::all();
        $careers = Career::where('name', 'like', '%' . $this->search . '%')
                             ->paginate(10);

        return view('livewire.career-table', compact('careers','companies'));
    }
}
