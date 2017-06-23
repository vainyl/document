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

namespace Vainyl\Document\Operation;

use Vainyl\Core\ResultInterface;
use Vainyl\Document\DocumentInterface;
use Vainyl\Operation\AbstractOperation;
use Vainyl\Operation\SuccessfulOperationResult;
use Vainyl\Time\TimeInterface;

/**
 * Class SetUpdatedAtOperation
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class SetUpdatedAtOperation extends AbstractOperation
{
    private $document;

    private $time;

    /**
     * SetUpdatedAtOperation constructor.
     *
     * @param DocumentInterface $document
     * @param TimeInterface     $time
     */
    public function __construct(DocumentInterface $document, TimeInterface $time)
    {
        $this->document = $document;
        $this->time = $time;
    }

    /**
     * @inheritDoc
     */
    public function execute(): ResultInterface
    {
        $this->document->setUpdatedAt($this->time);

        return new SuccessfulOperationResult($this);
    }
}