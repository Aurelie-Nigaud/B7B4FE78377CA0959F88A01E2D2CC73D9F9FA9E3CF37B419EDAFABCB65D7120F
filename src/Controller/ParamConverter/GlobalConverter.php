<?php

namespace App\Controller\ParamConverter;

use App\Service\Student\CreateStudentService\Dto\CreateStudentDTO;
use Doctrine\Common\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class GlobalConverter
 * @package App\Controller\ParamConverter\Student
 */
class GlobalConverter implements ParamConverterInterface
{
    /**
     * @var ManagerRegistry
     */
    private $registry;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * CreateStudentConverter constructor.
     * @param ManagerRegistry $registry
     * @param SerializerInterface $serializer
     */
    public function __construct(ManagerRegistry $registry, SerializerInterface $serializer)
    {
        $this->registry = $registry;
        $this->serializer = $serializer;
    }

    /**
     * @param Request $request
     * @param ParamConverter $configuration
     * @return bool|void
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        if (!is_null($configuration->getClass())) {
            $requestToDto = $this->serializer->deserialize($request->getContent(), $configuration->getClass(), 'json');
            return $request->attributes->set($configuration->getName(), $requestToDto);
        }
    }

    /**
     * @param ParamConverter $configuration
     * @return bool
     */
    public function supports(ParamConverter $configuration)
    {
        return $configuration->getName();
    }
}