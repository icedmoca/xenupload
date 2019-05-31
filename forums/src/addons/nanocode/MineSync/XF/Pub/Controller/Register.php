<?php

namespace nanocode\MineSync\XF\Pub\Controller;

class Register extends XFCP_Register
{
    protected function assertRegistrationActive()
    {
        parent::assertRegistrationActive();

        $options = \XF::options();
        /** @var \nanocode\MineSync\Repository\Key $keyRepo */
        $keyRepo = $this->repository('nanocode\MineSync:Key');

        if ($options->ncmsRegisterOnlyThroughServer)
        {
            $token = $this->filter('ncms_token', 'str');
            if (!$token || !$keyRepo->getKey($token, 2))
            {
                throw $this->exception(
                    $this->error(\XF::phrase('ncms_error_you_can_only_register_through_minecraft'))
                );
            }
        }
    }

    public function actionIndex()
    {
        $parent = parent::actionIndex();

        if ($parent instanceof \XF\Mvc\Reply\Redirect)
        {
            $parent->setMessage(\XF::phrase('ncms_already_registered_use_link_instead'));
            return $parent;
        }

        /** @var \nanocode\MineSync\Repository\Key $keyRepo */
        $keyRepo = $this->repository('nanocode\MineSync:Key');
        $token = $this->filter('ncms_token', 'str');
        $linkDataParams = [];

        if ($token)
        {
            $key = $keyRepo->getKey($token, 2);

            if ($key)
            {
                $linkDataParams = [
                    'uuid' => $key->uuid,
                    'username' => $key->mc_username,
                    'token' => $token
                ];
            }
        }

        $parent->setParam('mcProfile', $linkDataParams);

        return $parent;
    }

    protected function getRegistrationInput(\XF\Service\User\RegisterForm $regForm)
    {
        $input = parent::getRegistrationInput($regForm);
        $input += $this->request->filter([
            'ncms_token' => 'str',
        ]);

        return $input;
    }

    protected function finalizeRegistration(\XF\Entity\User $user)
    {
        parent::finalizeRegistration($user);

        if ($user->ncms_uuid)
        {
            $db = \XF::app()->db();
            /** @var \nanocode\MineSync\Repository\Key $keyRepo */
            $keyRepo = $this->repository('nanocode\MineSync:Key');

            $db->beginTransaction();

            $keyRepo->createNewLink($user);
            $keyRepo->manualUsergroupSync($user);

            $db->commit();
        }
    }
}