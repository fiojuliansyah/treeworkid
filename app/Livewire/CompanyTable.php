<?php

namespace App\Livewire;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

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