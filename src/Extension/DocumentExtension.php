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

namespace Vainyl\Document\Extension;

use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Vainyl\Core\Extension\AbstractExtension;
use Vainyl\Core\Extension\AbstractFrameworkExtension;

/**
 * Class DocumentExtension
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DocumentExtension extends AbstractFrameworkExtension
{
    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container): AbstractExtension
    {
        parent::load($configs, $container);

        $configuration = new DocumentConfiguration();
        $documentConfiguration = $this->processConfiguration($configuration, $configs);

        $databaseId = 'database.' . $documentConfiguration['database'];
        $operationId = 'document.operation.factory.' . $documentConfiguration['factory'];
        $hydratorId = 'document.hydrator.' . $documentConfiguration['factory'];
        $container->setAlias('database.document', new Alias($databaseId));
        $container->setAlias('document.operation.factory', new Alias($operationId));
        $container->setAlias('document.hydrator', new Alias($hydratorId));

        return $this;
    }
}