<?php
/**
 * Created by PhpStorm.
 * User: sstaniak
 * Date: 22.05.2016
 * Time: 00:07
 */

namespace FeedlyClient\Infrastructure;

use FeedlyClient\Application\FeedlyClient;

class FilesystemFeedlyClient implements FeedlyClient
{

    /**
     * @param string $token
     * @return mixed
     */
    public function getItems($token, $userId)
    {
       return \GuzzleHttp\json_decode(file_get_contents(dirname(__FILE__) . "/data/50.json"));
    }

    public function getProfile($token)
    {
        // TODO: Implement getProfile() method.
    }
}