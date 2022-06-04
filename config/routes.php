<?php
return array(
//корзина	

 	 'cart/MinCart/([0-9]+)'=> 'cart/MinCart/$1',
 	 'cart/PlusCart/([0-9]+)'=> 'cart/PlusCart/$1',
 	 'cart/DelCart/([0-9]+)'=> 'cart/DelCart/$1',

 	 'cart/addAjax/([0-9]+)'=> 'cart/addAjax/$1',
     'cart/add/([0-9]+)'=> 'cart/add/$1', //CartController функция actionAdd

     'cart/deleteSession'=> 'cart/deleteSession',
     'cart/checkout'=> 'cart/checkout',

     'cart/page-([0-9]+)'=> 'cart/index/$1',
     'cart'=> 'cart/index',

//каталог
	'catalog/([0-9]+)/([0-9]+)/([0-9]+)' => 'catalog/ByID/$1/$2/$3', // функция actionByID
	'catalog/([0-9]+)/([0-9]+)' => 'catalog/view/$1/$2', // функция actionView
	'catalog/([0-9]+)' => 'catalog/subcategories/$1', //функция actionSubcategories
	'catalog' => 'catalog/genus',  // функция actionGenuss

//пользователь

	'cabinet/payment/([0-9]+)' => 'cabinet/payment/$1', 

	'cabinet/orderRestart/([0-9]+)' => 'cabinet/orderRestart/$1', 
	'cabinet/orderCancel/([0-9]+)' => 'cabinet/orderCancel/$1', 
	
	'cabinet/orderView/([0-9]+)/page-([0-9]+)' => 'cabinet/orderView/$1/$2', 
	'cabinet/orderView/([0-9]+)' => 'cabinet/orderView/$1',  

	'cabinet/history/([0-9]+)/page-([0-9]+)' => 'cabinet/history/$1/$2',
	'cabinet/history/([0-9]+)' => 'cabinet/history/$1',  //CabinetController функция actionHistory

	'user/logout' => 'user/logout',  //UserController функция actionLogout
	'user/login' => 'user/login',    //UserController функция actionLogin	
	'user' => 'user/register',  //UserController функция actionRegister
	'cabinet/edit' => 'cabinet/edit',
 	'cabinet' => 'cabinet/index',

//админ панель

 	// category
	 	'admin/category/createCategory' => 'adminProduct/createCategory',
	    'admin/category/updateCategory/([0-9]+)' => 'adminProduct/updateCategory/$1',
	    'admin/category/deleteCategory/([0-9]+)' => 'adminProduct/deleteCategory/$1',
	    
	    'admin/category' => 'adminProduct/category',

    //subcategory
	    'admin/subcategory/createSubcategory/([0-9]+)'  => 'adminProduct/createSubcategory/$1',
	    'admin/subcategory/updateSubcategory/([0-9]+)' => 'adminProduct/updateSubcategory/$1',
	    'admin/subcategory/deleteSubcategory/([0-9]+)' => 'adminProduct/deleteSubcategory/$1',
	    'admin/subcategory/([0-9]+)'  => 'adminProduct/subcategory/$1',

	 //products
	    'admin/products/createProducts/([0-9]+)/([0-9]+)'          => 'adminProduct/createProducts/$1/$2',
	    'admin/products/updateProducts/([0-9]+)/([0-9]+)/([0-9]+)' => 'adminProduct/updateProducts/$1/$2/$3',
	    'admin/products/deleteProducts/([0-9]+)/([0-9]+)/([0-9]+)' => 'adminProduct/deleteProducts/$1/$2/$3',
	    


	    'admin/products/([0-9]+)/([0-9]+)'                         => 'adminProduct/products/$1/$2',

	//orders
	    'admin/orders/downloadOrders/([0-9]+)' => 'adminOrder/downloadOrders/$1', 
	
	    'admin/orders/updateOrders/([0-9]+)' => 'adminOrder/updateOrders/$1',
	    'admin/orders/deleteOrders/([0-9]+)' => 'adminOrder/deleteOrders/$1',
	    
	    'admin/orders/view/([0-9]+)/page-([0-9]+)'  => 'adminOrder/view/$1/$2', // view by ID
	    'admin/orders/view/([0-9]+)'     => 'adminOrder/view/$1', // view by ID
	    
	    
	    'admin/orders/deleteOrdersYears' => 'adminOrder/deleteOrdersYears', //удаление заказов давностью больее 3х лет	   
	    'admin/orders/page-([0-9]+)'     => 'adminOrder/index/$1', // list view
	    'admin/orders'     => 'adminOrder/index', // list view


	    'admin/([0-9]+)' =>  'adminProduct/updateByID/$1',
	    // 'admin/([0-9]+)' => 'admin/SearchProduct/$1',
 		'admin' => 'admin/index', 

//простые страницы
 	'about' => 'site/about',
 	'delivery' => 'site/delivery', 
 	'contact' => 'site/contact', 
 	'privacy' => 'site/privacy', 


 	'index.php' => 'site/index', // actionIndex в SiteController
    '' => 'site/index', // actionIndex в SiteController
 	// 'site' => 'site/index',
	);