/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

.blog-wrapper .ads-inserter {
	display: none;
}
.blog.ossn-wall-item {
	margin-top: 0px;
	margin-bottom: 5px;
}
.blog .ossn-widget {
	margin-top: 15px;
}

.blog-wall-item {
	margin-bottom: 10px;
	word-break: break-word;
	overflow: auto;
}
.blog-wall-item-title {
	font-weight: bold;
	font-size: 15px;
	margin-bottom: 5px
}
.blog-wall-item img {
	max-width: 100%;
}

.row .blog-item a {
	display: block;
	padding: 8px;
	padding-left: 0px;
	border-bottom: 1px solid rgba(144, 144, 144, 0.25);
	font-weight: bold;
}

.blog .controls {
	float: right;
}

.blog-list-sort-option {
	float: right;
	display: inline-table;
	margin-top: -1px;
}
.ossn-notification-icon-blog {
	display: inline-block;
}
.ossn-notification-icon-blog:before {
	content: "\f044";
	font-family: 'Font Awesome 5 Free';
	font-style: normal;
	font-weight: 900;
	font-size: 18px;
}

.menu-section-blogs i:before {
	content: "\f044" !important
}
.menu-section-item-addblog:before {
	content: "\f067" !important
}
.menu-section-item-myblogs:before {
	content: "\f044" !important
}
.menu-section-item-allblogs:before {
	content: "\f044" !important
}
.ossn-menu-search-com-blog-search-blogs .text::before {
	font-family: 'Font Awesome 5 Free';
	content: "\f044";
	font-weight: 900;
	padding-right: 10px;
	vertical-align: middle;
	float: left;
}

@media (max-width: 480px) {
	.blog-list-sort-option {
		float: none;
		display: grid;
		margin-top: 5px;
	}
}
