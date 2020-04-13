<?php

/**
 * Routes.
 *
 * @copyright Zikula contributors (Zikula)
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @author Zikula contributors <info@ziku.la>.
 * @see https://ziku.la
 * @version Generated by ModuleStudio 1.4.0 (https://modulestudio.de).
 */

declare(strict_types=1);

namespace Zikula\RoutesModule\Entity\Factory\Base;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use InvalidArgumentException;
use Zikula\RoutesModule\Entity\Factory\EntityInitialiser;
use Zikula\RoutesModule\Entity\RouteEntity;
use Zikula\RoutesModule\Helper\CollectionFilterHelper;

/**
 * Factory class used to create entities and receive entity repositories.
 */
abstract class AbstractEntityFactory
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var EntityInitialiser
     */
    protected $entityInitialiser;

    /**
     * @var CollectionFilterHelper
     */
    protected $collectionFilterHelper;

    public function __construct(
        EntityManagerInterface $entityManager,
        EntityInitialiser $entityInitialiser,
        CollectionFilterHelper $collectionFilterHelper
    ) {
        $this->entityManager = $entityManager;
        $this->entityInitialiser = $entityInitialiser;
        $this->collectionFilterHelper = $collectionFilterHelper;
    }

    /**
     * Returns a repository for a given object type.
     */
    public function getRepository(string $objectType): EntityRepository
    {
        $entityClass = 'Zikula\\RoutesModule\\Entity\\' . ucfirst($objectType) . 'Entity';

        /** @var EntityRepository $repository */
        $repository = $this->getEntityManager()->getRepository($entityClass);
        $repository->setCollectionFilterHelper($this->collectionFilterHelper);

        return $repository;
    }

    /**
     * Creates a new route instance.
     */
    public function createRoute(): RouteEntity
    {
        $entity = new RouteEntity();

        $this->entityInitialiser->initRoute($entity);

        return $entity;
    }

    /**
     * Returns the identifier field's name for a given object type.
     */
    public function getIdField(string $objectType = ''): string
    {
        if (empty($objectType)) {
            throw new InvalidArgumentException('Invalid object type received.');
        }
        $entityClass = 'ZikulaRoutesModule:' . ucfirst($objectType) . 'Entity';
    
        $meta = $this->getEntityManager()->getClassMetadata($entityClass);
    
        return $meta->getSingleIdentifierFieldName();
    }
    
    public function getEntityManager(): ?EntityManagerInterface
    {
        return $this->entityManager;
    }
    
    public function getEntityInitialiser(): ?EntityInitialiser
    {
        return $this->entityInitialiser;
    }
}
