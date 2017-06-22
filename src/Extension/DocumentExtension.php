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
use Vainyl\Core\Extension\AbstractFrameworkExtension;
use Vainyl\Core\Extension\AbstractExtension;

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
        $factoryId = 'document.operation.factory.' . $documentConfiguration['factory'];
        $hydratorId = 'document.factory.' . $documentConfiguration['factory'];
        $container->setAlias('database.document', new Alias($databaseId));
        $container->setAlias('document.operation.factory', new Alias($factoryId));
        $container->setAlias('document.factory', new Alias($hydratorId));

        return $this;
    }
}