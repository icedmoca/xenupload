<?php
// FROM HASH: 94995f449793256b713181159f5de70f
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= $__templater->formRow('
	
	<span style="margin-right: 10px;">' . $__templater->escape($__vars['option']['option_value']) . '</span>
	
	' . $__templater->button('Regen', array(
		'href' => $__templater->fn('link', array('minesync/regen-api-key', ), false),
		'icon' => 'refresh',
		'overlay' => 'true',
	), '', array(
	)) . '
	<input type="hidden" name="options[ncmsApiKey]" value="' . $__templater->escape($__vars['option']['option_value']) . '" />
', array(
		'label' => $__templater->escape($__vars['option']['title']),
		'hint' => $__templater->escape($__vars['hintHtml']),
		'explain' => $__templater->escape($__vars['explainHtml']),
		'html' => $__templater->escape($__vars['listedHtml']),
	));
	return $__finalCompiled;
});