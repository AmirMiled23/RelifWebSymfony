<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class EntityDebugController extends AbstractController
{
    #[Route('/debug/entity', name: 'debug_entity')]
    public function debugEntity(EntityManagerInterface $entityManager): Response
    {
        $output = [];
        
        // Check if Conference entity exists
        $metadata = $entityManager->getMetadataFactory()->getAllMetadata();
        
        foreach ($metadata as $classMetadata) {
            $className = $classMetadata->getName();
            if (strpos($className, 'Conference') !== false) {
                $output[] = [
                    'class' => $className,
                    'table' => $classMetadata->getTableName(),
                    'fields' => $classMetadata->getFieldNames(),
                ];
            }
        }
        
        return $this->render('debug/entity.html.twig', [
            'entities' => $output,
        ]);
    }
}
