<?php

namespace nanocode\MineSync\XF\Entity;

use XF\Mvc\Entity\Structure;

class User extends XFCP_User
{
    public function ncmsSetDisplayGroup($groupId)
    {
        if (in_array($groupId, $this->ncms_groups)) {
            $this->ncms_group = $groupId;
            $this->ncms_group_change_date = \XF::$time;
        }
    }

    public function ncmsUnlinkMinesyncProfile()
    {
        $this->ncms_uuid = "";
        $this->ncms_username = "";
        $this->ncms_group = 0;
        $this->ncms_groups = [];
        $this->ncms_group_change_date = 0;
    }

    public function hasMinecraftAvatar()
    {
        $options = \XF::options();
        if (($this->ncms_uuid && $options->ncmsEnableAvatarSync && !$this->avatar_date) ||
            ($this->ncms_uuid && $options->ncmsEnableAvatarSync && $options->ncmsForceAvatarSync)) {
            return true;
        } else {
            return false;
        }
    }

    public function getAvatarType()
    {
        if($this->hasMinecraftAvatar())
        {
            return 'custom';
        } else {
            return parent::getAvatarType();
        }
    }

    public function getAvatarUrl($sizeCode, $forceType = null, $canonical = false)
    {
        if ($this->hasMinecraftAvatar()) {
            return $this->getMinecraftAvatarUrl($sizeCode, $forceType, $canonical);
        } else {
            return parent::getAvatarUrl($sizeCode, $forceType, $canonical);
        }
    }

    public function getAvatarUrl2x($sizeCode, $forceType = null, $canonical = false)
    {
        if($this->hasMinecraftAvatar())
        {
            return $this->getMinecraftAvatarUrl($sizeCode, $forceType, $canonical, true);
        } else {
            return parent::getAvatarUrl2x($sizeCode, $forceType, $canonical);
        }
    }

    public function getMinecraftAvatarUrl($size, $forceType = null, $canonical = false, $twoTimes = false)
    {
        $options = \XF::options();
        $sizeMap = $this->app()->container('avatarSizeMap');
        $numericSize = $size;

        if (!is_numeric($size)) {
            switch ($size) {
                case 'xxs':
                    $numericSize = $sizeMap['s'];
                    break;
                case 'xs':
                case 's':
                    $numericSize = $sizeMap['m'];
                    break;
                case 'm':
                    $numericSize = $sizeMap['l'];
                    break;
                case 'l':
                    $numericSize = $sizeMap['h'];
                    break;
            }
        }

        if (!$this->ncms_username || !$this->ncms_uuid) {
            return ($twoTimes ? parent::getAvatarUrl2x($size, $forceType, $canonical) : parent::getAvatarUrl(
                $size,
                $forceType,
                $canonical
            ));
        }

        if ($options->ncmsAvatarSource) {
            $codes = [
                '{username}',
                '{uuid}',
                '{size}',
            ];
            $replacements = [
                $this->ncms_username,
                $this->ncms_uuid,
                $numericSize,
            ];

            return str_replace($codes, $replacements, $options->ncmsAvatarSource);
        } else {
            // Crafatar default:
            return "https://crafatar.com/avatars/{$this->ncms_uuid}?size=$numericSize";
        }
    }

    public static function getStructure(Structure $structure)
    {
        $structure = parent::getStructure($structure);

        $structure->columns['ncms_uuid'] = ['type' => self::STR, 'default' => '', 'maxLength' => 36];
        $structure->columns['ncms_username'] = ['type' => self::STR, 'default' => '', 'maxLength' => 16];
        $structure->columns['ncms_group'] = ['type' => self::UINT, 'default' => 0];
        $structure->columns['ncms_groups'] = [
            'type' => self::LIST_COMMA,
            'default' => [],
            'list' => ['type' => 'posint', 'unique' => true, 'sort' => SORT_NUMERIC],
        ];
        $structure->columns['ncms_group_change_date'] = ['type' => self::UINT, 'default' => 0];

        return $structure;
    }
}