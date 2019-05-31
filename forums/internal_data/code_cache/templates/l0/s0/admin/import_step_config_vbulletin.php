<?php
// FROM HASH: c048779ddc599a7c91684ce94407467f
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__templater->fn('in_array', array('users', $__vars['steps'], ), false)) {
		$__finalCompiled .= '
	<h3 class="block-formSectionHeader">' . 'Users' . '</h3>
	' . $__templater->callMacro('import_macros', 'step_users_config', array(), $__vars) . '
	<!--<hr class="formRowSep" />-->
	' . $__templater->formTextBoxRow(array(
			'name' => 'step_config[users][super_admins]',
			'value' => $__vars['baseConfig']['super_admins'],
			'placeholder' => '$config[\'SpecialUsers\'][\'superadministrators\']',
		), array(
			'label' => 'Super administrator user IDs',
			'explain' => 'If you have <b>super administrators</b> defined in your vBulletin <code>config.php</code> file, enter the value from the file here. It will take the form of a single user ID, or a list of IDs separated by commas.',
		)) . '
';
	}
	$__finalCompiled .= '

';
	if ($__templater->fn('in_array', array('avatars', $__vars['steps'], ), false) AND $__vars['baseConfig']['avatarpath']) {
		$__finalCompiled .= '
	<h3 class="block-formSectionHeader">' . 'Avatars' . '</h3>
	' . $__templater->formTextBoxRow(array(
			'name' => 'step_config[avatars][path]',
			'value' => $__vars['baseConfig']['avatarpath'],
		), array(
			'label' => 'Avatar path',
			'explain' => 'Enter the full path to the folder containing your vBulletin avatars. If this can not be found or read, you will need to go back and reconfigure the importer to skip avatars.',
		)) . '
';
	}
	$__finalCompiled .= '

';
	if ($__templater->fn('in_array', array('attachments', $__vars['steps'], ), false) AND $__vars['baseConfig']['attachpath']) {
		$__finalCompiled .= '
	<h3 class="block-formSectionHeader">' . 'Attachments' . '</h3>
	' . $__templater->formTextBoxRow(array(
			'name' => 'step_config[attachments][path]',
			'value' => $__vars['baseConfig']['attachpath'],
		), array(
			'label' => 'Attachment path',
			'explain' => 'Enter the full path to the folder containing your vBulletin attachments. If this can not be found or read, you will need to go back and reconfigure the importer to skip attachments.',
		)) . '
';
	}
	return $__finalCompiled;
});