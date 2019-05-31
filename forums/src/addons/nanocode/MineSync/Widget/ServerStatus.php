<?php

namespace nanocode\MineSync\Widget;

use XF\Widget\AbstractWidget;

class ServerStatus extends AbstractWidget
{
    public function render()
    {
        $cache = $this->app()->simpleCache()->getValue('nanocode/MineSync', 'server_status');
        if (!$cache || \XF::options()->ncmsDisableServerStatusCache)
        {
            $cache = $this->service('nanocode\MineSync:ServerStatus')->refreshServerStatuses();
        }

        $viewParams = [
            'server' => $cache[$this->options['address'] . ':' . $this->options['port']]
        ];

        return $this->renderer('ncms_widget_server_status', $viewParams);
    }

    public function verifyOptions(\XF\Http\Request $request, array &$options, &$error = null)
    {
        $options = $request->filter([
            'name' => 'str',
            'address' => 'str',
            'port' => 'uint'
        ]);

        return true;
    }
}