<?php

/*
 * This file is part of the Knowledge Base package.
 *
 * Copyright (c) 2015 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LIN3S\KnowledgeBaseBundle;

use LIN3S\KnowledgeBaseBundle\DependencyInjection\Compiler\ConfigurationCompilerPass;
use LIN3S\KnowledgeBaseBundle\DependencyInjection\Compiler\GeneratorCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class LIN3SKnowledgeBaseBundle.
 *
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
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

