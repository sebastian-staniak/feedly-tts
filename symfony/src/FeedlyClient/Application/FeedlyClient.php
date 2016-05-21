<?php

namespace FeedlyClient\Application;

interface FeedlyClient
{
    /**
     * @param string $token
     * @param $userId
     * @param int $amount
     * @return mixed
     */
    public function getItems($token, $userId, $amount = 200);

    /**
     * @param string $token
     * @return mixed
     */
    public function getProfile($token);

}