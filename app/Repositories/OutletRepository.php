<?php

namespace App\Repositories;

use App\Models\Outlet;
use App\Models\User;
use App\Repositories\Interfaces\OutletRepositoryInterface;

class OutletRepository extends BaseResourceRepository implements OutletRepositoryInterface
{
    /**
     * Create a new repository instance.
     */
    public function __construct()
    {
        $this->model = new Outlet();
    }

    /**
     * Retrieve user model on another outlet.
     */
    public function getUserOnAnotherOutlet(Outlet $outlet, User $currentUser): User|null
    {
        return User::where('company_id', $currentUser->company_id)
            ->where('outlet_id', $outlet->id)
            ->where(function ($query) use ($currentUser) {
                $query->where('parent_user_id', $currentUser->parent_user_id)
                    ->orWhere('parent_user_id', $currentUser->id)
                    ->orWhere('id', $currentUser->parent_user_id);
            })->first();
    }

    /**
     * Create outlet user.
     */
    public function createOutletUser(Outlet $outlet, User $user): User
    {
        $parentUser = $user;

        if ($parentUser->parent_user_id) {
            $parentUser = User::where('company_id', $parentUser->company_id)
                ->where('id', $parentUser->parent_user_id)
                ->first();
        }

        $outletUser = $parentUser->replicate();
        $outletUser->username = 'SUB_ACCOUNT_USERNAME';
        $outletUser->password = 'SUB_ACCOUNT_PASSWORD';
        $outletUser->outlet_id = $outlet->id;
        $outletUser->parent_user_id = $parentUser->id;
        $outletUser->save();

        return $outletUser;
    }
}
