<?php


namespace nanocode\MineSync\Entity;


use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Structure;

class Group extends Entity
{
    protected function _postSave()
    {
        if ($this->isInsert() || $this->hasChanges())
        {
            $this->rebuildCachedGroups();
        }
    }

    protected function rebuildCachedGroups()
    {
        /** @var \nanocode\MineSync\Repository\Group $groupRepo */
        $groupRepo = $this->repository('nanocode\MineSync:Group');
        $groups = $groupRepo->getAllGroups();

        $simpleCache = \XF::app()->simpleCache();
        $simpleCache->setValue('nanocode/MineSync', 'groups', $groups);
    }

    public static function getStructure(Structure $structure)
    {
        $structure->table = "ncms_group";
        $structure->shortName = 'nanocode\MineSync:Group';
        $structure->primaryKey = 'id';

        $structure->columns = [
            'id' => ['type' => self::UINT, 'autoIncrement' => true],
            'name' => ['type' => self::STR, 'required' => true, 'maxLength' => 255],
            'xf_group_id' => ['type' => self::UINT],
            'mc_group_id' => ['type' => self::STR, 'required' => true],
            'priority' => ['type' => self::UINT, 'required' => true, 'default' => 0],
            'css_background_colour' => ['type' => self::STR],
            'css_font_colour' => ['type' => self::STR]
        ];

        $structure->relations = [
            'XFGroup' => [
                'entity' => 'XF:UserGroup',
                'type' => self::TO_ONE,
                'conditions' => 'xf_group_id',
                'primary' => true
            ]
        ];

        return $structure;
    }
}