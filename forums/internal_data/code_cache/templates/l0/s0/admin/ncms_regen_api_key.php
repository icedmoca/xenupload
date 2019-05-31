<?php
// FROM HASH: af9e3616ebcdbc81f51f5dc4b70ccafc
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Confirm action');
	$__finalCompiled .= '

' . $__templater->form('

	<div class="block-container">
		<div class="block-body">
			' . $__templater->formInfoRow('
				' . 'Please confirm you wish to regenerate your API key.<br><br>
Note that this action will mean all servers using the current API key will not work until you set the new API key into the config.' . '
			', array(
		'rowtype' => 'confirm',
	)) . '
		</div>

		' . $__templater->formSubmitRow(array(
		'icon' => 'refresh',
		'submit' => 'Regen',
	), array(
		'rowtype' => 'simple',
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('minesync/regen-api-key', ), false),
		'class' => 'block',
		'ajax' => 'true',
	));
	return $__finalCompiled;
});