<?php

/*
 * This file is part of the Knowledge Base Bundle project.
 *
 * Copyright (c) 2015 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LIN3S\KnowledgeBaseBundle\Command;

use LIN3S\KnowledgeBase\Builder\DocumentationBuilder;
use LIN3S\KnowledgeBase\Configuration;
use LIN3S\KnowledgeBase\Generator\HTMLGenerator;
use LIN3S\KnowledgeBase\Generator\MenuGenerator;
use LIN3S\KnowledgeBase\Iterator\DocumentIterator;
use LIN3S\KnowledgeBase\Registry\GeneratorRegistry;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Documents command class.
 *
 * @author Gorka Laucirica <gorka@lin3s.com>
 * @author Beñat Espiña <bespina@lin3s.com>
 */
class DocCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('lin3s:kb:docs:load')
            ->setDescription('Loads the documents');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $configuration = $this->getContainer()->get('lin3s_knowledge_base.configuration');
        try {
            $generatorRegistry = new GeneratorRegistry();
            $generatorRegistry
                ->add('html', new HTMLGenerator($configuration))
                ->add('route', new MenuGenerator($configuration));

            $builder = new DocumentationBuilder(
                new DocumentIterator($configuration), $generatorRegistry
            );
            $builder->build();

            $output->writeln(sprintf('<fg=green>%s</fg=green>', 'The docs are successfully loaded'));
        } catch (\Exception $exception) {
            $output->writeln(
                sprintf(
                    "<fg=red>%s \n%s\n</fg=red>",
                    'Something wrong happens during the loading process:',
                    $exception->getMessage()
                )
            );
        }
    }
}
