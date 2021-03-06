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
 * Class DeleteDocumentEvent
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DeleteDocumentEvent extends AbstractIdentifiable implements EventInterface
{
    private $document;

    /**
     * DeleteDocumentEvent constructor.
     *
     * @param DocumentInterface $document
     */
    public function __construct(DocumentInterface $document)
    {
        $this->document = $document;
    }

    /**
     * @return DocumentInterface
     */
    public function getDocument(): DocumentInterface
    {
        return $this->document;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return sprintf('document.%s.delete', $this->document->getName());
    }
}