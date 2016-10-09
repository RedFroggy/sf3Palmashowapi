<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Repository;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * This custom Doctrine repository contains some methods which are useful when
 * querying for blog post information.
 * See http://symfony.com/doc/current/book/doctrine.html#custom-repository-classes.
 */
class DvdRepository extends EntityRepository
{
    public function findInArrayResult($id)
    {
        // query Builder
        $queryBuilder = $this
            ->createQueryBuilder('d')
            ->select("d")
            ->where("d.id = :id")->setParameter("id", $id);

        // query
        $q = $queryBuilder->getQuery();

        // return resultats
        return $q->getSingleResult(AbstractQuery::HYDRATE_ARRAY);
    }

    public function findAllInArrayResult()
    {
        // query Builder
        $queryBuilder = $this
            ->createQueryBuilder('d')
            ->select("d");

        // query
        $q = $queryBuilder->getQuery();

        // return resultats
        return $q->getArrayResult();
    }



}