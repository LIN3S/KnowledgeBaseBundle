<?php

namespace LIN3S\KnowledgeBaseBundle;

use LIN3S\KnowledgeBaseBundle\DependencyInjection\Compiler\ConfigurationCompilerPass;
use LIN3S\KnowledgeBaseBundle\DependencyInjection\Compiler\GeneratorCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class LIN3SKnowledgeBaseBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new GeneratorCompilerPass());
        $container->addCompilerPass(new ConfigurationCompilerPass());
    }
}

