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

namespace Vainyl\Document\Factory;

use Vainyl\Core\IdentifiableInterface;
use Vainyl\Document\DocumentInterface;

/**
 * Interface DocumentFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DocumentFactoryInterface extends IdentifiableInterface
{
    /**
     * @param string $documentName
     * @param array  $documentData
     *
     * @return DocumentInterface
     */
    public function create(string $documentName, array $documentData = []): DocumentInterface;
}