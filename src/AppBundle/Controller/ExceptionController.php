<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 16/10/2018
 * Time: 08:56
 */

namespace AppBundle\Controller;


use AppBundle\Exception\ValidationException;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ExceptionController extends Controller
{
    use ControllerTrait;

    /**
     * @param Request $request
     * @param $exception
     * @param DebugLoggerInterface|null $logger
     * @return View
     */
    public function showAction(Request $request, $exception, DebugLoggerInterface $logger = null)
    {
        if ($exception instanceof ValidationException) {
            return $this->getView($exception->getStatusCode(), json_decode($exception->getMessage(), true));
        }

        if ($exception instanceof ValidationException) {
            /** @var \Exception $exception */
            return $this->getView(null, $exception->getMessage() . $exception->getTraceAsString());
            //return $this->getView($exception->getStatusCode(), $exception->getMessage());
        }

        return $this->getView(null, 'Unexpected error occured');
    }

    /**
     * @param int|null $statusCode
     * @param $message
     * @return View
     */
    private function getView(?int $statusCode, $message): View
    {
        $data = [
            'code' => $statusCode ?? 500,
            'message' => $message
        ];

        return $this->view($data, $statusCode ?? 500);

    }



}