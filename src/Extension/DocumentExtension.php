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

/**
 * Class DocumentExtension
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DocumentExtension extends AbstractExtension
{
    /**
     * @param array $configs
     * @param ContainerBuilder $container
     *
     * @return AbstractExtension
     */
    public function load(array $configs, ContainerBuilder $container): AbstractExtension
    {
        $configuration = new DocumentConfiguration();
        $documentConfiguration = $this->processConfiguration($configuration, $configs);

        $container->removeDefinition('database.document');
        $container->removeDefinition('document.operation.factory');
        $container->setAlias('database.document', new Alias('database.document.' . $documentConfiguration['odm']));
        $container->setAlias(
            'document.operation.factory',
            new Alias('document.operation.factory' . $documentConfiguration['odm'])
        );

        return parent::load($configs, $container);
    }
}