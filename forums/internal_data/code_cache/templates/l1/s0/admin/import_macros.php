<?php
// FROM HASH: 32dae47b3bd247c3b48f6f2c84b98355
return array('macros' => array('step_users_config' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(), $__arguments, $__vars);
	$__finalCompiled .= '
	' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'step_config[users][merge_email]',
		'label' => 'Automatically merge users with the same email',
		'_type' => 'option',
	),
	array(
		'name' => 'step_config[users][merge_name]',
		'label' => 'Automatically merge users with the same user name',
		'hint' => 'Note that names which differ only by accents may be considered to be identical.',
		'_type' => 'option',
	)), array(
		'label' => 'Users',
	)) . '
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';

	return $__finalCompiled;
});