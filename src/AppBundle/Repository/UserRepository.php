<?php

namespace AppBundle\Repository;


class UserRepository extends \Doctrine\ORM\EntityRepository
{
    public function updateUser(
        $id,
        $firstName,
        $lastName,
        $mobile,
        $password,
        $email
    )
    {
        return $this->createQueryBuilder('u')
            ->update('AppBundle\Entity\User', 'u')
            ->set('u.firstName', '?1')
            ->set('u.lastName', '?2')
            ->set('u.mobile', '?3')
            ->set('u.password', '?4')
            ->set('u.email', '?5')
            ->where('u.id=?6')
            ->setParameter(1, $firstName)
            ->setParameter(2, $lastName)
            ->setParameter(3, $mobile)
            ->setParameter(4, $password)
            ->setParameter(5, $email)
            ->setParameter(6, $id)
            ->getQuery()
            ->execute();

    }
}
