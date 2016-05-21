<?php

namespace FeedlyClient\Application;

interface MachineLearnignClient
{
    public function rankFeeds(array $feeds);

}