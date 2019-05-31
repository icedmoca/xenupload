<?php

namespace nanocode\MineSync\Repository;

use XF\Mvc\Entity\Repository;

class Group extends Repository
{
    public function getAllGroups()
    {
        return $this->db()->fetchAllKeyed('
            SELECT *
            FROM ncms_group
            ORDER BY priority DESC
        ', 'id');
    }

    public function findGroupsForList()
    {
        return $this->finder('nanocode\MineSync:Group')->order('priority', 'desc');
    }

    public function getGroupTitlePairs()
    {
        return $this->findGroupsForList()->fetch()->pluckNamed('name', 'id');
    }

}