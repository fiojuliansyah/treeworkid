<?php

namespace App\Livewire;

use App\Models\Site;
use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class SiteTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $companies = Company::all();
        if ($this->search != '') {
            $data = Crud::where('name', 'like', '%' . $this->search . '%')
                ->paginate(10);
        } else {
            $data = Crud::paginate(10);
        }

        return view('livewire.site-table', compact('data','companies'));
    }
}
