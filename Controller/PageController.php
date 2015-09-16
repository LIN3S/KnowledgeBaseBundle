<?php

/*
 * This file is part of the Knowledge Base Bundle project.
 *
 * Copyright (c) 2015 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LIN3S\KnowledgeBaseBundle\Controller;

use LIN3S\KnowledgeBase\Process\GitProcess;
use LIN3S\KnowledgeBaseBundle\Command\DocCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\HttpFoundation\Response;

/**
 * Page controller class.
 *
 * @author Gorka Laucirica <gorka@lin3s.com>
 * @author Beñat Espiña <bespina@lin3s.com>
 */
class PageController extends Controller
{
    /**
     * Document action, renders the page of request given.
     *
     * @param string $path Path to the requested document
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function documentAction($path)
    {
        $configuration = $this->get('lin3s_knowledge_base.configuration');
        return new Response($configuration->template()->render(
            $this->get('lin3s_knowledge_base.loader.default')->getTemplateData($path)
        ));
    }

    /**
     * Asset action, gets the asset of request given.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request The request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function assetAction($path)
    {
        $configuration = $this->get('lin3s_knowledge_base.configuration');
        return new Response(file_get_contents($configuration->docsPath() . $path));
    }

    /**
     * Action that wrappers the logic about loading the docs.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loadDocsAction()
    {
        if (true === $result = GitProcess::updateModules()) {
            $command = new DocCommand();
            $result = 0 === $command->run(new ArrayInput([]), new NullOutput())
                ? 'The docs are successfully loaded'
                : 'Something wrong happens during the loading process';
        }

        return new Response($result);
    }
}
