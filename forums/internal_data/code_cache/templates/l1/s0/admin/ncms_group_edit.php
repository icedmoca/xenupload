<?php
// FROM HASH: feffc33a53779b44a2c037aab0da8f30
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__templater->method($__vars['group'], 'isInsert', array())) {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Add group');
		$__finalCompiled .= '
';
	} else {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Edit group' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['group']['name']));
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '

';
	if ($__templater->method($__vars['group'], 'isUpdate', array())) {
		$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('', array(
			'href' => $__templater->fn('link', array('minesync/groups/delete', $__vars['group'], ), false),
			'icon' => 'delete',
			'overlay' => 'true',
		), '', array(
		)) . '
');
	}
	$__finalCompiled .= '

';
	$__compilerTemp1 = $__templater->mergeChoiceOptions(array(), $__vars['userGroups']);
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formTextBoxRow(array(
		'name' => 'name',
		'value' => $__vars['group']['name'],
		'maxlength' => $__templater->fn('max_length', array($__vars['group'], 'name', ), false),
	), array(
		'label' => 'Group name',
	)) . '
			
			' . $__templater->formSelectRow(array(
		'name' => 'xf_group_id',
		'value' => $__vars['group']['xf_group_id'],
	), $__compilerTemp1, array(
		'label' => 'XF group ID',
		'explain' => 'This is the XF group that will be automatically added for users that are in this group on the server.',
	)) . '
			
			' . $__templater->formTextBoxRow(array(
		'name' => 'mc_group_id',
		'value' => $__vars['group']['mc_group_id'],
		'maxlength' => $__templater->fn('max_length', array($__vars['group'], 'mc_group_id', ), false),
	), array(
		'label' => 'Minecraft group name',
		'explain' => 'This should be the identifier for the group on your server. It should be, case-sensitive, the rank as shown in-game in your permissions plugin. For example, for "owner" in-game you would enter in owner.',
	)) . '

			' . $__templater->formNumberBoxRow(array(
		'name' => 'priority',
		'value' => $__vars['group']['priority'],
		'min' => '0',
	), array(
		'label' => 'Priority',
		'explain' => 'The higher the value, the greater the priority.<br/><br/>

The highest available priority group will be automatically set to the display group on sync, when a group has not been manually selected for displayed.',
	)) . '
			
			' . $__templater->callMacro('public:color_picker_macros', 'color_picker', array(
		'name' => 'css_background_colour',
		'value' => $__vars['group']['css_background_colour'],
		'allowPalette' => 'false',
		'label' => 'Tag background colour',
	), $__vars) . '
			
			' . $__templater->callMacro('public:color_picker_macros', 'color_picker', array(
		'name' => 'css_font_colour',
		'value' => $__vars['group']['css_font_colour'],
		'allowPalette' => 'false',
		'label' => 'Tag font colour',
	), $__vars) . '
		</div>

		' . $__templater->formSubmitRow(array(
		'icon' => 'save',
		'sticky' => 'true',
	), array(
	)) . '
	</div>

', array(
		'action' => $__templater->fn('link', array('minesync/groups/save', $__vars['group'], ), false),
		'ajax' => 'true',
		'class' => 'block',
	));
	return $__finalCompiled;
});