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
     * @inheritDoc
     */
    public function create(DocumentInterface $document): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(
                new DispatchEventOperation($this->eventDispatcher, new CreateDocumentEvent($document))
            )
            ->add(parent::create($document));
    }

    /**
     * @inheritDoc
     */
    public function update(DocumentInterface $newDocument, DocumentInterface $oldDocument): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(
                new DispatchEventOperation($this->eventDispatcher, new UpdateDocumentEvent($newDocument, $oldDocument))
            )
            ->add(parent::update($newDocument, $oldDocument));
    }

    /**
     * @inheritDoc
     */
    public function delete(DocumentInterface $document): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(
                new DispatchEventOperation($this->eventDispatcher, new DeleteDocumentEvent($document))
            )
            ->add(parent::delete($document));
    }

    /**
     * @inheritDoc
     */
    public function upsert(DocumentInterface $document): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(
                new DispatchEventOperation($this->eventDispatcher, new UpsertDocumentEvent($document))
            )
            ->add(parent::upsert($document));
    }
}