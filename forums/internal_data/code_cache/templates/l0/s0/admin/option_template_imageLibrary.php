<?php
// FROM HASH: 83a7cda404eef07b9f5dd726828ec060
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= $__templater->formRadioRow(array(
		'name' => $__vars['inputName'],
		'value' => $__vars['option']['option_value'],
	), array(array(
		'value' => 'gd',
		'label' => 'PHP built-in GD image library',
		'_type' => 'option',
	),
	array(
		'value' => 'imPecl',
		'disabled' => ($__vars['noImagick'] ? 'disabled' : false),
		'label' => 'Imagemagick PECL extension',
		'hint' => 'You must have the <a href="' . 'http://pecl.php.net/package/imagick' . '" target="_blank">imagick PECL extension</a> installed.',
		'_type' => 'option',
	)), array(
		'label' => $__templater->escape($__vars['option']['title']),
		'hint' => $__templater->escape($__vars['hintHtml']),
		'explain' => $__templater->escape($__vars['explainHtml']),
		'html' => $__templater->escape($__vars['listedHtml']),
	));
	return $__finalCompiled;
});