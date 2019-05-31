<?php

namespace nanocode\MineSync\Repository;

use XF\Mvc\Entity\Repository;

class PlayerUpdate extends Repository
{
    public function removeDuplicateEntries($uuid = null)
    {
        $db = $this->db();

        $uuidClause = $uuid
            ? " AND uuid = " . $db->quote($uuid, 'string')
            : "";

        $db->query("DELETE FROM `ncms_playerupdate` WHERE processed = 0" . $uuidClause . " AND id NOT IN (SELECT * FROM (SELECT MAX(n.id) FROM `ncms_playerupdate` n GROUP BY n.uuid) x)");
    }
}