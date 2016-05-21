<?php

namespace FeedlyClient\Application;

interface Client
{
    /**
     * @param string $token
     * @return mixed
     */
    public function getItems($token, $userId);

    public function getProfile($token);

}