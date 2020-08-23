<?php


namespace App\Controller;


use App\Service\Classroom\ClassroomServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends BaseController
{
    /**
     * @var SerializerInterface
     */
    protected $serializer;
    /**
     * @var ClassroomServiceInterface
     */
    private $service;

    /**
     * ClassroomController constructor.
     * @param ClassroomServiceInterface $service
     * @param SerializerInterface $serializer
     */
    public function __construct(ClassroomServiceInterface $service, SerializerInterface $serializer)
    {
        parent::__construct($serializer);
        $this->service = $service;
    }

    /**
     * @param int $id
     *
     * @Route("/classrooms/{id}/grades/avg", name="get classroom global avg", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function getStudentGlobalAVG(int $id): JsonResponse
    {
        return $this->getResponse($this->service->getClassroomGlobalAVG($id));
    }
}