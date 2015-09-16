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
use Symfony\Component\DependencyInjection\Reference;

class GeneratorCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('lin3s_knowledge_base.registry.generator')) {
            return;
        }
        $registry = $container->getDefinition('lin3s_knowledge_base.registry.generator');
        foreach ($container->findTaggedServiceIds('lin3s_knowledge_base.generator') as $id => $attributes) {
            if (!isset($attributes[0]['label'])) {
                throw new \InvalidArgumentException('Tagged generator needs to have `label` attribute.');
            }
            $name = $attributes[0]['label'];
            $registry->addMethodCall('add', [$name, new Reference($id)]);
        }
    }
}
