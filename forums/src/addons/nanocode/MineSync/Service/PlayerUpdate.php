<?php

namespace nanocode\MineSync\Service;

use XF\Service\AbstractService;

class PlayerUpdate extends AbstractService
{
    public function runUserCacheUpdate($update)
    {
        if (empty($update))
        {
            return false;
        }

        /** @var \nanocode\MineSync\Repository\Group $groupRepo */
        /** @var \XF\Service\User\UserGroupChange $userGroupChange */
        $groupRepo = $this->repository('nanocode\MineSync:Group');
        $userGroupChange = \XF::app()->service('XF:User\UserGroupChange');
        $groupsById = $groupRepo->getAllGroups();
        $user = $this->finder('XF:User')->where('ncms_uuid', $update->uuid)->fetchOne();

        if (!$user)
        {
            return false;
        }

        // begin transaction
        $db = \XF::app()->db();
        $db->beginTransaction();

        $updateDisplayGroup = true;
        $newGroupsExploded = explode(',', $update['groups']);
        $newGroups = array();

        foreach ($groupsById as $id => $group)
        {
            foreach ($newGroupsExploded as $groupName)
            {
                if ($groupName == $group['mc_group_id'])
                {
                    $newGroups[] = $id;
                }
            }
        }

        $oldGroups = $user->ncms_groups;
        if (in_array($user->ncms_group, $newGroups))
        {
            $updateDisplayGroup = false;
        }

        $noDiff = array_diff($newGroups, $oldGroups);
        foreach ($noDiff as $item)
        {
            if (isset($groupsById[$item]['xf_group_id']))
            {
                $userGroupChange->addUserGroupChange($user['user_id'], 'ncmsUgPromotion_' . $user['user_id'] . '_' . $item, $groupsById[$item]['xf_group_id']);
            }
        }

        $onDiff = array_diff($oldGroups, $newGroups);
        foreach ($onDiff as $item)
        {
            $userGroupChange->removeUserGroupChange($user['user_id'], 'ncmsUgPromotion_' . $user['user_id'] . '_' . $item);
        }

        $updateDisplayGroupV = '';
        if ($updateDisplayGroup || !$user->ncms_group_change_date)
        {
            $updateDisplayGroup = true;
            if (isset($newGroups[0]))
            {
                $updateDisplayGroupV = $newGroups[0];
            } else
            {
                // not sure what happened here
                $updateDisplayGroupV = '0';
            }
        }

        $user->ncms_username = $update['mc_username'];
        $user->ncms_groups = $newGroups;

        if ($updateDisplayGroup)
        {
            $user->ncms_group = $updateDisplayGroupV;
        }

        $user->save(false);

        // commit transaction
        $db->commit();

        return true;
    }
}