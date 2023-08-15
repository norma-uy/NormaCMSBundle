<?php

namespace NormaUy\Bundle\NormaCMSBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\BooleanNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\VariableNodeDefinition;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Samuel Alvarez <samale456uruguay@gmail.com>
 */
class NormaCMSConfiguration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('norma_cms_bundle');

        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
            ->arrayNode('recaptcha')
            ->addDefaultsIfNotSet()
            ->append($this->enableNode())
            ->info('')
            ->end()
            ->arrayNode('pages')
            ->addDefaultsIfNotSet()
            ->append($this->permalinkNode())
            ->info('')
            ->end()
            ->end();

        return $treeBuilder;
    }

    private function enableNode(): BooleanNodeDefinition
    {
        $node = new BooleanNodeDefinition('enable');
        $node->defaultTrue();

        return $node;
    }

    private function permalinkNode(): VariableNodeDefinition
    {
        $node = new VariableNodeDefinition('permalink');
        $node->defaultValue('\/{slug}\/');

        return $node;
    }
}
