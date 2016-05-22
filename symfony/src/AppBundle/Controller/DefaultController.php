<?php

namespace AppBundle\Controller;

use FeedlyClient\Application\ContentTrimmer;
use FeedlyClient\Application\CountryDecorator;
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
     * @Route("/feed", name="getFeed")
     */
    public function feedAction(Request $request)
    {
        $token = $this->container->getParameter('feedly.token');
        $feedlyProfileId = $this->container->getParameter('feedly.profile_id');

        $client = new FilesystemFeedlyClient();
        $aiClient = new MockedMachineLearningClient();
        $sanitizer = new ItemsSanitizer([new CountryDecorator(), new ContentTrimmer()]);

        $items = $client->getItems($token, $feedlyProfileId, 200);
        $items = $sanitizer->sanitize($items);
        $items = $aiClient->rankFeeds($items);

        return new JsonResponse(["items" => $items]);
    }

    /**
     * @Route("/saveForLater", name="")
     */
    public function saveForLater(Request $request)
    {
        $itemIds = ["6tEjjG1yas2HK/Qxnos1q7W8ioIhhmXKTYoNgwIjOLo=_154d599cc5b:5dbab03:97af7a9a"];
        $token = $this->container->getParameter('feedly.token');

        $client = new HttpFeedlyClient();
        $client->saveForLater($token, $itemIds);

        return new JsonResponse("", 204);
    }

}
