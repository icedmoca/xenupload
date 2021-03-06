<?php
// FROM HASH: c028e1292cb73bac7f40fbba186f2cca
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->includeJs(array(
		'src' => 'xf/login_signup.js',
		'min' => '1',
	));
	$__finalCompiled .= '
';
	$__templater->setPageParam('uix_hideExtendedFooter', '1');
	$__finalCompiled .= '
';
	$__templater->setPageParam('uix_hideNotices', '1');
	$__finalCompiled .= '
';
	$__templater->setPageParam('uix_hideBreadcrumb', '1');
	$__finalCompiled .= '
' . '

';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Register');
	$__finalCompiled .= '

';
	if (!$__templater->test($__vars['providers'], 'empty', array())) {
		$__finalCompiled .= '
	<div class="block">
		<div class="block-container">
			<div class="block-body">
				';
		$__compilerTemp1 = '';
		if ($__templater->isTraversable($__vars['providers'])) {
			foreach ($__vars['providers'] AS $__vars['provider']) {
				$__compilerTemp1 .= '
							<li>
								' . $__templater->button('
									' . $__templater->escape($__vars['provider']['title']) . '
								', array(
					'href' => $__templater->fn('link', array('register/connected-accounts', $__vars['provider'], array('setup' => true, ), ), false),
					'class' => 'button--provider button--provider--' . $__vars['provider']['provider_id'],
				), '', array(
				)) . '
							</li>
						';
			}
		}
		$__finalCompiled .= $__templater->formRow('

					<ul class="listHeap">
						' . $__compilerTemp1 . '
					</ul>
				', array(
			'rowtype' => 'button',
			'label' => 'Register faster using',
		)) . '
			</div>
		</div>
	</div>
';
	}
	$__finalCompiled .= '

';
	$__compilerTemp2 = '';
	if ($__vars['mcProfile']) {
		$__compilerTemp2 .= '
	' . $__templater->callMacro('ncms_register_macros', 'register_mc_showcase', array(
			'uuid' => $__vars['mcProfile']['uuid'],
			'username' => $__vars['mcProfile']['username'],
			'token' => $__vars['mcProfile']['token'],
		), $__vars) . '
';
	}
	$__compilerTemp3 = '';
	if (($__templater->fn('rand', array(0, 2, ), false) == 1)) {
		$__compilerTemp3 .= '
				' . $__templater->formTextBoxRow(array(
			'name' => $__templater->method($__vars['regForm'], 'getFieldName', array('email_hp', )),
			'value' => '',
			'type' => 'email',
			'autocomplete' => 'off',
			'maxlength' => $__templater->fn('max_length', array($__vars['xf']['visitor'], 'email', ), false),
		), array(
			'rowclass' => 'formRow--limited',
			'label' => 'Email',
			'explain' => 'Please leave this field blank.',
		)) . '
			';
	}
	$__compilerTemp4 = '';
	if (($__templater->fn('rand', array(0, 2, ), false) == 1)) {
		$__compilerTemp4 .= '
				' . $__templater->formTextBoxRow(array(
			'name' => 'email',
			'value' => '',
			'type' => 'email',
			'autocomplete' => 'off',
			'maxlength' => $__templater->fn('max_length', array($__vars['xf']['visitor'], 'email', ), false),
		), array(
			'rowclass' => 'formRow--limited',
			'label' => 'Email',
			'explain' => 'Please leave this field blank.',
		)) . '
			';
	}
	$__compilerTemp5 = '';
	if (($__templater->fn('rand', array(0, 2, ), false) == 1)) {
		$__compilerTemp5 .= '
				' . $__templater->formTextBoxRow(array(
			'name' => 'password',
			'type' => 'password',
			'autocomplete' => 'off',
		), array(
			'rowclass' => 'formRow--limited',
			'label' => 'Password',
			'explain' => 'Please leave this field blank.',
		)) . '
			';
	}
	$__finalCompiled .= $__templater->form('

	<div class="block-container">
		<div class="block-body">
			' . '
			' . $__templater->formTextBoxRow(array(
		'name' => 'username',
		'value' => '',
		'autocomplete' => 'off',
		'maxlength' => $__templater->fn('max_length', array($__vars['xf']['visitor'], 'username', ), false),
	), array(
		'rowclass' => 'formRow--limited',
		'label' => 'User name',
		'explain' => 'Please leave this field blank.',
	)) . '

			' . $__compilerTemp2 . '

' . $__templater->callMacro('register_macros', 'username_row', array(
		'fieldName' => $__templater->method($__vars['regForm'], 'getFieldName', array('username', )),
		'value' => $__vars['fields']['username'],
	), $__vars) . '

			' . '
			' . $__compilerTemp3 . '

			' . $__templater->callMacro('register_macros', 'email_row', array(
		'fieldName' => $__templater->method($__vars['regForm'], 'getFieldName', array('email', )),
		'value' => $__vars['fields']['email'],
	), $__vars) . '

			' . '
			' . $__compilerTemp4 . '

			' . '
			' . $__compilerTemp5 . '

			' . $__templater->formTextBoxRow(array(
		'name' => $__templater->method($__vars['regForm'], 'getFieldName', array('password', )),
		'type' => 'password',
		'autocomplete' => 'off',
	), array(
		'label' => 'Password',
	)) . '

			' . $__templater->callMacro('register_macros', 'dob_row', array(), $__vars) . '

			' . $__templater->callMacro('register_macros', 'location_row', array(
		'value' => $__vars['fields']['location'],
	), $__vars) . '

			' . $__templater->callMacro('register_macros', 'custom_fields', array(), $__vars) . '

			' . $__templater->formRowIfContent($__templater->fn('captcha', array(false)), array(
		'label' => 'Verification',
	)) . '

			' . $__templater->callMacro('register_macros', 'tos_row', array(), $__vars) . '
		</div>
		' . $__templater->callMacro('register_macros', 'submit_row', array(), $__vars) . '
	</div>

	' . $__templater->formHiddenVal('reg_key', $__templater->method($__vars['regForm'], 'getUniqueKey', array()), array(
	)) . '
	' . $__templater->formHiddenVal($__templater->method($__vars['regForm'], 'getFieldName', array('timezone', )), '', array(
		'data-xf-init' => 'auto-timezone',
	)) . '
', array(
		'action' => $__templater->fn('link', array('register/register', ), false),
		'ajax' => 'true',
		'class' => 'block',
		'data-xf-init' => 'reg-form',
		'data-timer' => $__vars['xf']['options']['registrationTimer'],
	));
	return $__finalCompiled;
});