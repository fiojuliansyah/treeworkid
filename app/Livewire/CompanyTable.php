<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Company;

class CompanyTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';

    public function render()
    {
        $companies = Company::where('name', 'like', '%' . $this->search . '%')
                             ->paginate(10);

        return view('livewire.company-table', compact('companies'));
    }
}