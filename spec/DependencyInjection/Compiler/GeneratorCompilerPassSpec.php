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
 * Spec class of Generator Compiler Pass.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class GeneratorCompilerPassSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('LIN3S\KnowledgeBaseBundle\DependencyInjection\Compiler\GeneratorCompilerPass');
    }

    function it_implements_compiler_pass_interface()
    {
        $this->shouldImplement('Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface');
    }

    function it_process(ContainerBuilder $containerBuilder, Definition $definition)
    {
        $containerBuilder->hasDefinition('lin3s_knowledge_base.registry.generator')
            ->shouldBeCalled()->willReturn(true);
        $containerBuilder->getDefinition('lin3s_knowledge_base.registry.generator')
            ->shouldBeCalled()->willReturn($definition);
        $containerBuilder->findTaggedServiceIds('lin3s_knowledge_base.generator')
            ->shouldBeCalled()->willReturn(['id' => [['label' => 'The label']]]);

        $this->process($containerBuilder);
    }

    function it_throws_invalid_argument_exception_when_the_generator_has_not_any_label(
        ContainerBuilder $containerBuilder, Definition $definition
    )
    {
        $containerBuilder->hasDefinition('lin3s_knowledge_base.registry.generator')
            ->shouldBeCalled()->willReturn(true);
        $containerBuilder->getDefinition('lin3s_knowledge_base.registry.generator')
            ->shouldBeCalled()->willReturn($definition);
        $containerBuilder->findTaggedServiceIds('lin3s_knowledge_base.generator')
            ->shouldBeCalled()->willReturn(['id' => [[]]]);

        $this->shouldThrow(
            new \InvalidArgumentException('Tagged generator needs to have `label` attribute.')
        )->during('process', [$containerBuilder]);
    }
}
