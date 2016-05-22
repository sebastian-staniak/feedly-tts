<?php
/**
 * Created by PhpStorm.
 * User: sstaniak
 * Date: 21.05.2016
 * Time: 22:47
 */

namespace FeedlyClient\Infrastructure;

use FeedlyClient\Application\FeedlyClient as ClientInterface;
use GuzzleHttp\Client;

class HttpFeedlyClient implements ClientInterface
{
    /** @var  Client */
    private $httpClient;

    private $baseUrl;

    /**
     * HttpClient constructor.
     */
    public function __construct()
    {
        $this->httpClient = new Client();
        $this->baseUrl = "http://cloud.feedly.com";
    }


    public function getItems($token, $profileId, $amount = 200)
    {
        $uri = $this->baseUrl . "/v3/streams/contents?streamId=user%2F{$profileId}%2Fcategory%2Fglobal.all&count={$amount}";
        return \GuzzleHttp\json_decode($this->httpClient->get($uri, [
            "headers" => [
                "Authorization" => "OAuth {$token}"
            ]
        ])->getBody())->items;
    }

    public function getProfile($token)
    {
        $uri = $this->baseUrl . "/v3/profile";
        return \GuzzleHttp\json_decode($this->httpClient->get($uri, [
            "headers" => [
                "Authorization" => "OAuth {$token}"
            ]
        ])->getBody());
    }

    public function saveForLater($token, array $itemIds)
    {
        $uri = $this->baseUrl . "/v3/markers";
        $body = [];
        $body["type"] = "entries";
        $body["entryIds"] = $itemIds;
        $body["action"] = "markAsSaved";
        $this->httpClient->post($uri, [
            "headers" => [
                "Authorization" => "OAuth {$token}",
                "Content-Type" => "application/json"
            ],
            "json" => $body
        ]);
    }

    public function markAsRead($token, array $itemIds)
    {
        $uri = $this->baseUrl . "/v3/markers";
        $body = [];
        $body["type"] = "entries";
        $body["entryIds"] = $itemIds;
        $body["action"] = "markAsRead";
        $this->httpClient->post($uri, [
            "headers" => [
                "Authorization" => "OAuth {$token}",
                "Content-Type" => "application/json"
            ],
            "json" => $body
        ]);
    }
}