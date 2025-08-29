<?php

namespace App\Livewire;

use App\Models\MasonicWork;
use App\Models\DocumentCategory;
use Livewire\Component;
use Livewire\WithPagination;

class AdminDocumentsTable extends Component
{
    use WithPagination;

    public $search = '';
    public $filterByCategory = '';
    public $filterBySource = '';

    // Reset pagination when any filter is updated
    public function updatedSearch() { $this->resetPage(); }
    public function updatedFilterByCategory() { $this->resetPage(); }
    public function updatedFilterBySource() { $this->resetPage(); }

    public function render()
    {
        $query = MasonicWork::query()
            ->with('documentCategory', 'degree')
            ->when($this->search, function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterByCategory, function ($q) {
                $q->where('document_category_id', $this->filterByCategory);
            })
            ->when($this->filterBySource, function ($q) {
                $q->where('source', $this->filterBySource);
            });

        $works = $query->latest()->paginate(10);

        // Si la página actual no tiene resultados y no es la primera página, resetea a la página 1.
        if ($works->isEmpty() && $works->currentPage() > 1) {
            $this->resetPage();
            $works = $query->latest()->paginate(10);
        }

        $documentCategories = DocumentCategory::orderBy('name')->get();
        $sources = ['Propio', 'Biblioteca'];

        return view('livewire.admin-documents-table', [
            'works' => $works,
            'documentCategories' => $documentCategories,
            'sources' => $sources,
        ]);
    }
}