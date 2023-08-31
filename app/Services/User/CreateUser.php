<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\BaseService;
use App\Services\BaseServiceInterface;

class CreateUser extends BaseService implements BaseServiceInterface
{
    /**
     * create user process.
     *
     * @param array $dto
     */
    public function process(array $dto)
    {
        $create_user = User::create($dto);

        $this->results['response_code'] = 200;
        $this->results['success'] = true;
        $this->results['message'] = 'User Berhasil Dibuat';
        $this->results['data'] = [
            'user' => $create_user
        ];
    }
}
