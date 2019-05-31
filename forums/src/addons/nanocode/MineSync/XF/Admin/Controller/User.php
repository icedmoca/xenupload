<?php

namespace nanocode\MineSync\XF\Admin\Controller;

class User extends XFCP_User
{
    protected function userAddEdit(\XF\Entity\User $user)
    {
        $parent = parent::userAddEdit($user);
        $parent->setParam('ncmsGroups', $this->repository('nanocode\MineSync:Group')->getGroupTitlePairs());
        return $parent;
    }

    protected function userSaveProcess(\XF\Entity\User $user)
    {
        $form = parent::userSaveProcess($user);

        $input = $this->filter([
            'user' => [
                'ncms_uuid' => 'str',
                'ncms_username' => 'str',
                'ncms_group' => 'uint',
                'ncms_groups' => 'array-uint'
            ]
        ]);

        $group = $input['user']['ncms_group'];
        $groups = $input['user']['ncms_groups'];
        if (!in_array($group, $groups))
        {
            if (!$groups)
            {
                $input['user']['ncms_group'] = 0;
            } else
            {
                $input['user']['ncms_group'] = $groups[0];
            }
        }

        $form->basicEntitySave($user, $input['user']);

        return $form;
    }
}