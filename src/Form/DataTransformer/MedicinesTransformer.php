<?php

namespace App\Form\DataTransformer;

use App\Entity\Medicines;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class MedicinesTransformer implements DataTransformerInterface
{
    public function transform($medicines)
    {
        // Transform the collection of medicines data into an array of their ids
        return array_map(function (Medicines $medicine) {
            return $medicine->getId();
        }, $medicines->toArray());
    }

    public function reverseTransform($ids)
    {
        // Reverse transform the array of medicine ids into a collection of Medicine entities
        $medicines = array();

        foreach ($ids as $id) {
            $medicine = $this->entityManager->getRepository(Medicines::class)->find($id);

            if (!$medicine) {
                throw new TransformationFailedException(sprintf('The medicine with id "%s" does not exist!', $id));
            }

            $medicines[] = $medicine;
        }

        return $medicines;
    }
}
