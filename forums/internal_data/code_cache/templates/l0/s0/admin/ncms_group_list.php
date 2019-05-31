<?php
// FROM HASH: 67d5a116d8e3a978464c544194bade4e
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Groups');
	$__finalCompiled .= '

';
	$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('
		' . 'Add group' . '
	', array(
		'href' => $__templater->fn('link', array('minesync/groups/add', ), false),
		'icon' => 'add',
	), '', array(
	)) . '
');
	$__finalCompiled .= '

<div class="block-outer">
	' . $__templater->callMacro('filter_macros', 'quick_filter', array(
		'key' => 'minesync-groups',
		'class' => 'block-outer-opposite',
	), $__vars) . '
</div>

<div class="block-container">
	<div class="block-body">
		';
	$__compilerTemp1 = '';
	if ($__templater->isTraversable($__vars['groups'])) {
		foreach ($__vars['groups'] AS $__vars['group']) {
			$__compilerTemp1 .= '
				' . $__templater->dataRow(array(
			), array(array(
				'hash' => $__vars['group']['id'],
				'href' => $__templater->fn('link', array('minesync/groups/edit', $__vars['group'], ), false),
				'label' => $__templater->escape($__vars['group']['name']),
				'_type' => 'main',
				'html' => '',
			),
			array(
				'href' => $__templater->fn('link', array('minesync/groups/delete', $__vars['group'], ), false),
				'_type' => 'delete',
				'html' => '',
			))) . '
			';
		}
	}
	$__finalCompiled .= $__templater->dataList('
			' . $__compilerTemp1 . '
		', array(
	)) . '
	</div>
	<div class="block-footer">
		<span class="block-footer-counter">' . $__templater->fn('display_totals', array($__templater->fn('count', array($__vars['groups'], ), false), ), true) . '</span>
	</div>
</div>';
	return $__finalCompiled;
});