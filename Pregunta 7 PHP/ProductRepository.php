<?php

use App\Entity\Product; use Doctrine\ORM\EntityManagerInterface; 
// ... class ProductRepository { private $entityManager;

public function __construct(EntityManagerInterface $entityManager)
{
    $this->entityManager = $entityManager;
}

public function findProductsGreaterThanPrice($price)
{
    $query = $this->entityManager->createQueryBuilder()
        ->select('p')
        ->from(Product::class, 'p')
        ->where('p.price > :price')
        ->setParameter('price', $price)
        ->getQuery();

    return $query->getResult();
}

}