<?php

namespace AppBundle\Controller;

use FeedlyClient\Infrastructure\HttpClient;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $token = $this->container->getParameter('feedly.token');
        $feedlyProfileId = $this->container->getParameter('feedly.profile_id');
        $client = new HttpClient();
        $data = $client->getItems($token, $feedlyProfileId);

        return new JsonResponse($data);
    }
}
