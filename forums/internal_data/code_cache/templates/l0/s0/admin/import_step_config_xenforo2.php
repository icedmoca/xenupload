<?php
// FROM HASH: 2f7828919be88ba365680a648fbf029c
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__templater->fn('in_array', array('users', $__vars['steps'], ), false)) {
		$__finalCompiled .= '
	' . $__templater->callMacro('import_macros', 'step_users_config', array(), $__vars) . '
';
	}
	return $__finalCompiled;
});