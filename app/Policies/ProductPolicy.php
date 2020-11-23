<?php

namespace App\Policies;

use App\User;
use App\product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any products.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the product.
     *
     * @param  \App\User  $user
     * @param  \App\product  $product
     * @return mixed
     */
    public function view(User $user, product $product)
    {
        //
    }

    /**
     * Determine whether the user can create products.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the product.
     *
     * @param  \App\User  $user
     * @param  \App\product  $product
     * @return mixed
     */
    public function update(User $user, product $product)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the product.
     *
     * @param  \App\User  $user
     * @param  \App\product  $product
     * @return mixed
     */
    public function delete(User $user, product $product)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the product.
     *
     * @param  \App\User  $user
     * @param  \App\product  $product
     * @return mixed
     */
    public function restore(User $user, product $product)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the product.
     *
     * @param  \App\User  $user
     * @param  \App\product  $product
     * @return mixed
     */
    public function forceDelete(User $user, product $product)
    {
        return $user->isAdmin();
    }
}
