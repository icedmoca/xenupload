<?php
// FROM HASH: 4d40b6b4d5d725e709441c14bd035ecf
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->includeJs(array(
		'src' => 'themehouse/global/20171204.js',
		'min' => 'themehouse/global/20171204.min.js',
	));
	$__finalCompiled .= '
';
	$__templater->includeJs(array(
		'src' => 'themehouse/' . $__templater->fn('property', array('uix_jsPath', ), false) . '/index.js',
		'min' => 'themehouse/' . $__templater->fn('property', array('uix_jsPath', ), false) . '/index.min.js',
	));
	$__finalCompiled .= '
';
	$__templater->includeJs(array(
		'src' => 'themehouse/' . $__templater->fn('property', array('uix_jsPath', ), false) . '/defer.js',
		'min' => 'themehouse/' . $__templater->fn('property', array('uix_jsPath', ), false) . '/defer.min.js',
		'defer' => 'defer',
	));
	$__finalCompiled .= '


<script>
	
    // ############################### REPLACE CLICK HANDLER ##############################################

/*
    var replaceClick = XF.ToggleClick.prototype;
	replaceClick.load = function() {
        var href = this.toggleUrl,
            t = this;

        if (!href || this.loading)
        {
            return;
        }

        this.loading = true;

        XF.ajax(\'get\', href, function(data)
        {
            if (data.html)
            {
                XF.setupHtmlInsert(data.html, function ($html, container, onComplete)
                {
                    var loadSelector = t.$toggleTarget.data(\'load-selector\');
                    if (loadSelector)
                    {
                        var $newHtml = $html.find(loadSelector).first();
                        if ($newHtml.length)
                        {
                            $html = $newHtml;
                        }
                    }

                    t.ajaxLoaded = true;
                    t.$toggleTarget.replaceWith($html);
                    XF.activate($html);

                    onComplete(true);

                    t.show();

                    return false;
                });
            }
        }).always(function()
        {
            t.ajaxLoaded = true;
            t.loading = false;
        });
	};

    XF.ReplaceClick = XF.Click.newHandler(replaceClick);
	XF.Click.register(\'replace\', \'XF.ReplaceClick\');
*/
	
/****** OFF CANVAS ***/
$(document).ready(function() {
	var panels = {
		navigation: {
			position: 1
		},
		account: {
			position: 2
		},
		inbox: {
			position: 3
		},
		alerts: {
			position: 4
		}
	};
	
	
	var tabsContainer = $(\'.sidePanel__tabs\');
	
	var activeTab = \'navigation\';
	
	var activeTabPosition = panels[activeTab].position;
	
	var generateDirections = function() {
		$(\'.sidePanel__tabPanel\').each(function() {
			var tabPosition = $(this).attr(\'data-content\');
			var activeTabPosition = panels[activeTab].position;

			if (tabPosition != activeTab) {
				if (panels[tabPosition].position < activeTabPosition) {
					$(this).addClass(\'is-left\');
				}

				if (panels[tabPosition].position > activeTabPosition) {
					$(this).addClass(\'is-right\');
				}   
			}
		});
	};

	generateDirections();
	
	$(\'.sidePanel__tab\').click(function() {
		$(tabsContainer).find(\'.sidePanel__tab\').removeClass(\'sidePanel__tab--active\');
		$(this).addClass(\'sidePanel__tab--active\');
		
		activeTab = $(this).attr(\'data-attr\');
		
		$(\'.sidePanel__tabPanel\').removeClass(\'is-active\');
		
		$(\'.sidePanel__tabPanel[data-content="\' + activeTab + \'"]\').addClass(\'is-active\');
		$(\'.sidePanel__tabPanel\').removeClass(\'is-left\').removeClass(\'is-right\');
		generateDirections();
	});
});

/******** extra info post toggle ***********/

$(document).ready(function() {
	$(\'.thThreads__userExtra--trigger\').click(function() {
		var parent =  $(this).parents(\'.message-cell--user\');
	  	var triggerContainer = $(this).parent(\'.thThreads__userExtra--toggle\');
		var container = triggerContainer.siblings(\'.thThreads__message-userExtras\');
		var child = container.find(\'.message-userExtras\');
		var eleHeight = child.height();
		if (parent.hasClass(\'userExtra--expand\')) {
			container.css({ height: eleHeight });
			parent.toggleClass(\'userExtra--expand\');
			window.setTimeout(function() {
				container.css({ height: \'0\' });
				window.setTimeout(function() {
					container.css({ height: \'\' });
				}, 200);
			}, 17);

		} else {
			parent.toggleClass(\'userExtra--expand\');
			container.css({ height: eleHeight });
			window.setTimeout(function() {
				container.css({ height: \'\' });
			}, 200);
		}
	});
});


/******** Backstretch images ***********/

$(document).ready(function() {
	if ( ' . $__templater->fn('property', array('uix_backstretch', ), true) . ' ) {
		 $("' . $__templater->fn('property', array('uix_backstretchSelector', ), true) . '").backstretch([
			 ' . $__templater->fn('property', array('uix_backstretchImages', ), true) . '
	  ], {
			duration: ' . $__templater->fn('property', array('uix_backstretchDuration', ), true) . ',
			fade: ' . $__templater->fn('property', array('uix_backstretchFade', ), true) . '
		});
	}
});
</script>';
	return $__finalCompiled;
});