<?php
// FROM HASH: 670b10ac3bee54033da66a054f7e023a
return array('macros' => array('register_mc_showcase' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'uuid' => '!',
		'username' => '!',
		'token' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	$__templater->includeCss('ncms_global.less');
	$__finalCompiled .= '
	<div class="ncmsRegisterBlock">
		<div class="regmsg">
			<img src="https://minotar.net/avatar/' . $__templater->escape($__vars['username']) . '/64" height="32" width="32" />
			' . 'Hey ' . $__templater->escape($__vars['username']) . '!' . '
			<input type="hidden" name="ncms_token" value="' . $__templater->escape($__vars['token']) . '" />
		</div>
	</div>
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';

	return $__finalCompiled;
});