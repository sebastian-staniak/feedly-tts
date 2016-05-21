<?php

namespace FeedlyClient\Application;

interface FeedlyClient
{
    /**
     * @param string $token
     * @return mixed
     */
    public function getItems($token, $userId);

    public function getProfile($token);

}