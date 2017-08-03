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
use Vainyl\Core\Storage\StorageInterface;
use Vainyl\Database\DatabaseInterface;
use Vainyl\Document\Operation\Factory\DocumentOperationFactoryInterface;

/**
 * Interface DocumentRegistryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DocumentRegistryInterface extends StorageInterface
{
    /**
     * @param string            $alias
     * @param DatabaseInterface $database
     *
     * @return DocumentRegistryInterface
     */
    public function addDatabase(string $alias, DatabaseInterface $database): DocumentRegistryInterface;

    /**
     * @param string                            $alias
     * @param DocumentOperationFactoryInterface $factory
     *
     * @return DocumentRegistryInterface
     */
    public function addFactory(string $alias, DocumentOperationFactoryInterface $factory): DocumentRegistryInterface;

    /**
     * @param string            $alias
     * @param HydratorInterface $hydrator
     *
     * @return DocumentRegistryInterface
     */
    public function addHydrator(string $alias, HydratorInterface $hydrator): DocumentRegistryInterface;

    /**
     * @param string $alias
     *
     * @return DatabaseInterface
     */
    public function getDatabase(string $alias): DatabaseInterface;

    /**
     * @param string $alias
     *
     * @return DocumentOperationFactoryInterface
     */
    public function getFactory(string $alias): DocumentOperationFactoryInterface;

    /**
     * @param string $alias
     *
     * @return HydratorInterface
     */
    public function getHydrator(string $alias): HydratorInterface;
}