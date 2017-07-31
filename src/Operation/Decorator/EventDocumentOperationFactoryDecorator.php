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

namespace Vainyl\Document\Operation\Decorator;

use Vainyl\Document\DocumentInterface;
use Vainyl\Document\Event\CreateDocumentEvent;
use Vainyl\Document\Event\DeleteDocumentEvent;
use Vainyl\Document\Event\UpdateDocumentEvent;
use Vainyl\Document\Event\UpsertDocumentEvent;
use Vainyl\Document\Operation\Factory\DocumentOperationFactoryInterface;
use Vainyl\Domain\DomainInterface;
use Vainyl\Event\EventDispatcherInterface;
use Vainyl\Event\Operation\DispatchEventOperation;
use Vainyl\Operation\Collection\Factory\CollectionFactoryInterface;
use Vainyl\Operation\OperationInterface;

/**
 * Class EventDocumentOperationFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class EventDocumentOperationFactoryDecorator extends AbstractDocumentOperationFactoryDecorator
{
    private $collectionFactory;

    private $eventDispatcher;

    /**
     * EventDocumentOperationFactoryDecorator constructor.
     *
     * @param DocumentOperationFactoryInterface $operationFactory
     * @param CollectionFactoryInterface        $collectionFactory
     * @param EventDispatcherInterface          $eventDispatcher
     */
    public function __construct(
        DocumentOperationFactoryInterface $operationFactory,
        CollectionFactoryInterface $collectionFactory,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->eventDispatcher = $eventDispatcher;
        parent::__construct($operationFactory);
    }

    /**
     * @param DocumentInterface $domain
     *
     * @return OperationInterface
     */
    public function create(DomainInterface $domain): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(
                new DispatchEventOperation($this->eventDispatcher, new CreateDocumentEvent($domain))
            )
            ->add(parent::create($domain));
    }

    /**
     * @param DocumentInterface $domain
     *
     * @return OperationInterface
     */
    public function delete(DomainInterface $domain): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(
                new DispatchEventOperation($this->eventDispatcher, new DeleteDocumentEvent($domain))
            )
            ->add(parent::delete($domain));
    }

    /**
     * @param DocumentInterface $newDomain
     * @param DocumentInterface $oldDomain
     *
     * @return OperationInterface
     */
    public function update(DomainInterface $newDomain, DomainInterface $oldDomain): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(
                new DispatchEventOperation($this->eventDispatcher, new UpdateDocumentEvent($newDomain, $oldDomain))
            )
            ->add(parent::update($newDomain, $oldDomain));
    }

    /**
     * @param DocumentInterface $domain
     *
     * @return OperationInterface
     */
    public function upsert(DomainInterface $domain): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(
                new DispatchEventOperation($this->eventDispatcher, new UpsertDocumentEvent($domain))
            )
            ->add(parent::upsert($domain));
    }
}