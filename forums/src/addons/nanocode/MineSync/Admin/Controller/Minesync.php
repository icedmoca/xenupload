<?php

namespace nanocode\MineSync\Admin\Controller;

use XF\Admin\Controller\AbstractController;
use XF\Mvc\ParameterBag;

class Minesync extends AbstractController
{
    protected function preDispatchController($action, ParameterBag $params)
    {
        $this->assertAdminPermission('minesync');
    }

    public function actionIndex()
    {
        return $this->view('nanocode\MineSync:Listing', 'ncms_nav');
    }

    public function actionRegenApiKey()
    {
        if ($this->isPost())
        {
            /** @var \XF\Repository\Option $optionRepo */
            $optionRepo = $this->repository('XF:Option');
            $newKey = \XF::generateRandomString(32);
            $optionRepo->updateOption('ncmsApiKey', $newKey);

            return $this->redirect($this->getDynamicRedirect());
        } else
        {
            return $this->view('nanocode\MineSync:MineSync\RegenApiKey', 'ncms_regen_api_key');
        }
    }
}