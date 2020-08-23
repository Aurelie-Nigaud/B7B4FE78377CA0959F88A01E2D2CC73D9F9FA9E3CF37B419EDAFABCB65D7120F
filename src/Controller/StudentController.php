<?php

namespace App\Controller;

use App\Request\Student\CreateStudentRequest\CreateStudentRequestResponse;
use App\Service\Student\AddStudentGradeService\Dto\AddStudentGradeDTO;
use App\Service\Student\CreateStudentService\Dto\CreateStudentDTO;
use App\Service\Student\StudentServiceInterface;
use App\Service\Student\UpdateStudentService\Dto\UpdateStudentDTO;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

class StudentController extends BaseController
{
    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var StudentServiceInterface
     */
    private $service;

    /**
     * StudentController constructor.
     * @param StudentServiceInterface $service
     */
    public function __construct(StudentServiceInterface $service, SerializerInterface $serializer)
    {
        parent::__construct($serializer);
        $this->service = $service;
    }

    /**
     * @param CreateStudentDTO $createStudentDTO
     *
     * @Route("/students", name="create student", methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns created Student id",
     *     @SWG\Schema(type="integer", description="created student id")
     *   )
     * )
     * @SWG\Parameter(
     *     name="Student",
     *     in="body",
     *     type="CreateStudentDTO::class",
     *     description="student fields",
     *     @Model(type=CreateStudentDTO::class)
     * )
     * @SWG\Tag(name="Create student")
     *
     * @return JsonResponse
     */
    public function createStudent(CreateStudentDTO $createStudentDTO): JsonResponse
    {
        return $this->getResponse($this->service->createStudent($createStudentDTO));
    }

    /**
     * @param int $id
     *
     * @Route("/students/{id}", name="update student", methods={"PUT"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns updated Student id",
     *     @SWG\Schema(type="integer", description="Updates student id")
     *    )
     * )
     * @SWG\Parameter(
     *     name="Student",
     *     in="body",
     *     type="UpdateStudentDTO::class",
     *     description="student fiels to Update",
     *     @Model(type=UpdateStudentDTO::class)
     * )
     * @SWG\Tag(name="Update student")
     *
     * @param UpdateStudentDTO $updateStudentDTO
     * @return JsonResponse
     */
    public function updateStudent(int $id, UpdateStudentDTO $updateStudentDTO): JsonResponse
    {
        return $this->getResponse($this->service->updateStudent($id, $updateStudentDTO));
    }

    /**
     * @param int $id
     *
     * @Route("/students/{id}/grades/avg", name="get student global avg", methods={"GET"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Return student globale average",
     *     @SWG\Schema(type="float", description="student globale average")
     *     )
     * )
     *
     * @SWG\Tag(name="Get student global average")
     *
     * @return JsonResponse
     */
    public function getStudentGlobalAVG(int $id): JsonResponse
    {
        return $this->getResponse($this->service->getStudentGlobalGrade($id));
    }

    /**
     * @Route("/students/{id}", name="remove student", methods={"DELETE"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Return deletes message",
     *     @SWG\Schema(type="string", description="delete is done")
     *    )
     * )
     *
     * @SWG\Tag(name="Delete student")
     *
     */
    public function removeStudent(int $id): JsonResponse
    {
        return $this->getResponse($this->service->removeStudent($id));
    }

    /**
     * @param int $id
     * @param AddStudentGradeDTO $grade
     * @return JsonResponse
     * @Route("/students/{id}/grades", name="add student grade", methods={"POST"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns Created grade id",
     *     @SWG\Schema(type="integer", description="Created grade id")
     *    )
     * )
     * @SWG\Parameter(
     *     name="Student",
     *     in="body",
     *     type="AddStudentGradeDTO::class",
     *     description="Grade format",
     *     @Model(type=AddStudentGradeDTO::class)
     * )
     * @SWG\Tag(name="Add student grade")
     *
     */
    public function addStudentGrade(int $id, AddStudentGradeDTO $grade): JsonResponse
    {
        return $this->getResponse($this->service->addStudentGrade($id, $grade));
    }
}