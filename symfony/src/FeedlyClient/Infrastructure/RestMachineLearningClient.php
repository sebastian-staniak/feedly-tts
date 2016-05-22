<?php

namespace FeedlyClient\Infrastructure;

use FeedlyClient\Application\MachineLearnignClient;
use GuzzleHttp\Client;

class RestMachineLearningClient implements MachineLearnignClient
{
    /** @var  Client */
    private $client;

    /** @var  string */
    private $baseUrl;

    /**
     * RestMachineLearningClient constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = "https://feedly-tts-rec.herokuapp.com";
    }


    public function rankFeeds(array $feeds)
    {
        $url = $this->baseUrl . "/rank";

        $result = $this->client->post($url, [
            "headers" => [
                "Content-Type" => "application/json"
            ],
            "json" => $feeds])->getBody();

        return \GuzzleHttp\json_decode($result->getContents());
    }
}