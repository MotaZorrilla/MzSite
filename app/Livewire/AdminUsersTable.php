<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Degree;
use Livewire\Component;
use Livewire\WithPagination;

class AdminUsersTable extends Component
{
    use WithPagination;

    public $search = '';
    public $filterByRole = '';
    public $filterByDegree = '';

    // Reset pagination when any filter is updated
    public function updatedSearch() { $this->resetPage(); }
    public function updatedFilterByRole() { $this->resetPage(); }
    public function updatedFilterByDegree() { $this->resetPage(); }

    public function render()
    {
        $query = User::query()
            ->with('degree')
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterByRole, function ($q) {
                $q->where('role', $this->filterByRole);
            })
            ->when($this->filterByDegree, function ($q) {
                $q->where('degree_id', $this->filterByDegree);
            });

        $users = $query->latest()->paginate(10);

        // Si la página actual no tiene resultados y no es la primera página, resetea a la página 1.
        if ($users->isEmpty() && $users->currentPage() > 1) {
            $this->resetPage();
            $users = $query->latest()->paginate(10);
        }

        $degrees = Degree::orderBy('id')->get();
        $roles = ['usuario', 'administrador'];

        return view('livewire.admin-users-table', [
            'users' => $users,
            'degrees' => $degrees,
            'roles' => $roles,
        ]);
    }
}