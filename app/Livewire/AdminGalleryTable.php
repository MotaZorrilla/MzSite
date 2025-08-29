<?php

namespace App\Livewire;

use App\Models\GalleryImage;
use App\Models\ImageCategory;
use Livewire\Component;
use Livewire\WithPagination;

class AdminGalleryTable extends Component
{
    use WithPagination;

    public $search = '';
    public $filterByCategory = '';

    // Reset pagination when any filter is updated
    public function updatedSearch() { $this->resetPage(); }
    public function updatedFilterByCategory() { $this->resetPage(); }

    public function render()
    {
        $query = GalleryImage::query()
            ->with('imageCategory')
            ->when($this->search, function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterByCategory, function ($q) {
                $q->where('image_category_id', $this->filterByCategory);
            });

        $galleryImages = $query->latest()->paginate(10);

        // Si la página actual no tiene resultados y no es la primera página, resetea a la página 1.
        if ($galleryImages->isEmpty() && $galleryImages->currentPage() > 1) {
            $this->resetPage();
            // Vuelve a ejecutar la consulta después de resetear la página
            $galleryImages = $query->latest()->paginate(10);
        }

        $imageCategories = ImageCategory::orderBy('name')->get();

        return view('livewire.admin-gallery-table', [
            'galleryImages' => $galleryImages,
            'imageCategories' => $imageCategories,
        ]);
    }
}