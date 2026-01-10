.newsfeed-middle-top {
	display: block;
	margin-top: 0px;
}
.pinnedposts .alert {
	margin-bottom: 6px;
}
.pinned-post {
	padding-top: 10px;
}
/*
7.2dev2 new feature
the unpin icon
since font-awesome free has no regular 'upin' icon
we combine a backslash and a 'pin' icon directed left-ward to overwrite the backslash
*/
.ossn-wall-item .post-control-unpin::before {
	content: "\f715" !important;
}
.pinnedpost-unpin-icon-fake {
	display: inline-block;
	margin-left: -25px;
	margin-right: 10px;
}
/*
7.2dev3 new feature
the pin icon
*/
.ossn-wall-item .post-control-pin::before {
	content: "\f08d" !important;
}
