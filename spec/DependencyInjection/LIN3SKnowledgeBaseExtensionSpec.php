<?php

/*
 * This file is part of the Knowledge Base package.
 *
 * Copyright (c) 2015 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\LIN3S\KnowledgeBaseBundle\DependencyInjection;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Spec class of LIN3S Knowledge Base Extension.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class LIN3SKnowledgeBaseExtensionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('LIN3S\KnowledgeBaseBundle\DependencyInjection\LIN3SKnowledgeBaseExtension');
    }

    function it_extends_extension()
    {
        $this->shouldHaveType('Symfony\Component\HttpKernel\DependencyInjection\Extension');
    }

    function it_gets_config_tree_builder(ContainerBuilder $containerBuilder)
    {
        $this->load(['lin3s_knowledge_base' => ['template' => '']], $containerBuilder);
    }
}
