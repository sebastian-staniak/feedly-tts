<?php

namespace FeedlyClient\Application;

class DomainExtractor
{
    public function apply($item)
    {
        $url = $item->origin->htmlUrl;
        $item->domain = parse_url($url, PHP_URL_HOST);

        return $item;
    }
}