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

namespace Vainyl\Document\Event;

use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Document\DocumentInterface;
use Vainyl\Event\EventInterface;

/**
 * Class UpsertDocumentEvent
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UpsertDocumentEvent extends AbstractIdentifiable implements EventInterface
{
    private $document;

    /**
     * UpsertDocumentEvent constructor.
     *
     * @param DocumentInterface $document
     */
    public function __construct(DocumentInterface $document)
    {
        $this->document = $document;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->document->getName() . '.' . 'upsert';
    }

    /**
     * @return DocumentInterface
     */
    public function getDocument() : DocumentInterface
    {
        return $this->document;
    }
}