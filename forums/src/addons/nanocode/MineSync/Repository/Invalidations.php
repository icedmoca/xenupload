<?php

namespace nanocode\MineSync\Repository;

use XF\Mvc\Entity\Repository;

class Invalidations extends Repository
{
    public function invalidateNewLinks()
    {
        $options = \XF::options();

        $this->db()->delete('ncms_newlink', 'link_date <= ?', time() - ($options->ncmsNewLinkInvalidationTime * 60));
    }

    public function invalidateOldTokens()
    {
        $options = \XF::options();

        $this->db()->update('ncms_key', [
            'valid' => 0
        ], 'create_date <= ?', time() - ($options->ncmsKeyInvalidationTime * 60));
    }
}