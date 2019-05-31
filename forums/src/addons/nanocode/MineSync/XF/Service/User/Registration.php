<?php

namespace nanocode\MineSync\XF\Service\User;

class Registration extends XFCP_Registration
{
    public function setFromInput(array $input)
    {
        parent::setFromInput($input);

        if (isset($input['ncms_token']))
        {
            $this->setMinecraftToken($input['ncms_token']);
        }
    }

    public function setMinecraftToken($token)
    {
        $options = \XF::options();
        /** @var \nanocode\MineSync\Repository\Key $keyRepo */
        $keyRepo = $this->repository('nanocode\MineSync:Key');
        $key = $keyRepo->getKey($token, 2);

        if (!$key)
        {
            if ($options->ncmsRegisterOnlyThroughServer)
            {
                $this->user->error(\XF::phrase('ncms_error_you_can_only_register_through_minecraft'));
            }
            return false;
        }

        $keyRepo->setKeyForUser($key, $this->user);

        return true;
    }
}