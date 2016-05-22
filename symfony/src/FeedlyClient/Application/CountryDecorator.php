<?php

namespace FeedlyClient\Application;

class CountryDecorator
{
    public function apply($item)
    {
        $url = $item->origin->htmlUrl;
        if (strstr($url, ".com")) {
            $locale = "en-US";
        } else if (strstr($url, ".co.uk")) {
            $locale = "en-GB";
        } else {
            $locale = "pl-PL";
        }

        $item->locale = $locale;

        return $item;
    }
}