<?php

return array('register'=> 'user/register',
	'myreturn'=>'user/myreturn',
	'admin/statuses/([0-9]+)/([0-9]+)' => 'admin/change_statuses/$1/$2',
	'new/([0-9]+)'=>'admin/new/$1',
	'user/condition'=>'user/condition',
	'user/nocondition'=>'user/nocondition',
	'user/product/([0-9]+)' => 'user/formreturn/$1', // actionView в ProductController
	'admin/app/([0-9]+)' => 'admin/formapp/$1', // actionView в ProductController
	'return'=>'return/return',
	'return/login'=>'return/login',
	'user'=>'user/profile',
	'bought'=>'user/bought',
	'application'=>'admin/application',
	'messages'=>'user/message',
	
	''=>'site/index',
);
