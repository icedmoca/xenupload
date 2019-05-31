<?php

namespace nanocode\MineSync\Service;

use XF\Service\AbstractService;
use xPaw\MinecraftPing;
use xPaw\MinecraftPingException;

class ServerStatus extends AbstractService
{
    public function refreshServerStatuses()
    {
        $widgets = $this->finder('XF:Widget')
            ->with('WidgetDefinition', true)
            ->with('WidgetDefinition.AddOn')
            ->whereAddOnActive([
                'relation' => 'WidgetDefinition.AddOn',
                'column' => 'WidgetDefinition.addon_id'
            ])
            ->where('definition_id', 'ncms_server_status')
            ->fetch();
        $statusCache = [];

        foreach ($widgets AS $widget)
        {
            $options = $widget->options;
            $computedAddress = $options['address'] . ':' . $options['port'];
            $queryData = [
                'server' => $computedAddress,
                'displayAddress' => $options['port'] == '25565' ? $options['address'] : $computedAddress,
                'online' => false
            ];

            try
            {
                $query = new MinecraftPing($options['address'], $options['port']);
                $queryData = array_merge($queryData, $query->Query());
                if ($queryData)
                {
                    $queryData['online'] = true;
                }
            }
            catch (MinecraftPingException $e)
            {
                // server offline, do nothing
            } finally
            {
                if (isset($query) && $query)
                {
                    $query->Close();
                }
            }

            $statusCache[$computedAddress] = $queryData;
        }

        \XF::app()->simpleCache()->setValue('nanocode/MineSync', 'server_status', $statusCache);

        return $statusCache;
    }
}