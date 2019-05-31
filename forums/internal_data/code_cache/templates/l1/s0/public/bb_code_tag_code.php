<?php
// FROM HASH: 6dea1b998ac0edfb78f47297d1500679
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= $__templater->callMacro('prism_macros', 'setup', array(), $__vars) . '

<div class="bbCodeBlock bbCodeBlock--screenLimited bbCodeBlock--code">
	<div class="bbCodeBlock-title">
		' . ($__templater->escape($__vars['config']['phrase']) ?: 'Code') . $__templater->escape($__vars['xf']['language']['label_separator']) . '
	</div>
	<div class="bbCodeBlock-content">
		<pre class="bbCodeCode" dir="ltr" data-xf-init="code-block" data-lang="' . ($__templater->escape($__vars['language']) ?: '') . '"><code>' . $__templater->escape($__vars['content']) . '</code></pre>
	</div>
</div>';
	return $__finalCompiled;
});