<?php
// FROM HASH: 27534135edf0e26059079244935c1a7f
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('MineSync');
	$__finalCompiled .= '

' . $__templater->callMacro('section_nav_macros', 'section_nav', array(
		'section' => 'ncms',
	), $__vars);
	return $__finalCompiled;
});