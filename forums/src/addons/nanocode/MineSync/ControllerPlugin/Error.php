<?php

namespace nanocode\MineSync\ControllerPlugin;

use XF\ControllerPlugin\AbstractPlugin;

class Error extends AbstractPlugin
{
    public function actionApiAuthenticationError()
    {
        return $this->error(\XF::phrase('ncms_api_authentication_error'), 401);
    }
}