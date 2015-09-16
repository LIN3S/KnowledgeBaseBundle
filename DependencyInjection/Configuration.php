<?php

namespace LIN3S\KnowledgeBaseBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $treeBuilder->root('lin3_s_knowledge_base')
            ->children()
                ->scalarNode('docs_path')
                    ->defaultValue('%kernel.root_dir%/../docs/')
                ->end()
                ->scalarNode('build_path')
                    ->defaultValue('%kernel.cache_dir%/lin3s_knowledge_base/')
                ->end()
                ->scalarNode('template')
                    ->isRequired()
                ->end()
                ->scalarNode('assets_base_url')
                    ->defaultValue('/templates')
                ->end()
            ->end()
        ->end();
        return $treeBuilder;
    }
}
