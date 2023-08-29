<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Services\BaseService;
use App\Services\BaseServiceInterface;
use Illuminate\Support\Facades\Auth;

class DefaultLogout extends BaseService implements BaseServiceInterface
{
    /**
     * default logout process.
     *
     * @param array $dto
     */
    public function process(array $dto)
    {
        $find_authenticated_user = User::where('id', $dto['user_id'])->first();

        if (!empty($find_authenticated_user)) {
            Auth::logout();

            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = "Logout Berhasil";
            $this->results['data'] = ['email' => $find_authenticated_user->email];
        } else {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = "User Tidak Ditemukan";
            $this->results['data'] = [];
        }
    }
}
