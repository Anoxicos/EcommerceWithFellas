<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    /**
     * Anyone can view products (public).
     */
    public function view(?User $user, Product $product): bool
    {
        return true;
    }

    /**
     * Only admins can create products.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Only admins can update products.
     */
    public function update(User $user, Product $product): bool
    {
        return $user->isAdmin();
    }

    /**
     * Only admins can delete products.
     */
    public function delete(User $user, Product $product): bool
    {
        return $user->isAdmin();
    }
}
