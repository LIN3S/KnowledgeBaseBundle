<?php

/*
 * This file is part of the Knowledge Base package.
 *
 * Copyright (c) 2015 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\LIN3S\KnowledgeBaseBundle\Command;

use LIN3S\KnowledgeBase\Configuration;
use LIN3S\KnowledgeBase\Templating\TemplateInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Spec class of asset command.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class AssetCommandSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('LIN3S\KnowledgeBaseBundle\Command\AssetCommand');
    }

    function it_extends_container_aware_command()
    {
        $this->shouldHaveType('Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand');
    }

    function it_executes(
        ContainerInterface $container,
        KernelInterface $kernel,
        InputInterface $input,
        OutputInterface $output,
        Configuration $configuration,
        TemplateInterface $template
    ) {
        $container->get('lin3s_knowledge_base.configuration')->shouldBeCalled()->willReturn($configuration);
        $container->get('kernel')->shouldBeCalled()->willReturn($kernel);
        $configuration->assetsBaseUrl()->shouldBeCalled()->willReturn('/template');
        $configuration->template()->shouldBeCalled()->willReturn($template);
        $template->name()->shouldBeCalled()->willReturn(Argument::any());
        $input->hasArgument('command')->shouldBeCalled()->willReturn(true);
        $input->getArgument('command')->shouldBeCalled()->willReturn('lin3s:kb:docs:load');
        $input->bind(Argument::any())->shouldBeCalled();
        $input->isInteractive()->shouldBeCalled()->willReturn(false);
        $input->validate()->shouldBeCalled();
        $output->writeln(Argument::any())->shouldBeCalled();

        $this->run($input, $output);
    }
}
