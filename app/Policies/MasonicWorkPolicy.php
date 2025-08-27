<?php

namespace App\Policies;

use App\Models\MasonicWork;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MasonicWorkPolicy
{
    /**
     * Get the numeric value of a degree.
     */
    private function getDegreeValue(string $degree): int
    {
        $degrees = [
            'Aprendiz' => 1,
            'Compañero' => 2,
            'Maestro' => 3,
            // Añadir otros grados aquí en orden jerárquico
        ];

        return $degrees[ucfirst(strtolower($degree))] ?? 0;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Cualquiera puede ver el listado
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MasonicWork $masonicWork): bool
    {
        $userDegree = $this->getDegreeValue($user->degree);
        $requiredDegree = $this->getDegreeValue($masonicWork->required_degree);

        return $userDegree >= $requiredDegree;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->getDegreeValue($user->degree) >= 3; // Solo Maestros
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MasonicWork $masonicWork): bool
    {
        return $this->getDegreeValue($user->degree) >= 3; // Solo Maestros
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MasonicWork $masonicWork): bool
    {
        return $this->getDegreeValue($user->degree) >= 3; // Solo Maestros
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MasonicWork $masonicWork): bool
    {
        return $this->getDegreeValue($user->degree) >= 3; // Solo Maestros
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MasonicWork $masonicWork): bool
    {
        return $this->getDegreeValue($user->degree) >= 3; // Solo Maestros
    }
}