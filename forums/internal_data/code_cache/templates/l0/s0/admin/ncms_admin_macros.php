<?php
// FROM HASH: aa9298b045dc42eaad1fc8d9f27d85ad
return array('macros' => array('edit_user' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'user' => '!',
		'groups' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	
	<h3 class="block-formSectionHeader">
		<span class="collapseTrigger collapseTrigger--block" data-xf-click="toggle" data-target="< :up:next">
			<span class="block-formSectionHeader-aligner">' . 'MineSync' . '</span>
		</span>
	</h3>
	<div class="block-body block-body--collapsible">
		' . $__templater->formTextBoxRow(array(
		'name' => 'user[ncms_uuid]',
		'value' => $__vars['user']['ncms_uuid'],
		'maxlength' => $__templater->fn('max_length', array($__vars['user'], 'ncms_uuid', ), false),
	), array(
		'label' => 'UUID',
	)) . '
		
		' . $__templater->formTextBoxRow(array(
		'name' => 'user[ncms_username]',
		'value' => $__vars['user']['ncms_username'],
		'maxlength' => $__templater->fn('max_length', array($__vars['user'], 'ncms_username', ), false),
	), array(
		'label' => 'Username',
	)) . '
		
		';
	$__compilerTemp1 = $__templater->mergeChoiceOptions(array(), $__vars['groups']);
	$__finalCompiled .= $__templater->formSelectRow(array(
		'name' => 'user[ncms_group]',
		'value' => $__vars['user']['ncms_group'],
	), $__compilerTemp1, array(
		'label' => 'Display group',
	)) . '
		
		';
	$__compilerTemp2 = $__templater->mergeChoiceOptions(array(), $__vars['groups']);
	$__finalCompiled .= $__templater->formCheckBoxRow(array(
		'name' => 'user[ncms_groups]',
		'value' => $__vars['user']['ncms_groups'],
		'listclass' => 'listColumns',
	), $__compilerTemp2, array(
		'label' => 'Available groups',
	)) . '
	</div>
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';

	return $__finalCompiled;
});