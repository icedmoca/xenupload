<?php
// FROM HASH: 64388af49500a387d9091447e0b9a518
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Test outbound email');
	$__finalCompiled .= '
';
	$__templater->pageParams['pageDescription'] = $__templater->preEscaped('Use this tool to diagnose outbound mail transport issues.');
	$__templater->pageParams['pageDescriptionMeta'] = true;
	$__finalCompiled .= '

';
	if ($__vars['result']) {
		$__finalCompiled .= '
	';
		if ($__vars['result']['code'] > 0) {
			$__finalCompiled .= '
		<div class="blockMessage blockMessage--success">
			' . 'The email was sent successfully with no errors.' . '
		</div>
	';
		} else {
			$__finalCompiled .= '
		<div class="blockMessage blockMessage--error">
			' . 'Errors were encountered while trying to send the email.' . '
		</div>
	';
		}
		$__finalCompiled .= '
	';
		if ($__vars['result']['log']) {
			$__finalCompiled .= '
		<div class="block">
			<div class="block-container">
				<h3 class="block-formSectionHeader">
					<span class="collapseTrigger collapseTrigger--block" data-xf-click="toggle" data-target="< :up:next">
						' . 'Expand log details' . '
					</span>
				</h3>
				<div class="block-body block-body--collapsible" tabindex="-1">
					<div class="block-row">
						<pre>' . $__templater->escape($__vars['result']['log']) . '</pre>
					</div>
				</div>
			</div>
		</div>
	';
		}
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '

' . $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formTextBoxRow(array(
		'name' => 'email',
		'value' => $__vars['email'],
		'type' => 'email',
		'dir' => 'ltr',
	), array(
		'label' => 'Email',
	)) . '

			' . $__templater->formRow('
				<code>\\' . $__templater->escape($__vars['transportClass']) . '</code>
			', array(
		'label' => 'Email transport class',
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'submit' => 'Run test',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('tools/test-email', ), false),
		'class' => 'block',
	));
	return $__finalCompiled;
});