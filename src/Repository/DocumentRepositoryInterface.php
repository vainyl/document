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

namespace Vainyl\Document\Repository;

use Vainyl\Core\NameableInterface;
use Vainyl\Document\DocumentInterface;

/**
 * Interface DocumentRepositoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DocumentRepositoryInterface extends NameableInterface
{
    /**
     * @param string $id
     *
     * @return null|DocumentInterface
     */
    public function getDocument(string $id): ?DocumentInterface;
}