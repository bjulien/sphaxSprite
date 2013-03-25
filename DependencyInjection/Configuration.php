<?php

namespace Sphax\SpriteBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sphax_sprite');

        $rootNode
            ->children()
                /*->arrayNode('default')
                    ->children()
                        ->scalarNode('source')->end()
                        ->scalarNode('outputCSS')->end()
                        ->scalarNode('outputSpriteImage')->end()
                    ->end()
                ->end()*/

                ->arrayNode('sprite')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('nameBin')
                                ->defaultValue('glue')
                                ->end()
                            //->scalarNode('outputCSS')->end()
                            ->scalarNode('sourceSpriteImage')
                                ->isRequired()
                                ->end()
                            ->scalarNode('outputSpriteImage')
                                ->isRequired()
                                ->end()
                            ->booleanNode('force')
                                ->defaultFalse()
                                ->end()
                            ->arrayNode('options')
                                ->children()
                                    ->booleanNode('optipng')
                                        ->defaultTrue()
                                        ->end()
                                    ->booleanNode('cachebuster')
                                        ->defaultTrue()
                                        ->end()
                                    ->booleanNode('less')
                                        ->defaultFalse()
                                        ->end()
                                    ->scalarNode('namespace')->end()
                                    //->scalarNode('separator')->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
