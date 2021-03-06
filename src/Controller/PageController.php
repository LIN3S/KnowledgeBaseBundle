<?php

/*
 * This file is part of the Knowledge Base package.
 *
 * Copyright (c) 2015 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LIN3S\KnowledgeBaseBundle\Controller;

use LIN3S\KnowledgeBase\Process\GitProcess;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\HttpFoundation\Response;

/**
 * Page controller class.
 *
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class PageController extends Controller
{
    /**
     * Index action.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $configuration = $this->get('lin3s_knowledge_base.configuration');

        return new Response($configuration->template()->render([
            'menu'          => $this->get('lin3s_knowledge_base.loader.menu')->get('/'),
            'html'          => '<h1>This is our Knowledge Base landing page</h1>',
            'configuration' => $configuration
        ]));
    }

    /**
     * Document action, renders the page of request given.
     *
     * @param string $path Path to the requested document
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function documentAction($path)
    {
        $absolutePathFile = $this->get('kernel')->getRootDir() . '/../docs/' . $path;
        if (file_exists($absolutePathFile)) {
            $response = new Response();
            $response->headers->set('Content-Type', mime_content_type($absolutePathFile));
            $response->headers->set('Content-Disposition', 'inline;filename="' . $path . '";');
            $response->headers->set('Content-length', filesize($absolutePathFile));
            $response->sendHeaders();
            $response->sendContent(readfile($absolutePathFile));

            return $response;
        }

        $configuration = $this->get('lin3s_knowledge_base.configuration');

        return new Response($configuration->template()->render([
            'menu'          => $this->get('lin3s_knowledge_base.loader.menu')->get($path),
            'html'          => $this->get('lin3s_knowledge_base.loader.html')->get($path),
            'configuration' => $configuration
        ]));
    }

    /**
     * Asset action, gets the asset of request given.
     *
     * @param string $path Path to the requested document
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
            $result = 0 === $this->get('lin3s_knowledge_base.command.doc')->run(new ArrayInput([]), new NullOutput())
                ? 'The docs are successfully loaded'
                : 'Something wrong happens during the loading process';
        }

        return new Response($result);
    }
}
