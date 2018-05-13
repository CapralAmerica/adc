<?php

namespace AppBundle\Repository;


class CatRepository extends \Doctrine\ORM\EntityRepository
{
    public function updateCat(
        $id,
        $name,
        $age,
        $colour,
        $weight,
        $guardianMobile,
        $gpsLong,
        $gpsLat,
        $notes,
        $isSterilized
    )
    {
        return $this->createQueryBuilder('c')
                    ->update('AppBundle\Entity\Cat', 'c')
                    ->set('c.name', '?1')
                    ->set('c.age', '?2')
                    ->set('c.weight', '?3')
                    ->set('c.colour', '?4')
                    ->set('c.guardianMobile', '?5')
                    ->set('c.gpsLong', '?6')
                    ->set('c.gpsLat', '?7')
                    ->set('c.notes', '?8')
                    ->set('c.isSterilized', '?9')
                    ->where('c.id=?10')
                    ->setParameter(1, $name)
                    ->setParameter(2, $age)
                    ->setParameter(3, $weight)
                    ->setParameter(4, $colour)
                    ->setParameter(5, $guardianMobile)
                    ->setParameter(6, $gpsLong)
                    ->setParameter(7, $gpsLat)
                    ->setParameter(8, $notes)
                    ->setParameter(9, $isSterilized)
                    ->setParameter(10, $id)
                    ->getQuery()
                    ->execute();

    }
}
