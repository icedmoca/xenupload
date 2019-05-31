<?php

namespace nanocode\MineSync\Cron;

class Invalidations
{
    public static function runNewLinkInvalidations()
    {
        $app = \XF::app();

        /** @var \nanocode\MineSync\Repository\Invalidations $invalidationsRepo */
        $invalidationsRepo = $app->repository('nanocode\MineSync:Invalidations');
        $invalidationsRepo->invalidateNewLinks();
    }

    public static function runOldTokenInvalidations()
    {
        $app = \XF::app();

        /** @var \nanocode\MineSync\Repository\Invalidations $invalidationsRepo */
        $invalidationsRepo = $app->repository('nanocode\MineSync:Invalidations');
        $invalidationsRepo->invalidateOldTokens();
    }
}