<?php
// FROM HASH: 5da74bbdb300e056227aac6a46304e22
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->includeCss('ncms_global.less');
	$__finalCompiled .= '
';
	$__templater->inlineJs('
    new Clipboard(".NcmsCopyable", {
        text: function(trigger) {
            return trigger.dataset.address;
        }
    });
');
	$__finalCompiled .= '

<div class="block ncms-mc-status" ' . $__templater->fn('widget_data', array($__vars['widget'], ), true) . '>
    <div class="block-container">
        <h3 class="block-minorHeader">
            ' . $__templater->escape($__vars['title']) . '
            <span class="status-indicator ' . ($__vars['server']['online'] ? ' online' : 'offline') . '" style="">■</span>
        </h3>
        <div class="block-body block-row">
            <div class="ncms-server-status">
                <a href="javascript:void(0);" class="NcmsCopyable" title="Click to copy IP" data-address="' . $__templater->escape($__vars['server']['displayAddress']) . '">' . $__templater->escape($__vars['server']['displayAddress']) . '</a><br>
                ';
	if ($__vars['server']['online']) {
		$__finalCompiled .= '<span>' . $__templater->escape($__vars['server']['players']['online']) . '/' . $__templater->escape($__vars['server']['players']['max']) . '</span>';
	}
	$__finalCompiled .= '
            </div>
        </div>
    </div>
</div>';
	return $__finalCompiled;
});