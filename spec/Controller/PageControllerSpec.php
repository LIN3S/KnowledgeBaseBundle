<?php

/*
 * This file is part of the Knowledge Base package.
 *
 * Copyright (c) 2015 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\LIN3S\KnowledgeBaseBundle\Controller;

use LIN3S\KnowledgeBase\Configuration;
use LIN3S\KnowledgeBase\Loader\Interfaces\LoaderInterface;
use LIN3S\KnowledgeBase\Templating\TemplateInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Spec class of page controller.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class PageControllerSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('LIN3S\KnowledgeBaseBundle\Controller\PageController');
    }

    function it_extends_controller()
    {
        $this->shouldHaveType('Symfony\Bundle\FrameworkBundle\Controller\Controller');
    }

    function it_index_action(
        ContainerInterface $container,
        Configuration $configuration,
        TemplateInterface $template,
        LoaderInterface $menuLoader
    ) {
        $container->get('lin3s_knowledge_base.configuration')->shouldBeCalled()->willReturn($configuration);
        $configuration->template()->shouldBeCalled()->willReturn($template);
        $container->get('lin3s_knowledge_base.loader.menu')->shouldBeCalled()->willReturn($menuLoader);
        $menuLoader->get('/')->shouldBeCalled()->willReturn('Menu data');

        $template->render([
            'menu'          => 'Menu data',
            'html'          => '<h1>This is our Knowledge Base landing page</h1>',
            'configuration' => $configuration,
        ])->shouldBeCalled()->willReturn('Template data render');

        $this->indexAction()->shouldReturnAnInstanceOf('Symfony\Component\HttpFoundation\Response');
    }


    function it_document_action(
        ContainerInterface $container,
        Configuration $configuration,
        TemplateInterface $template,
        LoaderInterface $menuLoader,
        LoaderInterface $htmlLoader,
        KernelInterface $kernel
    ) {
        $container->get('kernel')->shouldBeCalled()->willReturn($kernel);
        $container->get('lin3s_knowledge_base.configuration')->shouldBeCalled()->willReturn($configuration);
        $configuration->template()->shouldBeCalled()->willReturn($template);
        $container->get('lin3s_knowledge_base.loader.menu')->shouldBeCalled()->willReturn($menuLoader);
        $menuLoader->get('/')->shouldBeCalled()->willReturn('Menu data');
        $container->get('lin3s_knowledge_base.loader.html')->shouldBeCalled()->willReturn($htmlLoader);
        $htmlLoader->get('/')->shouldBeCalled()->willReturn('Template data');

        $template->render(['menu' => 'Menu data', 'html' => 'Template data', 'configuration' => $configuration])
            ->shouldBeCalled()->willReturn('Template data render');

        $this->documentAction('/')->shouldReturnAnInstanceOf('Symfony\Component\HttpFoundation\Response');
    }

    function it_asset_action(ContainerInterface $container, Configuration $configuration)
    {
        $container->get('lin3s_knowledge_base.configuration')->shouldBeCalled()->willReturn($configuration);
        $configuration->docsPath()->shouldBeCalled()->willReturn('/');

        $this->assetAction('/')->shouldReturnAnInstanceOf('Symfony\Component\HttpFoundation\Response');
    }
}
