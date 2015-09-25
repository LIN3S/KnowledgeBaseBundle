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

/**
 * Spec class of Configuration.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class ConfigurationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('LIN3S\KnowledgeBaseBundle\DependencyInjection\Configuration');
    }

    function it_implements_compiler_pass_interface()
    {
        $this->shouldImplement('Symfony\Component\Config\Definition\ConfigurationInterface');
    }

    function it_gets_config_tree_builder()
    {
        $this->getConfigTreeBuilder()->shouldReturnAnInstanceOf(
            'Symfony\Component\Config\Definition\Builder\TreeBuilder'
        );
    }
}
