<?php
// FROM HASH: b55b42c215cd4d30c27577e0224537fd
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '/*
 * MineSync is a comprehensive sync for XenForo and Minecraft.
 * Copyright nanocode 2015-present. All rights reserved.
 *
 * THIS IS PROPRIETARY SOFTWARE, LICENSED UNDER THE NANOCODE PRODUCT AGREEMENT. ALL USE IS LIMITED TO VALID LICENSES ONLY, AND TO THE TERMS OF THE LICENSE AGREEMENT:
 * https://nanocode.io/terms
 */

/* GROUP BADGES START */

/* No longer necessary as of MineSync 2.0.0 Beta 1, but the code remains here in case you want to override styles using CSS */

.ncms-group-badge {
	font-size: 11px;
	background-color: rgb(206, 206, 206);
	padding: 1px 2px;
	display: inline-block;
	text-transform: uppercase;
}

/*.ncms-group-badge-example {
    background-color: #e74c3c !important;
    color: #ecf0f1 !important;
}*/

/* GROUP BADGES END */

/* GENERIC STYLING */
.mcShowcaseBlock {
    background-color: @xf-pageBg;
	padding: 4px 2px;
	height: 42px;
	margin-top: 10px;

	.playerAvatar {
		padding: 3px 0px 0px 2px;
		float: left;
		width: 28px;
	}

	.playerData {
		font-size: 11px;
		padding: 8px 2px 8px 6px;
		float: left;
		text-align: left;
		word-spacing: 0;
		width: 75%;

		&.withGroup {
			padding: 1px 2px 1px 6px;
		}

		.playerUsername {
			color: #2c3e50;
			overflow-y: hidden;
			height: 13px;
			margin-bottom: 2px;
		}
	}
}

/* CSS: PROFILE PAGE */

.mcPlayerProfile {
	width: 120px;
	float: right;
	position: relative;
	bottom: 40px;
}

@media (max-width: @xf-responsiveNarrow)
{
	.mcPlayerProfile {
		position: inherit;
		bottom: 0;
		margin: 0 auto;
	}
}

/* Register block */

.ncmsRegisterBlock {
	height: 60px;
	padding: 20px;
	background-color: lightgrey !important;

	.regmsg {
		position: relative;
		bottom: 15px;

		img {
			position: relative;
			top: 10px;
			margin-right: 5px;
		}
	}
}

/* Account manage */
.ncmsAccountManage {
	.ncmsInlineBlockGroup {
		display: inline-block;
	}
}

/* Server status widget */
.block.ncms-mc-status .block-minorHeader {
	display: block;

}

.ncms-mc-status {
	.status-indicator {
        float: right;
		position: relative;
        font-size: 30px;
        padding-top: 9px;
        line-height: 0;
	}

    .status-indicator.online {
      color: limegreen;
    }
    .status-indicator.offline {
      color: red;
    }
}';
	return $__finalCompiled;
});