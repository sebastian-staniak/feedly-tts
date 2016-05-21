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
     * @param $userId
     * @param int $amount
     * @return mixed
     */
    public function getItems($token, $userId, $amount = 200)
    {
       return \GuzzleHttp\json_decode(file_get_contents(dirname(__FILE__) . "/data/500-sanitized.json"));
    }

    public function getProfile($token)
    {
        // TODO: Implement getProfile() method.
    }
}