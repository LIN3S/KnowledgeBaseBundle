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
use Symfony\Component\DependencyInjection\Definition;

/**
 * Spec class of Configuration Compiler Pass.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class ConfigurationCompilerPassSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('LIN3S\KnowledgeBaseBundle\DependencyInjection\Compiler\ConfigurationCompilerPass');
    }

    function it_implements_compiler_pass_interface()
    {
        $this->shouldImplement('Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface');
    }

    function it_process(ContainerBuilder $containerBuilder, Definition $definition)
    {
        $containerBuilder->getParameter('lin3s_knowledge_base.configuration_parameters')
            ->shouldBeCalled()->willReturn([
                'template' => '', 'docs_path' => '', 'build_path' => '', 'assets_base_url' => ''
            ]);
        $containerBuilder->setDefinition(
            'lin3s_knowledge_base.template', Argument::type('Symfony\Component\DependencyInjection\Definition')
        )->shouldBeCalled()->willReturn($definition);

        $containerBuilder->setDefinition(
            'lin3s_knowledge_base.configuration', Argument::type('Symfony\Component\DependencyInjection\Definition')
        )->shouldBeCalled()->willReturn($definition);


        $this->process($containerBuilder);
    }
}
