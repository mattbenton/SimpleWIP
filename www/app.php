<?require_once('./inc/head.php');?>
<?require_once('./inc/nav.php');?>
<?
	@$page = $_GET['p'];
	// security?
	$page = str_replace('.', '', $page);	
	if (!empty($page) && file_exists('./page/' . $page . '.php')){
		require_once('./page/' . $page . '.php');
	}else {
		require_once('./page/error.php');
	}
?>
<?require_once('./inc/foot.php');?>