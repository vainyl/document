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

use Vainyl\Core\Hydrator\HydratorInterface;
use Vainyl\Core\Storage\Decorator\AbstractStorageDecorator;
use Vainyl\Database\DatabaseInterface;
use Vainyl\Document\Operation\Factory\DocumentOperationFactoryInterface;

/**
 * Class DocumentRegistry
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DocumentRegistry extends AbstractStorageDecorator implements DocumentRegistryInterface
{
    /**
     * @inheritDoc
     */
    public function addDatabase(string $alias, DatabaseInterface $database): DocumentRegistryInterface
    {
        $this->offsetSet(sprintf('%s.database', $alias), $database);

        return $this;
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
        return $this->offsetGet(sprintf('%s.database', $alias));
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