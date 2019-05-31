<?php


namespace nanocode\MineSync\Entity;

use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Structure;

class PlayerUpdate extends Entity
{
    public static function getStructure(Structure $structure)
    {
        $structure->table = "ncms_playerupdate";
        $structure->shortName = 'nanocode\MineSync:PlayerUpdate';
        $structure->primaryKey = 'id';

        $structure->columns = [
            'id' => ['type' => self::UINT, 'autoIncrement' => true],
            'uuid' => ['type' => self::STR, 'required' => true, 'maxLength' => 36],
            'mc_username' => ['type' => self::STR, 'required' => true, 'maxLength' => 16],
            'groups' => ['type' => self::STR, 'required' => true],
            'processed' => ['type' => self::BOOL, 'default' => false],
            'date' => ['type' => self::UINT, 'default' => 0],
        ];

        $structure->relations = [
            'User' => [
                'entity' => 'XF:User',
                'type' => self::TO_ONE,
                'conditions' => 'uuid',
                'key' => 'ncms_uuid'
            ]
        ];

        return $structure;
    }
}