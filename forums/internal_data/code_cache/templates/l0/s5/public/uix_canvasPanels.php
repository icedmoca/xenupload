<?php
// FROM HASH: 2a54edc7f75b48ce3084cb64efc6aa4a
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '<div class="sidePanel sidePanel--nav sidePanel--visitor">
	<div class="sidePanel__tabPanels">
		
		<div data-content="navigation" class="is-active sidePanel__tabPanel js-navigationTabPanel">
			' . $__templater->callMacro('PAGE_CONTAINER', 'canvasNavPanel', array(), $__vars) . '
		</div>
		
		';
	if ($__vars['xf']['visitor']['user_id'] AND ($__templater->fn('property', array('uix_visitorTabsMobile', ), false) == 'canvas')) {
		$__finalCompiled .= '
			
		<div data-content="account" class="sidePanel__tabPanel js-visitorTabPanel">
		<div class="uix_canvasPanelBody" data-menu="menu" aria-hidden="true"
			 data-href="' . $__templater->fn('link', array('account/visitor-menu', ), true) . '"
			 data-load-target=".js-visitorMenuBody">
			<div class="menu-content js-visitorMenuBody">
			</div>
		</div>
		</div>
		
		<div data-content="inbox" class="sidePanel__tabPanel js-convoTabPanel">
			<div class="menu-content">
				<div class="uix_canvasPanelBody" data-menu="menu" aria-hidden="true"
					 data-href="' . $__templater->fn('link', array('conversations/popup', ), true) . '"
					 data-nocache="true"
					 data-target=".js-convMenuBody">
					<h3 class="menu-header">' . 'Conversations' . '</h3>
					<div class="js-convMenuBody">
					</div>
				</div>
				<div class="menu-footer">
					<a href="' . $__templater->fn('link', array('conversations/add', ), true) . '" class="u-pullRight">' . 'Start a new conversation' . '</a>
					<a href="' . $__templater->fn('link', array('conversations', ), true) . '">' . 'Show all' . $__vars['xf']['language']['ellipsis'] . '</a>
				</div>
			</div>
		</div>
		
		<div data-content="alerts" class="sidePanel__tabPanel js-alertTabPanel">
			<div class="menu-content">
				<div class="uix_canvasPanelBody" data-menu="menu" aria-hidden="true"
					 data-href="' . $__templater->fn('link', array('account/alerts-popup', ), true) . '"
					 data-nocache="true"
					 data-target=".js-alertsMenuBody">
					<h3 class="menu-header">' . 'Alerts' . '</h3>
					<div class="js-alertsMenuBody">
					</div>
				</div>
				<div class="menu-footer menu-footer--split">
					<span class="menu-footer-main">
						<a href="' . $__templater->fn('link', array('account/alerts', ), true) . '">' . 'Show all' . $__vars['xf']['language']['ellipsis'] . '</a>
					</span>
					<span class="menu-footer-opposite">
						<a href="' . $__templater->fn('link', array('account/preferences', ), true) . '">' . 'Preferences' . '</a>
					</span>
				</div>
			</div>
		</div>
			
		';
	}
	$__finalCompiled .= '
		
	</div>
</div>';
	return $__finalCompiled;
});