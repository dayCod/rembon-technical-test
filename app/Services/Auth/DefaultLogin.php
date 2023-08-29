<?php

namespace App\Services\Auth;

use App\Services\BaseService;
use App\Services\BaseServiceInterface;
use Illuminate\Support\Facades\Auth;

class DefaultLogin extends BaseService implements BaseServiceInterface
{
    /**
     * default login process.
     *
     * @param array $dto
     */
    public function process(array $dto)
    {
        if (Auth::attempt($dto)) {
            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = 'Login Berhasil';
            $this->results['data'] = [
                'email' => $dto['email'],
            ];
        } else {
            $this->results['response_code'] = 401;
            $this->results['success'] = false;
            $this->results['message'] = 'Kredensial yang diberikan tidak cocok dengan catatan kami';
            $this->results['data'] = [];
        }
    }
}
