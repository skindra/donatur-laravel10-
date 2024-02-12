<?php

namespace App\Policies;

use App\Models\Donatur as Donaturs;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DonaturPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->email == "admin@gmail.com";
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Donaturs $donaturs): bool
    {
        return $user->email == "admin@gmail.com";
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $data = in_array($user->email, [
            'admin@gmail.com',
        ]);
        return $data;
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Donaturs $donaturs): bool
    {
        return true;
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Donaturs $donaturs): bool
    {
        $data = in_array($user->email, [
            'admin@gmail.com',
        ]);
        return $data;
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Donaturs $donaturs): bool
    {
        return true;
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Donaturs $donaturs): bool
    {
        return true;
        //
    }
}
