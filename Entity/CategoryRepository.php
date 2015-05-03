<?php

namespace Ekyna\Bundle\BlogBundle\Entity;

use Ekyna\Bundle\AdminBundle\Doctrine\ORM\ResourceRepositoryInterface;
use Gedmo\Sortable\Entity\Repository\SortableRepository;

/**
 * Class CategoryRepository
 * @package Ekyna\Bundle\BlogBundle\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class CategoryRepository extends SortableRepository implements ResourceRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createNew()
    {
        $class = $this->getClassName();
        return new $class;
    }

    /**
     * Finds one category by slug.
     *
     * @param string $slug
     * @return \Ekyna\Bundle\BlogBundle\Model\CategoryInterface|null
     */
    public function findOneBySlug($slug)
    {
        if (0 === strlen($slug)) {
            return null;
        }

        $qb = $this->createQueryBuilder('c');
        $params = ['slug' => $slug, 'enabled' => true];

        $qb
            ->andWhere($qb->expr()->eq('c.enabled', ':enabled'))
            ->andWhere($qb->expr()->eq('c.slug', ':slug'))
            ->getQuery()
        ;

        return $qb
            ->getQuery()
            ->setMaxResults(1)
            ->setParameters($params)
            ->getOneOrNullResult()
        ;
    }
}
