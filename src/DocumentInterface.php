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

namespace Vainyl\Document;

use Vainyl\Core\ArrayInterface;
use Vainyl\Core\NameableInterface;
use Vainyl\Time\TimeInterface;

/**
 * Interface DocumentInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DocumentInterface extends ArrayInterface, NameableInterface
{
    /**
     * @param TimeInterface $time
     *
     * @return ArrayInterface
     */
    public function setCreatedAt(TimeInterface $time): ArrayInterface;

    /**
     * @param TimeInterface $time
     *
     * @return ArrayInterface
     */
    public function setUpdatedAt(TimeInterface $time): ArrayInterface;

    /**
     * @return TimeInterface
     */
    public function createdAt(): TimeInterface;

    /**
     * @return TimeInterface
     */
    public function updatedAt(): TimeInterface;
}