<?php

namespace nanocode\MineSync\Repository;

use XF\Mvc\Entity\Repository;

class Key extends Repository
{
    public function getKey($token, $type = 1)
    {
        $key = $this->finder('nanocode\MineSync:Key')
            ->where('token', $token)
            ->where('valid', 1)
            ->where('key_type', $type)
            ->fetchOne();

        return $key;
    }

    public function setKeyForUser($key, $user)
    {
        // update key
        $key->valid = 0;
        if ($user->user_id)
        {
            $key->used = 1;
            $key->user_id = $user->user_id;

        }
        $key->save();

        // update user
        $user->ncms_uuid = $key->uuid;
        $user->ncms_username = $key->mc_username;
    }

    public function createNewLink($user, $key = null)
    {
        $db = $this->db();

        $uuid = $user->ncms_uuid;
        if ($key)
        {
            $uuid = $key->uuid;
        }

        $hasPreviouslyLinked = $this->hasPreviouslyLinked($user, $uuid);

        // set new link entry
        if (!$hasPreviouslyLinked)
        {
            $db->insert('ncms_newlink', [
                'uuid' => $uuid,
                'user_id' => $user->user_id,
                'xf_username' => $user->username,
                'link_date' => time()
            ]);
        }

        // also set token to used and add user ID
        $this->db()->update('ncms_key', [
            'used' => 1,
            'user_id' => $user->user_id
        ], 'uuid = ?', $uuid);
    }

    public function manualUsergroupSync($user)
    {
        $db = $this->db();
        /** @var \nanocode\MineSync\Repository\PlayerUpdate $playerUpdateRepo */
        /** @var \nanocode\MineSync\Service\PlayerUpdate $playerUpdateService */
        $playerUpdateRepo = $this->repository('nanocode\MineSync:PlayerUpdate');
        $playerUpdateService = \XF::service('nanocode\MineSync:PlayerUpdate');

        $playerUpdateRepo->removeDuplicateEntries($user->ncms_uuid);

        $userUpdate = $this->finder('nanocode\MineSync:PlayerUpdate')
            ->where('processed', 0)
            ->where('uuid', $user->ncms_uuid)
            ->order('id', 'desc')
            ->fetchOne();

        if ($userUpdate && $userUpdate->exists())
        {
            $playerUpdateService->runUserCacheUpdate($userUpdate);
            $db->update('ncms_playerupdate', [
                'processed' => 1
            ], "uuid = ?", $user->ncms_uuid);
        }
    }

    public function hasPreviouslyLinked($user, $uuid)
    {
        $previouslyLinked = $this->finder('nanocode\MineSync:Key')
            ->whereOr(
                ['user_id', $user->user_id],
                ['uuid', $uuid]
            )
            ->where('used', 1)
            ->fetchOne();

        return ($previouslyLinked && $previouslyLinked->exists());
    }
}