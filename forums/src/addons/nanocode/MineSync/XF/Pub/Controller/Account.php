<?php

namespace nanocode\MineSync\XF\Pub\Controller;

class Account extends XFCP_Account
{
    public function actionMinesync()
    {
        $visitor = \XF::visitor();

        if ($this->isPost())
        {
            $options = \XF::options();

            if (!$visitor->hasPermission('ncms', 'canEditDisplayGroup'))
            {
                return $this->noPermission();
            }

            $newDisplayGroup = $this->filter('group_id', 'uint');

            if ($newDisplayGroup != $visitor->ncms_group)
            {
                if (!$options->ncmsAllowDisplayGroupChanging)
                {
                    return $this->noPermission();
                }

                $visitor->ncmsSetDisplayGroup($newDisplayGroup);
                $visitor->save();
            }

            return $this->redirect($this->buildLink('account/minesync'));

        } else
        {
            if (!$visitor->hasPermission('ncms', 'canEditDisplayGroup'))
            {
                return $this->noPermission();
            }

            $groups = $this->finder('nanocode\MineSync:Group')
                ->where('id', $visitor->ncms_groups)
                ->order('priority', 'desc')
                ->fetch();

            $viewParams = [
                'groups' => $groups
            ];
            $view = $this->view('nanocode\MineSync:Account\Minesync', 'ncms_account_minesync', $viewParams);
            return $this->addAccountWrapperParams($view, 'minesync');
        }
    }

    public function actionMinesyncUnlink()
    {
        if ($this->isPost())
        {
            $options = \XF::options();
            if (!$options->ncmsAllowUnlinking)
            {
                return $this->noPermission();
            }

            /** @var \XF\Service\User\UserGroupChange $userGroupChange */
            $visitor = \XF::visitor();
            $userGroupChange = \XF::app()->service(('XF:User\UserGroupChange'));

            $groups = $visitor->ncms_groups;

            foreach ($groups as $groupId)
            {
                $userGroupChange->removeUserGroupChange($visitor['user_id'], 'ncmsUgPromotion_' . $visitor['user_id'] . '_' . $groupId);
            }

            $visitor->ncmsUnlinkMinesyncProfile();
            $visitor->save();

            return $this->redirect($this->buildLink('account/minesync'));
        } else
        {
            $view = $this->view('nanocode\MineSync:Account\Unlink', 'ncms_account_minesync_unlink');
            return $this->addAccountWrapperParams($view, 'minesync');
        }
    }
}