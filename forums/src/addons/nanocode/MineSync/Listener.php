<?php

namespace nanocode\MineSync;

class Listener
{
    public static function autoloadComposer(\XF\App $app)
    {
        Autoload::autoloadComposerPackages('nanocode/MineSync');
    }

    public static function templaterSetup(\XF\Container $container, \XF\Template\Templater &$templater)
    {
        $templater->addFunction('ncms_minecraft_avatar', ['nanocode\MineSync\Listener', 'fnMinecraftAvatar']);
    }

    public static function criteriaUser($rule, array $data, \XF\Entity\User $user, &$returnValue)
    {
        switch ($rule)
        {
            case 'ncms_minecraft_account_linked':
                if ($user->ncms_uuid)
                {
                    $returnValue = true;
                }
                break;
            case 'ncms_minecraft_account_not_linked':
                if (!$user->ncms_uuid)
                {
                    $returnValue = true;
                }
                break;
        }
    }

    public static function fnMinecraftAvatar(\XF\Template\Templater $templater, &$escape, $user, $size = 's')
    {
        if (!is_numeric($size))
        {
            $sizeMap = \XF::app()->container('avatarSizeMap');
            $size = $sizeMap[$size];
        }

        $avatarUrl = $user->getMinecraftAvatarUrl($size);

        return "<img src=\"$avatarUrl\" height=\"$size\" width=\"$size\" alt=\"$user->ncms_username\" />";
    }
}