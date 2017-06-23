<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Entity
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vainyl\Document\Operation\Decorator;

use Vainyl\Document\DocumentInterface;
use Vainyl\Document\Operation\Factory\DocumentOperationFactoryInterface;
use Vainyl\Document\Operation\SetCreatedAtOperation;
use Vainyl\Document\Operation\SetUpdatedAtOperation;
use Vainyl\Operation\Collection\Factory\CollectionFactoryInterface;
use Vainyl\Operation\OperationInterface;
use Vainyl\Time\Provider\TimeProviderInterface;

/**
 * Class TimestampDocumentOperationFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class TimestampDocumentOperationFactoryDecorator extends AbstractDocumentOperationFactoryDecorator
{
    private $collectionFactory;

    private $timeProvider;

    /**
     * TimestampDocumentOperationFactoryDecorator constructor.
     *
     * @param DocumentOperationFactoryInterface $operationFactory
     * @param CollectionFactoryInterface        $collectionFactory
     * @param TimeProviderInterface             $timeProvider
     */
    public function __construct(
        DocumentOperationFactoryInterface $operationFactory,
        CollectionFactoryInterface $collectionFactory,
        TimeProviderInterface $timeProvider
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->timeProvider = $timeProvider;
        parent::__construct($operationFactory);
    }

    /**
     * @inheritDoc
     */
    public function create(DocumentInterface $entity): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(
                new SetCreatedAtOperation($entity, $this->timeProvider->getCurrentTime())
            )
            ->add(parent::create($entity));
    }

    /**
     * @inheritDoc
     */
    public function update(DocumentInterface $newDocument, DocumentInterface $oldDocument): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(
                new SetUpdatedAtOperation($newDocument, $this->timeProvider->getCurrentTime())
            )
            ->add(parent::update($newDocument, $oldDocument));
    }

    /**
     * @inheritDoc
     */
    public function upsert(DocumentInterface $document): OperationInterface
    {
        $collection = $this->collectionFactory->create();
        if (null === $document->createdAt()) {
            $collection->add(new SetCreatedAtOperation($document, $this->timeProvider->getCurrentTime()));
        }

        if (null === $document->updatedAt()) {
            $collection->add(new SetUpdatedAtOperation($document, $this->timeProvider->getCurrentTime()));
        }

        return $collection->add(parent::upsert($document));
    }
}