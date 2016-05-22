<?php

namespace FeedlyClient\Application;

class ContentTrimmer
{
    public function apply($item)
    {
        $temp = substr($item->summary->content, 0, 350);
        $item->summary->content = substr($item->summary->content, 0, strrpos($temp, ' '));

        return $item;
    }
}