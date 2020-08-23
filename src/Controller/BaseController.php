<?php

namespace App\Controller;

use App\Service\ServiceResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class BaseController
 * @package App\Controller
 */
class BaseController extends AbstractController
{
    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * BaseController constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param ServiceResponse $response
     */
    public function getResponse(ServiceResponse $response)
    {
        if (!$response->isErrorStatement()) {
            return $this->JSONSerialise($response->getResponse());
        } else {
            throw new BadRequestHttpException(implode(' ', $response->getErrorMessages()));
        }
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    public function JSONSerialise($data): JsonResponse
    {
        return JsonResponse::fromJsonString($this->serializer->serialize($data, 'json'));
    }
}