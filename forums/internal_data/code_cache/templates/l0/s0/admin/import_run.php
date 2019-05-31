<?php
// FROM HASH: f6fd5e25c478556477ade681f3166069
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Importing' . $__vars['xf']['language']['ellipsis']);
	$__finalCompiled .= '
';
	$__templater->setPageParam('template', 'PAGE_RUN_JOB');
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if ($__vars['stepTitle']) {
		$__compilerTemp1 .= '
		';
		if ($__vars['stepComplete']) {
			$__compilerTemp1 .= '
			' . 'Step ' . $__templater->escape($__vars['importCompletion']['current']) . ' of ' . $__templater->escape($__vars['importCompletion']['total']) . '' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['stepTitle']) . ' - 100%
		';
		} else {
			$__compilerTemp1 .= '
			' . 'Step ' . $__templater->escape($__vars['importCompletion']['current']) . ' of ' . $__templater->escape($__vars['importCompletion']['total']) . '' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['stepTitle']) . ' - ' . $__templater->escape($__vars['stepCompletion']) . '
		';
		}
		$__compilerTemp1 .= '
	';
	} else if ($__vars['importCompletion']['current']) {
		$__compilerTemp1 .= '
		' . 'Step ' . $__templater->escape($__vars['importCompletion']['current']) . ' of ' . $__templater->escape($__vars['importCompletion']['total']) . '' . $__vars['xf']['language']['label_separator'] . ' ' . 'Processing' . $__vars['xf']['language']['ellipsis'] . '
	';
	} else {
		$__compilerTemp1 .= '
		' . 'Processing' . $__vars['xf']['language']['ellipsis'] . '
	';
	}
	$__finalCompiled .= $__templater->form('

	' . $__compilerTemp1 . '

	<div class="u-noJsOnly">
		' . $__templater->button('Proceed' . $__vars['xf']['language']['ellipsis'], array(
		'type' => 'submit',
		'accesskey' => 's',
	), '', array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('import/run', ), false),
		'method' => 'post',
		'class' => 'blockMessage',
		'data-xf-init' => 'auto-submit',
	));
	return $__finalCompiled;
});