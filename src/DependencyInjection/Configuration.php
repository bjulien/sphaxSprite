<?php

namespace SphaxSprite\DependencyInjection;

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
                                    ->booleanNode('watch')
                                        ->defaultFalse()
                                        ->end()
                                    ->booleanNode('html')
                                        ->defaultFalse()
                                        ->end()
                                    ->booleanNode('png8')
                                        ->defaultFalse()
                                        ->end()
                                    ->booleanNode('ignore_filename_paddings')
                                        ->defaultFalse()
                                        ->end()
                                    ->booleanNode('debug')
                                        ->defaultFalse()
                                        ->end()
                                    ->booleanNode('cachebuster_filename')
                                        ->defaultFalse()
                                        ->end()
                                    ->booleanNode('follow_links')
                                        ->defaultFalse()
                                        ->end()
                                    ->booleanNode('no_img')
                                        ->defaultFalse()
                                        ->end()
                                    ->booleanNode('no_css')
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
                                    ->scalarNode('sprite_namespace')->end()
                                    ->scalarNode('imagemagickpath')->end()
                                    ->scalarNode('global_template')->end()
                                    ->scalarNode('each_template')->end()
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
