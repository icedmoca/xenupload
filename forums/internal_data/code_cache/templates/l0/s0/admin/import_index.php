<?php
// FROM HASH: 53797e26271f4dbb86b068597e9b4fe9
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Import data');
	$__finalCompiled .= '

';
	if ($__vars['complete']) {
		$__finalCompiled .= '
	<div class="blockMessage blockMessage--success blockMessage--iconic">
		' . 'Your import has been completed successfully.' . '
	</div>
';
	}
	$__finalCompiled .= '

';
	$__compilerTemp1 = array(array(
		'_type' => 'option',
	));
	if ($__templater->isTraversable($__vars['importersGrouped'])) {
		foreach ($__vars['importersGrouped'] AS $__vars['target'] => $__vars['importers']) {
			$__compilerTemp1[] = array(
				'label' => $__vars['target'],
				'_type' => 'optgroup',
				'options' => array(),
			);
			end($__compilerTemp1); $__compilerTemp2 = key($__compilerTemp1);
			if ($__templater->isTraversable($__vars['importers'])) {
				foreach ($__vars['importers'] AS $__vars['importer'] => $__vars['info']) {
					$__compilerTemp1[$__compilerTemp2]['options'][] = array(
						'value' => $__vars['importer'],
						'label' => $__templater->escape($__vars['info']['source']),
						'_type' => 'option',
					);
				}
			}
		}
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formSelectRow(array(
		'name' => 'importer',
	), $__compilerTemp1, array(
		'label' => 'Import from',
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'submit' => 'Continue' . $__vars['xf']['language']['ellipsis'],
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('import/config', ), false),
		'class' => 'block',
	));
	return $__finalCompiled;
});