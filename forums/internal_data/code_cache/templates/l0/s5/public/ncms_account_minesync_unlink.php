<?php
// FROM HASH: 8ec3e9677e153d2ac7a3a676db8756fd
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Confirm unlink');
	$__finalCompiled .= '

' . $__templater->form('

	<div class="block-container">
		<div class="block-body">
			' . $__templater->formInfoRow('
				' . 'Are you sure you wish to unlink your XenForo and Minecraft accounts?' . '
			', array(
		'rowtype' => 'confirm',
	)) . '
		</div>

		' . $__templater->formSubmitRow(array(
		'submit' => 'Confirm',
	), array(
		'rowtype' => 'simple',
	)) . '
	</div>

', array(
		'action' => $__templater->fn('link', array('account/minesync-unlink', ), false),
		'class' => 'block',
		'ajax' => 'true',
	));
	return $__finalCompiled;
});