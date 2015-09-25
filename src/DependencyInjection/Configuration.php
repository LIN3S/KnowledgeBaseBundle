<?php

/*
 * This file is part of the Knowledge Base package.
 *
 * Copyright (c) 2015 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LIN3S\KnowledgeBaseBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration.
 *
 * Defines the config tree editable from the config.yml file.
 *
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $treeBuilder->root('lin3s_knowledge_base')
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
