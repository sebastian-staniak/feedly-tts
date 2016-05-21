<?php

namespace FeedlyClient\Infrastructure;

use FeedlyClient\Application\MachineLearnignClient;

class MockedMachineLearningClient implements MachineLearnignClient
{

    public function rankFeeds(array $feeds)
    {
        return $feeds;
    }
}