<?php

namespace nanocode\MineSync\Cron;

class ProcessUpdates
{
    public static function runPlayerUpdateProcessor()
    {
        $app = \XF::app();
        $db = $app->db();
        /** @var \nanocode\MineSync\Repository\PlayerUpdate $playerUpdateRepo */
        /** @var \nanocode\MineSync\Service\PlayerUpdate $playerUpdateService */
        $playerUpdateRepo = $app->repository('nanocode\MineSync:PlayerUpdate');
        $playerUpdateService = $app->service('nanocode\MineSync:PlayerUpdate');

        $playerUpdateRepo->removeDuplicateEntries();

        $completedEntries = [];
        $usersPendingUpdates = $app->finder('nanocode\MineSync:PlayerUpdate')
            ->where('processed', 0)
            ->fetch();

        foreach ($usersPendingUpdates AS $update)
        {
            $playerUpdateService->runUserCacheUpdate($update);
            $completedEntries[] = $update->id;
        }

        $completedEntries = implode("', '", $completedEntries);
        $db->update('ncms_playerupdate', [
            'processed' => 1
        ], "id IN ('" . $completedEntries . "')");
    }
}