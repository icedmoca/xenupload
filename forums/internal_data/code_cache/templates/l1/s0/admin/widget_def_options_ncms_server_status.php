<?php
// FROM HASH: 2a6302be49bc4f9d23941c3fb1ae5104
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '<hr class="formRowSep" />

' . $__templater->formTextBoxRow(array(
		'name' => 'options[name]',
		'value' => $__vars['options']['name'],
	), array(
		'label' => 'Server name',
		'explain' => 'The name of your server that you wish to display on the widget.',
	)) . '

' . $__templater->formTextBoxRow(array(
		'name' => 'options[address]',
		'value' => $__vars['options']['address'],
	), array(
		'label' => 'Server address',
		'explain' => 'Your server\'s numeric or alias address (e.g. 127.0.0.1, or play.nanocode.io). Do not include the port. This address will be shown to players, and also used for status checks.',
	)) . '

' . $__templater->formNumberBoxRow(array(
		'name' => 'options[port]',
		'value' => $__vars['options']['port'],
		'min' => '1',
		'max' => '65535',
	), array(
		'label' => 'Server port',
		'explain' => 'Your server\'s port. This is used for pinging your server. If this is non-default it will be displayed along with the server address. If it is 25565, it will not be displayed.',
	));
	return $__finalCompiled;
});