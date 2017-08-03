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

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Vainyl\Core\Exception\MissingRequiredFieldException;
use Vainyl\Core\Exception\MissingRequiredServiceException;

/**
 * Class DocumentOperationFactoryCompilerPass
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DocumentOperationFactoryCompilerPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        if (false === ($container->hasDefinition('document.registry'))) {
            throw new MissingRequiredServiceException($container, 'document.registry');
        }

        $registryDefinition = $container->getDefinition('document.registry');
        foreach ($container->findTaggedServiceIds('document.operation.factory') as $id => $tags) {
            foreach ($tags as $attributes) {
                if (false === array_key_exists('alias', $attributes)) {
                    throw new MissingRequiredFieldException($container, $id, $attributes, 'alias');
                }

                $registryDefinition
                    ->addMethodCall('addFactory', [$attributes['alias'], new Reference($id)]);
            }
        }

        return $this;
    }
}