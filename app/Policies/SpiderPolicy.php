<?php

namespace App\Policies;

use App\Models\Spider;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SpiderPolicy
{
    public function access(User $user, Spider $spider): Response
    {
        return $user->id === $spider->user_id
            ? Response::allow()
            : Response::deny('You do not own this spider.');
    }
}
