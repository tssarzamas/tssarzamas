<?php
include_once ROOT.'/models/Product.php';
class CatalogController
{
	// Вывод конкретного товара
	public function actionByID($id_cat, $id_type, $id)
		{
			if ($id_cat && $id_type && $id) {
				$ProductItem = Product::getProductByID($id_cat, $id_type, $id);

				// get category name
				$category = Product::getCategoryById($id_cat);
				$category_name = $category['Category_name'];

				// get subcategory name
				$subcategory = Product:: getSubcategoryById($id_type);	
				$subcategory_name = $subcategory['Naimenovanie_type'];
				
				require_once(ROOT . '/views/catalog/productByID.php');
			
			}
			return true;
		}
	

	// Вывод товаров подкатегории
	public function actionView($id_cat, $id_type)
		{   
		$ProductView = array();
		$ProductView = Product::getProductView($id_cat, $id_type);	

		// get category name
		$category = Product::getCategoryById($id_cat);
		$category_name = $category['Category_name'];

		// get subcategory name
		$subcategory = Product:: getSubcategoryById($id_type);	
		$subcategory_name = $subcategory['Naimenovanie_type'];


		require_once(ROOT . '/views/catalog/products.php');
		return true;
		}


    // Вывод подкатегорий
	public function actionSubcategories($id_cat)
		{   
	
		$ProductSubcategories= array();
		$ProductSubcategories= Product::getProductSubcategories($id_cat);

		$category = Product::getCategoryById($id_cat);
		$category_name = $category['Category_name'];
		
		require_once(ROOT . '/views/catalog/subcategory.php');
		return true;
		}


    // Вывод категорий
	public function actionGenus()
		{
			
		$ProductGenus= array(); //вывод просто категорий
		$ProductGenus= Product::getProductGenus();
		
		$Product = array(); //вывод категорий и подкатегорий
		$Product = Product::getProduct();

		// echo "<pre>"; print_r($Product); echo "</pre>";
		
		require_once(ROOT . '/views/catalog/index.php');
		return true;
		}




	
}




