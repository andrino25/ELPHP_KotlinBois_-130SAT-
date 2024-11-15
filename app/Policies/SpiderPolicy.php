<?php

namespace App\Policies;

use App\Models\Spider;
use App\Models\User;

class SpiderPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Spider $spider): bool
    {
        return $user->id === $spider->userID;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Spider $spider): bool
    {
        return $user->id === $spider->userID;
    }

    public function delete(User $user, Spider $spider): bool
    {
        return $user->id === $spider->userID;
    }
}
