<?php

namespace App\Policies;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhotoPolicy
{
    use HandlesAuthorization;

    public function viewAny(?User $user)
    {
        return true; // Semua orang bisa melihat daftar foto
    }

    public function view(?User $user, Photo $photo)
    {
        return true; // Semua orang bisa melihat detail foto
    }

    public function create(User $user)
    {
        return $user->is_admin; // Hanya admin yang bisa membuat
    }

    public function update(User $user, Photo $photo)
    {
        return $user->is_admin; // Hanya admin yang bisa mengupdate
    }

    public function delete(User $user, Photo $photo)
    {
        return $user->is_admin; // Hanya admin yang bisa menghapus
    }
}