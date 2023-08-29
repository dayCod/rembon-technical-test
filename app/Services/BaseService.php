<?php

namespace App\Services;

abstract class BaseService implements BaseServiceInterface
{
    /**
     * return expected array results
     *
     * @var array
     */
    protected $results;

    /**
     * construct protected variable results to array
     *
     * @var array
     */
    public function __construct()
    {
        $this->results = ['response_code' => null, 'success' => false, 'message' => null, 'data' => null];
    }

    /**
     * pass the data transfer object to the process function services
     *
     * @param array
     */
    abstract protected function process(array $dto);

    /**
     * implement execute data transfer object from controller
     *
     * @param array
     */
    public function execute(array $dto): array
    {
        $this->process($dto);

        return $this->results;
    }
}
