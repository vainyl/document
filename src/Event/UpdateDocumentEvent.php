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
 * Class UpdateDocumentEvent
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UpdateDocumentEvent extends AbstractIdentifiable implements EventInterface
{
    private $newDocument;

    private $oldDocument;

    /**
     * UpdateDocumentEvent constructor.
     *
     * @param DocumentInterface $newDocument
     * @param DocumentInterface $oldDocument
     */
    public function __construct(DocumentInterface $newDocument, DocumentInterface $oldDocument)
    {
        $this->newDocument = $newDocument;
        $this->oldDocument = $oldDocument;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return sprintf('document.%s.update', $this->newDocument->getName());
    }

    /**
     * @return DocumentInterface
     */
    public function getNewDocument(): DocumentInterface
    {
        return $this->newDocument;
    }

    /**
     * @return DocumentInterface
     */
    public function getOldDocument(): DocumentInterface
    {
        return $this->oldDocument;
    }
}