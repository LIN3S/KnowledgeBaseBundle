<?php

namespace LIN3S\KnowledgeBaseBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

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

        $kbConfig = new Definition('LIN3S\KnowledgeBase\Configuration', [
            $configParameters['docs_path'],
            $configParameters['build_path'],
            new Reference('lin3s_knowledge_base.template'),
            $configParameters['assets_base_url']
        ]);
        $container->setDefinition('lin3s_knowledge_base.configuration', $kbConfig);
    }
} 
