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
use Vainyl\Document\Operation\Factory\DocumentOperationFactoryInterface;
use Vainyl\Operation\OperationInterface;

/**
 * Class AbstractDocumentOperationFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class AbstractDocumentOperationFactoryDecorator implements DocumentOperationFactoryInterface
{
    private $operationFactory;

    /**
     * AbstractDocumentOperationFactoryDecorator constructor.
     *
     * @param DocumentOperationFactoryInterface $operationFactory
     */
    public function __construct(DocumentOperationFactoryInterface $operationFactory)
    {
        $this->operationFactory = $operationFactory;
    }

    /**
     * @inheritDoc
     */
    public function create(DocumentInterface $document): OperationInterface
    {
        return $this->operationFactory->create($document);
    }

    /**
     * @inheritDoc
     */
    public function update(DocumentInterface $newDocument, DocumentInterface $oldDocument): OperationInterface
    {
        return $this->operationFactory->update($newDocument, $oldDocument);
    }

    /**
     * @inheritDoc
     */
    public function delete(DocumentInterface $document): OperationInterface
    {
        return $this->operationFactory->delete($document);
    }

    /**
     * @inheritDoc
     */
    public function upsert(DocumentInterface $document): OperationInterface
    {
        return $this->operationFactory->upsert($document);
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return $this->operationFactory->getId();
    }
}