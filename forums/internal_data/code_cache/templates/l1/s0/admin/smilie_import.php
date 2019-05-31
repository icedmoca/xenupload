<?php
// FROM HASH: 7d1468c1ef1c343a4d68b07d7fe19ca3
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Import smilies');
	$__finalCompiled .= '

' . $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formRadioRow(array(
		'name' => 'mode',
		'value' => 'upload',
	), array(array(
		'value' => 'upload',
		'label' => 'Import from uploaded XML file',
		'hint' => 'Use this option to import an XML file containing smilie definitions. Before proceding to the next step, you should ensure that you have manually uploaded all necessary smilie images to your server in the appropriate locations.',
		'_dependent' => array($__templater->formUpload(array(
		'name' => 'upload',
		'accept' => '.xml',
	))),
		'_type' => 'option',
	),
	array(
		'value' => 'directory',
		'label' => 'Import from a directory on your server',
		'hint' => 'Use this option to scan a web-accessible directory containing smilie images and then manually enter configuration data for each smilie to be imported. Ensure that the smilie images are uploaded before proceeding with this step.',
		'_dependent' => array($__templater->formTextBox(array(
		'name' => 'directory',
		'placeholder' => 'styles/default/xenforo/smilies...',
	))),
		'_type' => 'option',
	)), array(
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'submit' => 'Proceed' . $__vars['xf']['language']['ellipsis'],
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('smilies/import-form', ), false),
		'upload' => 'true',
		'class' => 'block',
	));
	return $__finalCompiled;
});