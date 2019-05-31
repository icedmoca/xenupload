<?php

namespace nanocode\MineSync\Pub\View\Api;

use XF\Mvc\View;

class GenericApiRequest extends View
{
    public function renderJson()
    {
        return $this->params['data'];
    }
}