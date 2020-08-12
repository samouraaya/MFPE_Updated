<?php
namespace Mfpe\ConfigBundle\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiProblemException extends HttpException
{
    private $apiProblem;

    public function __construct(ApiProblem $apiProblem, \Exception $previous = null, array $headers = array(), $code = 0)
    {
        $this->apiProblem = $apiProblem;

        parent::__construct(
            $apiProblem->getStatusCode(),
            $apiProblem->getMessage()
        );
    }
    public function getApiProblem()
    {
        return $this->apiProblem;
    }
}
