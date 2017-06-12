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

namespace Vainyl\Document\Operation\Factory;

use Vainyl\Core\IdentifiableInterface;
use Vainyl\Document\DocumentInterface;
use Vainyl\Operation\OperationInterface;

/**
 * Class DocumentOperationFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DocumentOperationFactoryInterface extends IdentifiableInterface
{
    /**
     * @param DocumentInterface $document
     *
     * @return OperationInterface
     */
    public function create(DocumentInterface $document) : OperationInterface;

    /**
     * @param DocumentInterface $newDocument
     * @param DocumentInterface $oldDocument
     *
     * @return OperationInterface
     */
    public function update(DocumentInterface $newDocument, DocumentInterface $oldDocument) : OperationInterface;

    /**
     * @param DocumentInterface $document
     *
     * @return OperationInterface
     */
    public function delete(DocumentInterface $document) : OperationInterface;

    /**
     * @param DocumentInterface $document
     *
     * @return OperationInterface
     */
    public function upsert(DocumentInterface $document) : OperationInterface;
}