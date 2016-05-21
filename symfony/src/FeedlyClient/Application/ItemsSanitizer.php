<?php

namespace FeedlyClient\Application;

class ItemsSanitizer
{
    public function sanitize($items)
    {
        foreach ($items as &$item) {
            if (isset($item->summary)) {
                $item->summary->content = strip_tags($item->summary->content);
                $item->summary->content = str_replace("\n", "", $item->summary->content);
            }
        }

        return $items;
    }
}