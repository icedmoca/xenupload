<?php
// FROM HASH: 4db3a760e401ace69b1bb0157b84372c
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('MineSync settings');
	$__finalCompiled .= '

';
	$__templater->includeCss('ncms_global.less');
	$__finalCompiled .= '
';
	$__templater->wrapTemplate('account_wrapper', $__vars);
	$__finalCompiled .= '

';
	if (!$__templater->method($__vars['xf']['visitor'], 'canEditProfile', array())) {
		$__finalCompiled .= '
	<div class="blockMessage blockMessage--important">' . 'Your full account details are not currently editable.' . '</div>
';
	}
	$__finalCompiled .= '

';
	if (!$__vars['xf']['visitor']['ncms_uuid']) {
		$__finalCompiled .= '
	<div class="blockMessage blockMessage--error">' . '<p>Your Minecraft account is not currently linked to the forums!</p>
<p>Type /link in-game to begin the linking process.</p>' . '</div>
';
	} else {
		$__finalCompiled .= '
	';
		$__compilerTemp1 = '';
		if ($__vars['xf']['visitor']['ncms_groups']) {
			$__compilerTemp1 .= '
				' . $__templater->formRow('
					' . $__templater->escape($__vars['groups'][$__vars['xf']['visitor']['ncms_group']]['name']) . '
				', array(
				'label' => 'Current display group',
			)) . '
				
				';
			if ($__vars['xf']['options']['ncmsAllowDisplayGroupChanging']) {
				$__compilerTemp1 .= '
					';
				$__compilerTemp2 = array();
				if ($__templater->isTraversable($__vars['groups'])) {
					foreach ($__vars['groups'] AS $__vars['group']) {
						$__compilerTemp2[] = array(
							'value' => $__vars['group']['id'],
							'checked' => ($__vars['xf']['visitor']['ncms_group'] == $__vars['group']['id']),
							'label' => '
								<div class="ncmsInlineBlockGroup">
									<span class="ncms-group-badge group-badge-' . $__templater->escape($__vars['group']['id']) . '" style="background-color: ' . $__templater->escape($__vars['group']['css_background_colour']) . ' !important; color: ' . $__templater->escape($__vars['group']['css_font_colour']) . ' !important;">' . $__templater->escape($__vars['group']['name']) . '</span>
								</div>
							',
							'_type' => 'option',
						);
					}
				}
				$__compilerTemp1 .= $__templater->formRadioRow(array(
					'name' => 'group_id',
				), $__compilerTemp2, array(
					'label' => 'Select a new display group',
				)) . '
				';
			}
			$__compilerTemp1 .= '
			';
		}
		$__compilerTemp3 = '';
		if ($__templater->method($__vars['xf']['visitor'], 'canEditProfile', array())) {
			$__compilerTemp3 .= '
			' . $__templater->formSubmitRow(array(
				'icon' => 'save',
				'sticky' => 'true',
			), array(
			)) . '
		';
		}
		$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body ncmsAccountManage">
			' . $__templater->formRow('
				' . $__templater->escape($__vars['xf']['visitor']['ncms_username']) . '
			', array(
			'label' => 'Username',
		)) . '
			
			' . $__templater->formRow('
				' . $__templater->escape($__vars['xf']['visitor']['ncms_uuid']) . '
			', array(
			'label' => 'UUID',
		)) . '
			
			' . $__templater->formRow('
				' . $__templater->button('Unlink account', array(
			'href' => $__templater->fn('link', array('account/minesync-unlink', ), false),
			'class' => 'button--link',
			'overlay' => 'true',
		), '', array(
		)) . '
			', array(
			'rowtype' => 'button',
			'label' => 'Unlink',
		)) . '
			
			<hr class="formRowSep" />
			
			' . $__compilerTemp1 . '
		</div>
		' . $__compilerTemp3 . '
	</div>
	', array(
			'action' => $__templater->fn('link', array('account/minesync', ), false),
			'ajax' => 'true',
			'class' => 'block',
			'data-force-flash-message' => 'true',
		)) . '
';
	}
	return $__finalCompiled;
});