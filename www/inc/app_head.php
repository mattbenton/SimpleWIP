<?
	if (!empty($page) && file_exists('./res/css/' . $page . '.css')){
		?><link href="./res/css/<?=$page?>.css" rel="stylesheet"><?
	}
?>
</head><body>