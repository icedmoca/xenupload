<?php
// FROM HASH: b931f0662e25e521846b40a8cbbc0b10
return array('macros' => array('mc_showcase' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'location' => '!',
		'user' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	
	';
	$__templater->includeCss('ncms_global.less');
	$__finalCompiled .= '
	';
	if ($__vars['user']['ncms_uuid'] AND $__vars['xf']['options']['ncmsEnablePlayerShowcase']) {
		$__finalCompiled .= '
		<div class="mcShowcaseBlock ' . (($__vars['location'] == 'message') ? 'mcPlayerMessage' : 'mcPlayerProfile') . '">
    	<div class="playerAvatar">' . $__templater->filter($__templater->fn('ncms_minecraft_avatar', array($__vars['user'], '64', ), false), array(array('preescaped', array()),), true) . '</div>
    	<div class="playerData ' . ($__vars['user']['ncms_group'] ? 'withGroup' : '') . '">
        	<div class="playerUsername">' . $__templater->escape($__vars['user']['ncms_username']) . '</div>
        	';
		if ($__vars['user']['ncms_group']) {
			$__finalCompiled .= '
        		<div class="playerRank">
            		<span class="ncms-group-badge ncms-group-badge-' . $__templater->escape($__vars['user']['ncms_group']) . '" style="background-color: ' . $__templater->escape($__templater->arrayKey($__templater->arrayKey($__templater->arrayKey($__templater->method($__vars['xf']['simpleCache'], 'getSet', array('nanocode/MineSync', )), 'groups'), $__vars['user']['ncms_group']), 'css_background_colour')) . ' !important; color: ' . $__templater->escape($__templater->arrayKey($__templater->arrayKey($__templater->arrayKey($__templater->method($__vars['xf']['simpleCache'], 'getSet', array('nanocode/MineSync', )), 'groups'), $__vars['user']['ncms_group']), 'css_font_colour')) . ' !important;">' . $__templater->escape($__templater->arrayKey($__templater->arrayKey($__templater->arrayKey($__templater->method($__vars['xf']['simpleCache'], 'getSet', array('nanocode/MineSync', )), 'groups'), $__vars['user']['ncms_group']), 'name')) . '</span>
        		</div>
			';
		}
		$__finalCompiled .= '
    		</div>
			<div style="clear: both;"></div>
		</div>
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';

	return $__finalCompiled;
});