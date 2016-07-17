<?php

namespace App\Policies;

use App\Book;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function edit(User $user, User $edit_user)
    {
        return $this->isIam($user, $edit_user) || $this->isAdmin($user);
    }

    public function manageUsers(User $user)
    {
        return $this->isAdmin($user);
    }

    public function manageBooks(User $user)
    {
        return $this->isAdmin($user);
    }

    public function manageRegister(User $user)
    {
        return $this->isAdmin($user);
    }

    public function addAdmin(User $user)
    {
        return $this->isSuperAdmin($user);
    }

    private function isSuperAdmin(User $user)
    {
        return ($user->id == 1 && $user->is_admin == 1);
    }

    private function isAdmin(User $user)
    {
        return $user->is_admin == 1;
    }

    private function isIam(User $user, User $edit)
    {
        return $user->id == $edit->id;
    }
}
