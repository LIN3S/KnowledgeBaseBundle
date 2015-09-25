<?php

/*
 * This file is part of the Knowledge Base package.
 *
 * Copyright (c) 2015 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LIN3S\KnowledgeBaseBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Assets command class.
 *
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class AssetCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('lin3s:kb:assets:install')
            ->setDescription('Generates the symlink of assets that are located into Template\'s path');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $template = $this->getContainer()->get('lin3s_knowledge_base.configuration')->template();

        $reflectionClass = new \ReflectionClass($this);
        $targetDirectory = dirname($reflectionClass->getFileName()) . '/../../../../web/templates/' . $template->name();
        $fileSystem = new Filesystem();

        try {
            if ($fileSystem->exists($targetDirectory)) {
                return;
            }
            $fileSystem->symlink($template->assetsPath(), $targetDirectory, true);
            $output->writeln(sprintf('<fg=green>%s</fg=green>', 'The symlink is successfully completed'));
        } catch (\Exception $exception) {
            $output->writeln(
                sprintf(
                    "<fg=red>%s \n%s\n</fg=red>",
                    'Something wrong happens during the symlink process:',
                    $exception->getMessage()
                )
            );
        }
    }
}
