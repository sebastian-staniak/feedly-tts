<?php

namespace FeedlyClient\Application;

class DomainExtractor
{
    public function apply($item)
    {
        $url = $item->origin->htmlUrl;
        $domain = parse_url($url, PHP_URL_HOST);
        $item->domain = str_replace("www.", "", $domain);

        return $item;
    }
}