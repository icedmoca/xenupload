<?php
// FROM HASH: 50a4c9d5530c3fbd0b53f5f756676ed2
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '.label
{
	display: inline-block;
	padding: 1px .35em;
	border: 1px solid transparent;
	border-radius: @xf-borderRadiusMedium;
	font-size: 80%;
	line-height: ((@xf-lineHeightDefault) * .9);
	text-decoration: none;

	&:hover,
	a:hover &
	{
		text-decoration: none;
	}

	&.label--fullSize
	{
		font-size: 100%;
	}

	&.label--small
	{
		font-size: @xf-fontSizeSmall;
	}

	&.label--smallest
	{
		font-size: @xf-fontSizeSmallest;
	}

	// variations
	&.label--hidden
	{
		background: none;
		border: none;
		box-shadow: none;
	}

	&.label--subtle
	{
		.m-labelVariation(@xf-textColorMuted, @xf-contentAltBg);
	}

	&.label--primary
	{
		.m-labelVariation(@xf-linkColor, @xf-contentHighlightBg, @xf-borderColorHighlight);
	}

	&.label--accent
	{
		.m-labelVariation(@xf-textColorAccentContent, @xf-contentAccentBg, @xf-borderColorAccentContent);
	}

	&.label--red { .m-labelVariation(white, #e20000); }
	&.label--green { .m-labelVariation(white, green); }
	&.label--olive { .m-labelVariation(white, olive); }
	&.label--lightGreen { .m-labelVariation(black, #ccf9c8, #bee8ba); }
	&.label--blue { .m-labelVariation(white, #0008e3); }
	&.label--royalBlue { .m-labelVariation(white, royalblue); }
	&.label--skyBlue { .m-labelVariation(white, #7cc3e0); }
	&.label--gray { .m-labelVariation(white, gray); }
	&.label--silver { .m-labelVariation(black, silver); }
	&.label--yellow { .m-labelVariation(black, #ffff91, #e6e687); }
	&.label--orange { .m-labelVariation(black, #ffcb00); }
}

.label-append
{
	display: inline-block;
}

.labelLink,
.labelLink:hover
{
	text-decoration: none;
}';
	return $__finalCompiled;
});