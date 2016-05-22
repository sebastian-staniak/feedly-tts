<?php

namespace FeedlyClient\Application;

class ItemsSanitizer
{
    private $decorators;

    /**
     * ItemsSanitizer constructor.
     * @param $decorators
     */
    public function __construct(array $decorators = [])
    {
        $this->decorators = $decorators;
    }


    public function sanitize($items)
    {
        foreach ($items as &$item) {
            if (isset($item->summary)) {
                $item->summary->content = strip_tags($item->summary->content);
                $item->summary->content = str_replace("\n", "", $item->summary->content);
                foreach ($this->decorators as $decorator) {
                    $item = $decorator->apply($item);
                }
            }
        }

        return $items;
    }
}