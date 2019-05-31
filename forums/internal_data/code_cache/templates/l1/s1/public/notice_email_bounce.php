<?php
// FROM HASH: c96856f7801b3124c4c6d74c08139202
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= 'Attempts to send emails to ' . $__templater->escape($__vars['xf']['visitor']['email']) . ' have failed. Please update your email.' . '<br />
<a href="' . $__templater->fn('link', array('account/contact-details', ), true) . '">' . 'Update your contact details' . '</a>';
	return $__finalCompiled;
});