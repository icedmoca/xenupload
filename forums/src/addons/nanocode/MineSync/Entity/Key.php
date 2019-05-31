<?php


namespace nanocode\MineSync\Entity;

use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Structure;

class Key extends Entity
{
    public static function getStructure(Structure $structure)
    {
        $structure->table = "ncms_key";
        $structure->shortName = 'nanocode\MineSync:Key';
        $structure->primaryKey = 'token';

        $structure->columns = [
            'token' => ['type' => self::STR, 'required' => true, 'maxLength' => 36],
            'uuid' => ['type' => self::STR, 'required' => true, 'maxLength' => 36],
            'mc_username' => ['type' => self::STR, 'required' => true, 'maxLength' => 16],
            'valid' => ['type' => self::BOOL, 'default' => true],
            'used' => ['type' => self::BOOL, 'default' => false],
            'user_id' => ['type' => self::UINT, 'default' => 0],
            'create_date' => ['type' => self::UINT, 'default' => 0],
            'key_type' => ['type' => self::UINT, 'default' => 1] // enum
        ];

        $structure->relations = [
            'User' => [
                'entity' => 'XF:User',
                'type' => self::TO_ONE,
                'conditions' => 'user_id',
                'primary' => true
            ]
        ];

        return $structure;
    }
}