<?php
/**
 * Created by PhpStorm.
 * User: sstaniak
 * Date: 21.05.2016
 * Time: 22:47
 */

namespace FeedlyClient\Infrastructure;

use FeedlyClient\Application\Client as ClientInterface;
use GuzzleHttp\Client;

class HttpClient implements ClientInterface
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


    public function getItems($token, $profileId)
    {
        $uri = $this->baseUrl . "/v3/mixes/contents?streamId=user%2F{$profileId}%2Fcategory%2Fglobal.all";
        return \GuzzleHttp\json_decode($this->httpClient->get($uri, [
            "headers" => [
                "Authorization" => "OAuth {$token}"
            ]
        ])->getBody());
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
}