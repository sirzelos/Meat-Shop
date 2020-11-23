<?php

namespace App\Policies;

use App\User;
use App\pay;
use Illuminate\Auth\Access\HandlesAuthorization;

class PayPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any pays.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the pay.
     *
     * @param  \App\User  $user
     * @param  \App\pay  $pay
     * @return mixed
     */
    public function view(User $user, pay $pay)
    {
        return $user->isAdmin()
               or $user->id === $pay->user_id;
    }

    /**
     * Determine whether the user can create pays.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the pay.
     *
     * @param  \App\User  $user
     * @param  \App\pay  $pay
     * @return mixed
     */
    public function update(User $user, pay $pay)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the pay.
     *
     * @param  \App\User  $user
     * @param  \App\pay  $pay
     * @return mixed
     */
    public function delete(User $user, pay $pay)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the pay.
     *
     * @param  \App\User  $user
     * @param  \App\pay  $pay
     * @return mixed
     */
    public function restore(User $user, pay $pay)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the pay.
     *
     * @param  \App\User  $user
     * @param  \App\pay  $pay
     * @return mixed
     */
    public function forceDelete(User $user, pay $pay)
    {
        return $user->isAdmin();
    }
}
