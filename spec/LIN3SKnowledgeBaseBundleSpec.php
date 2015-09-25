<?php

/*
 * This file is part of the Knowledge Base package.
 *
 * Copyright (c) 2015 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\LIN3S\KnowledgeBaseBundle\DependencyInjection\Compiler;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Spec class of LIN3S Knowledge Base Bundle Spec.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class LIN3SKnowledgeBaseBundleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('LIN3S\KnowledgeBaseBundle\DependencyInjection\Compiler\ConfigurationCompilerPass');
    }

    function it_extends_bundle()
    {
        $this->shouldHaveType('Symfony\Component\HttpKernel\Bundle\Bundle');
    }

    function it_build(ContainerBuilder $containerBuilder)
    {
        $containerBuilder->addCompilerPass(
            Argument::type('LIN3S\KnowledgeBaseBundle\DependencyInjection\Compiler\GeneratorCompilerPass')
        )->shouldBeCalled()->willReturn($containerBuilder);
        $containerBuilder->addCompilerPass(
            Argument::type('LIN3S\KnowledgeBaseBundle\DependencyInjection\Compiler\ConfigurationCompilerPass')
        )->shouldBeCalled()->willReturn($containerBuilder);

        $this->build($containerBuilder);
    }
}
