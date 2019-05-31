<?php

namespace nanocode\MineSync\Cron;

class ServerStatusRefresh
{
    public static function updateServerStatus()
    {
        $app = \XF::app();
        /* @var \nanocode\MineSync\Service\ServerStatus $serverStatusService */
        $serverStatusService = $app->service('nanocode\MineSync:ServerStatus');

        $serverStatusService->refreshServerStatuses();
    }
}