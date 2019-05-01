<?php

namespace Playbloom\Satisfy\Controller;

use Playbloom\Satisfy\Service\Manager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controller to handle index page
 */
class IndexController extends Controller
{
    public function indexAction(): Response
    {
        $manager = $this->container->get(Manager::class);

        $configuration = $manager->getConfig();
        $outputDir = $configuration->getOutputDir();

        $indexFile = $outputDir . '/index.html';
        if (!file_exists($indexFile)) {
            return $this->container->get('templating')->renderResponse('unavailable.html.twig');
        }

        return new BinaryFileResponse($indexFile, 200, [], false);
    }
}
