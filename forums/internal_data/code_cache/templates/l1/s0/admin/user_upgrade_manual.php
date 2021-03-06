<?php
// FROM HASH: 428679f6aa7a8a5066454a7078c030bd
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Manually upgrade user');
	$__finalCompiled .= '

' . $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formTextBoxRow(array(
		'name' => 'username',
		'ac' => 'single',
	), array(
		'label' => 'User name',
	)) . '

			' . $__templater->formRow($__templater->escape($__vars['upgrade']['title']), array(
		'label' => 'Upgrade to apply',
	)) . '

			' . '

			' . $__templater->formRadioRow(array(
		'name' => 'end_type',
	), array(array(
		'value' => 'permanent',
		'selected' => !$__vars['activeUpgrade']['end_date'],
		'label' => 'Permanent',
		'_type' => 'option',
	),
	array(
		'value' => 'date',
		'selected' => $__vars['activeUpgrade']['end_date'],
		'label' => 'Date' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formDateInput(array(
		'name' => 'end_date',
		'value' => ($__vars['activeUpgrade']['end_date'] ? $__templater->fn('date', array($__vars['activeUpgrade']['end_date'], 'picker', ), false) : $__templater->fn('date', array($__vars['xf']['time'], 'picker', ), false)),
	))),
		'_type' => 'option',
	)), array(
		'label' => 'Upgrade ends',
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'submit' => 'Upgrade',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('user-upgrades/manual', $__vars['upgrade'], ), false),
		'ajax' => 'true',
		'class' => 'block',
	));
	return $__finalCompiled;
});