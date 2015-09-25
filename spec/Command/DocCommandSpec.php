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
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Spec class of doc command.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class DocCommandSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('LIN3S\KnowledgeBaseBundle\Command\DocCommand');
    }

    function it_extends_container_aware_command()
    {
        $this->shouldHaveType('Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand');
    }

    function it_executes(
        ContainerInterface $container,
        InputInterface $input,
        OutputInterface $output,
        Configuration $configuration
    )
    {
        $container->get('lin3s_knowledge_base.configuration')->shouldBeCalled()->willReturn($configuration);
        $input->bind(Argument::any())->shouldBeCalled();
        $input->isInteractive()->shouldBeCalled()->willReturn(false);
        $input->validate()->shouldBeCalled();
        $output->writeln(Argument::any())->shouldBeCalled();

        $this->run($input, $output);
    }
}
