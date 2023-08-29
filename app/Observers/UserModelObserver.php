<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserModelObserver
{
    /**
     * Handle the creating user before created process.
     */
    public function creating(User $user): void
    {
        $user->uuid = Str::uuid();
    }
}
