<?php

namespace nanocode\MineSync\Admin\Controller;

use XF\Admin\Controller\AbstractController;
use XF\Mvc\ParameterBag;

class Group extends AbstractController
{
    protected function preDispatchController($action, ParameterBag $params)
    {
        $this->assertAdminPermission('minesync');
    }

    public function actionIndex()
    {
        $viewParams = [
            'groups' => $this->repository('nanocode\MineSync:Group')->findGroupsForList()->fetch()
        ];
        return $this->view('nanocode\MineSync:Group\Listing', 'ncms_group_list', $viewParams);
    }

    protected function groupAddEdit(\nanocode\MineSync\Entity\Group $group)
    {
        $userGroups = $this->em()->getRepository('XF:UserGroup')->getUserGroupTitlePairs();
        $userGroups = [0 => 'None'] + $userGroups;

        $viewParams = [
            'group' => $group,
            'userGroups' => $userGroups,
        ];
        return $this->view('nanocode\MineSync:Group\Edit', 'ncms_group_edit', $viewParams);
    }

    public function actionEdit(ParameterBag $params)
    {
        $group = $this->assertGroupExists($params->id);
        return $this->groupAddEdit($group);
    }

    public function actionAdd()
    {
        $group = $this->em()->create('nanocode\MineSync:Group');
        return $this->groupAddEdit($group);
    }

    protected function groupSaveProcess(\nanocode\MineSync\Entity\Group $group)
    {
        $form = $this->formAction();

        $input = $this->filter([
            'name' => 'str',
            'xf_group_id' => 'uint',
            'mc_group_id' => 'str',
            'priority' => 'uint',
            'css_background_colour' => 'str',
            'css_font_colour' => 'str'
        ]);

        $form->basicEntitySave($group, $input);

        return $form;
    }

    public function actionSave(ParameterBag $params)
    {
        $this->assertPostOnly();

        if ($params->id)
        {
            $group = $this->assertGroupExists($params->id);
        } else
        {
            $group = $this->em()->create('nanocode\MineSync:Group');
        }

        $this->groupSaveProcess($group)->run();

        return $this->redirect($this->buildLink('minesync/groups') . $this->buildLinkHash($group->id));
    }

    public function actionDelete(ParameterBag $params)
    {
        $group = $this->assertGroupExists($params->id);
        if (!$group->preDelete())
        {
            return $this->error($group->getErrors());
        }

        if ($this->isPost())
        {
            $group->delete();

            return $this->redirect($this->buildLink('minesync/groups'));
        } else
        {
            $viewParams = [
                'group' => $group
            ];
            return $this->view('nanocode\MineSync:Group\Delete', 'ncms_group_delete', $viewParams);
        }
    }

    /**
     * @param string $id
     * @param array|string|null $with
     * @param null|string $phraseKey
     *
     * @return \nanocode\MineSync\Entity\Group
     */
    protected function assertGroupExists($id, $with = null, $phraseKey = null)
    {
        return $this->assertRecordExists('nanocode\MineSync:Group', $id, $with, $phraseKey);
    }

    /**
     * @return \nanocode\MineSync\Repository\Group
     */
    protected function getGroupRepo()
    {
        return $this->repository('nanocode\MineSync:Group');
    }
}