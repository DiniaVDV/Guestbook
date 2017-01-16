<?php
	$config =[
		'stoplist' => ['firstStop', 'secondStop', 'thirdStop'],
		'symbols' => [',', '!', '?', '/', '.', '-', '*', '+', '%', '#', '@', '$', '^', '(', ')', '{', '}', '[', ']', '>', '<', '&', '\'', '\"', '|', '\\'],
		'database' => 'database/guestbook.db',
		'stopWordReplcement' => '*forgetmenot*', /**/
		'templatesDirectory' => 'templates' . DIRECTORY_SEPARATOR ,
		'messagesCount' => 15 /*к-сть повыдомлень якы ми будемо виводити*/
	];
?>
