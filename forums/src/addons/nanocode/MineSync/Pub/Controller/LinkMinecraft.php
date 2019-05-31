<?php

namespace nanocode\MineSync\Pub\Controller;

use XF\Pub\Controller\AbstractController;

class LinkMinecraft extends AbstractController
{
    public function actionIndex()
    {
        /** @var \nanocode\MineSync\Repository\Key $keyRepo */
        $keyRepo = $this->repository('nanocode\MineSync:Key');
        $options = \XF::options();
        $visitor = \XF::visitor();
        $db = \XF::app()->db();

        $token = $this->filter('token', 'str');
        $type = $this->filter('type', 'str');

        if ($type == 'register')
        {
            return $this->redirect($this->buildLink('register', null, ['ncms_token' => $token]));
        }

        $this->assertRegistrationRequired();

        if (!$type OR $type != 'link')
        {
            return $this->error(\XF::phrase('ncms_type_not_recognised'));
        }

        if (!$options->ncmsEnableLinking)
        {
            return $this->error(\XF::phrase('ncms_linking_disabled'));
        }

        if (!$visitor->hasPermission('ncms', 'canLinkAccount'))
        {
            return $this->noPermission();
        }

        if (empty($token) OR !($key = $keyRepo->getKey($token)))
        {
            return $this->error(\XF::phrase('ncms_invalid_key'));
        }

        if ($visitor->ncms_uuid)
        {
            return $this->error(\XF::phrase('ncms_already_linked'));
        }

        $db->beginTransaction();
        $keyRepo->createNewLink($visitor, $key);
        $keyRepo->setKeyForUser($key, $visitor);
        $visitor->save();
        $keyRepo->manualUsergroupSync($visitor);
        $db->commit();

        return $this->view('nanocode\MineSync:LinkMinecraft', 'ncms_linkminecraft');
    }
}