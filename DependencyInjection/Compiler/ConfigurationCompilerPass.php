<?php

/*
 * This file is part of the Knowledge Base Bundle project.
 *
 * Copyright (c) 2015 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LIN3S\KnowledgeBaseBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ConfigurationCompilerPass.
 *
 * Loads config from parameters and adds definitions in the container for template and configuration as
 * 'lin3s_knowledge_base.template' and 'lin3s_knowledge_base.configuration' respectively.
 *
 * @package LIN3S\KnowledgeBaseBundle\DependencyInjection\Compiler
 */
class ConfigurationCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $configParameters = $container->getParameter('lin3s_knowledge_base.configuration_parameters');

        $container->setDefinition('lin3s_knowledge_base.template', new Definition(
            $configParameters['template']
        ));

        $config = new Definition('LIN3S\KnowledgeBase\Configuration', [
            $configParameters['docs_path'],
            $configParameters['build_path'],
            new Reference('lin3s_knowledge_base.template'),
            $configParameters['assets_base_url']
        ]);
        $container->setDefinition('lin3s_knowledge_base.configuration', $config);
    }
} 
