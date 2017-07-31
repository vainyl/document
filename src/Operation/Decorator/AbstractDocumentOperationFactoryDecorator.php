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
use Vainyl\Domain\DomainInterface;
use Vainyl\Domain\Operation\Decorator\AbstractDomainOperationFactoryDecorator;

/**
 * Class AbstractDocumentOperationFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractDocumentOperationFactoryDecorator extends AbstractDomainOperationFactoryDecorator implements
    DocumentOperationFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function supports(DomainInterface $domain): bool
    {
        return $domain instanceof DocumentInterface && parent::supports($domain);
    }
}