<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Document
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vainyl\Document\Registry;

use Psr\Container\ContainerInterface;
use Vainyl\Core\Hydrator\HydratorInterface;
use Vainyl\Core\Storage\Decorator\AbstractStorageDecorator;
use Vainyl\Core\Storage\StorageInterface;
use Vainyl\Database\DatabaseInterface;
use Vainyl\Document\Operation\Factory\DocumentOperationFactoryInterface;

/**
 * Class DocumentRegistry
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DocumentRegistry extends AbstractStorageDecorator implements DocumentRegistryInterface
{
    private $container;

    /**
     * DocumentRegistry constructor.
     *
     * @param StorageInterface   $storage
     * @param ContainerInterface $container
     */
    public function __construct(StorageInterface $storage, ContainerInterface $container)
    {
        $this->container = $container;
        parent::__construct($storage);
    }

    /**
     * @inheritDoc
     */
    public function addFactory(string $alias, DocumentOperationFactoryInterface $factory): DocumentRegistryInterface
    {
        $this->offsetSet(sprintf('%s.factory', $alias), $factory);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addHydrator(string $alias, HydratorInterface $hydrator): DocumentRegistryInterface
    {
        $this->offsetSet(sprintf('%s.hydrator', $alias), $hydrator);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getDatabase(string $alias): DatabaseInterface
    {
        return $this->container->get($alias);
    }

    /**
     * @inheritDoc
     */
    public function getFactory(string $alias): DocumentOperationFactoryInterface
    {
        return $this->offsetGet(sprintf('%s.factory', $alias));
    }

    /**
     * @inheritDoc
     */
    public function getHydrator(string $alias): HydratorInterface
    {
        return $this->offsetGet(sprintf('%s.hydrator', $alias));
    }
}