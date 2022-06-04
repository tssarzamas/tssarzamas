<?php


class SiteController
{
	public function actionIndex()
	{	
		require_once(ROOT . '/views/product/index.php');
		return true;
	}

	public function actionPrivacy()
	{		
		require_once(ROOT . '/views/site/privacy.php');
		return true;
	}

	public function actionDelivery()
	{
		require_once(ROOT . '/views/site/delivery.php');
		return true;
	}

	public function actionContact()
	{
		require_once(ROOT . '/views/site/contact.php');
		return true;
	}

	public function actionAbout()
	{	
		require_once(ROOT . '/views/site/about.php');
		return true;
	}


	

}




