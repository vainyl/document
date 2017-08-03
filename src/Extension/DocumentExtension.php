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

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Vainyl\Core\Exception\MissingRequiredServiceException;
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
    public function getCompilerPasses(): array
    {
        return [
            new DocumentDatabaseCompilerPass(),
            new DocumentHydratorCompilerPass(),
            new DocumentOperationFactoryCompilerPass(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container): AbstractExtension
    {
        parent::load($configs, $container);
        if (false === $container->hasDefinition('document.registry')) {
            throw new MissingRequiredServiceException($container, 'document.registry');
        }
        $configuration = new DocumentConfiguration();
        $documentConfiguration = $this->processConfiguration($configuration, $configs);

        if (false === $container->hasDefinition('document.operation.factory')) {
            throw new MissingRequiredServiceException($container, 'document.operation.factory');
        }
        $factoryDefinition = $container->findDefinition('document.operation.factory');
        $factoryDefinition->replaceArgument(
            0,
            sprintf('document.operation.factory.%', $documentConfiguration['factory'])
        );
        if (false === $container->hasDefinition('document.hydrator')) {
            throw new MissingRequiredServiceException($container, 'document.hydrator');
        }
        $hydratorDefinition = $container->findDefinition('document.hydrator');
        $hydratorDefinition->replaceArgument(0, sprintf('document.hydrator.%', $documentConfiguration['factory']));
        if (false === $container->hasDefinition('database.document')) {
            throw new MissingRequiredServiceException($container, 'database.document');
        }

        $container->findDefinition('database.document')
                  ->replaceArgument(0, sprintf('database.document.%s', $documentConfiguration['database']))
                  ->addTag('document.database', ['alias' => $documentConfiguration['database']]);

        return $this;
    }
}