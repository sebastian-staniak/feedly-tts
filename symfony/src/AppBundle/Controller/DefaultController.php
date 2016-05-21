<?php

namespace AppBundle\Controller;

use FeedlyClient\Application\ItemsSanitizer;
use FeedlyClient\Infrastructure\FilesystemFeedlyClient;
use FeedlyClient\Infrastructure\HttpFeedlyClient;
use FeedlyClient\Infrastructure\MockedMachineLearningClient;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/feed", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $token = $this->container->getParameter('feedly.token');
        $feedlyProfileId = $this->container->getParameter('feedly.profile_id');
        $client = new FilesystemFeedlyClient();
        $aiClient = new MockedMachineLearningClient();
        $sanitizer = new ItemsSanitizer();

        $items = $client->getItems($token, $feedlyProfileId)->items;
        $items = $sanitizer->sanitize($items);
        $items = $aiClient->rankFeeds($items);

        return new JsonResponse($items);
    }
}
