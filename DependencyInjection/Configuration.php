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
                                    ->booleanNode('crop')
                                        ->defaultFalse()
                                        ->end()
                                    ->booleanNode('quiet')
                                        ->defaultFalse()
                                        ->end()
                                    ->booleanNode('retina')
                                        ->defaultFalse()
                                        ->end()
                                    ->booleanNode('imagemagick')
                                        ->defaultFalse()
                                        ->end()
                                    ->booleanNode('imagemagickpath')
                                        ->defaultFalse()
                                        ->end()
                                    ->booleanNode('watch')
                                        ->defaultFalse()
                                        ->end()
                                    ->booleanNode('html')
                                        ->defaultFalse()
                                        ->end()
                                    ->booleanNode('png8')
                                        ->defaultFalse()
                                        ->end()
                                    ->booleanNode('ignore-filename-paddings')
                                        ->defaultFalse()
                                        ->end()
                                    ->booleanNode('debug')
                                        ->defaultFalse()
                                        ->end()
                                    ->booleanNode('cachebuster-filename')
                                        ->defaultFalse()
                                        ->end()
                                    ->booleanNode('follow-links')
                                        ->defaultFalse()
                                        ->end()
                                    ->booleanNode('no-img')
                                        ->defaultFalse()
                                        ->end()
                                    ->booleanNode('no-css')
                                        ->defaultFalse()
                                        ->end()
                                    ->scalarNode('namespace')->end()
                                    ->scalarNode('url')->end()
                                    ->scalarNode('padding')->end()
                                    ->scalarNode('ratios')->end()
                                    ->scalarNode('css')->end()
                                    ->scalarNode('img')->end()
                                    ->scalarNode('algorithm')->end()
                                    ->scalarNode('ordering')->end()
                                    ->scalarNode('margin')->end()
                                    ->scalarNode('sprite-namespace')->end()
                                    ->scalarNode('global-template')->end()
                                    ->scalarNode('each-template')->end()
                                    ->scalarNode('optipngpath')->end()
                                    ->scalarNode('separator')->end()
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
