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

namespace Vainyl\Document\Hydrator;

use Vainyl\Core\IdentifiableInterface;
use Vainyl\Document\DocumentInterface;

/**
 * Interface DocumentHydratorInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DocumentHydratorInterface extends IdentifiableInterface
{
    /**
     * @param string $name
     * @param array $documentData
     *
     * @return DocumentInterface
     */
    public function create(string $name, array $documentData): DocumentInterface;
}