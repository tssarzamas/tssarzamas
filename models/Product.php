<?php

class Product
{

//Список категорий 
	
	public static function getProductGenus() 
	{
		$db = Db::getConnection();
		$ProductGenus = array();
		$result = $db->query('SELECT * FROM category ORDER BY ID_category ASC LIMIT 10');
		$i = 0;
		while($row = $result->fetch()) {
			$ProductGenus[$i]['ID_category'] = $row['ID_category'];
			$ProductGenus[$i]['Category_name'] = $row['Category_name'];
			$ProductGenus[$i]['Sorting_number'] = $row['Sorting_number'];
			$i++;
		}
		return $ProductGenus;
	}

//Список подкатегорий  категории	
	public static function getProductSubcategories($id_cat)
	{
		$id_cat = intval($id_cat);

		if ($id_cat) {
		$db = Db::getConnection();
		$ProductSubcategories = array();
		$result = $db->query('SELECT * FROM type_product WHERE ID_category=' . $id_cat);

		$i = 0;
		while($row = $result->fetch()) {
			$ProductSubcategories[$i]['ID_type'] = $row['ID_type'];
			$ProductSubcategories[$i]['ID_category'] = $row['ID_category'];
			$ProductSubcategories[$i]['Naimenovanie_type'] = $row['Naimenovanie_type'];
			// $ProductSubcategories[$i]['image'] = $row['image'];
			$i++;
		}

		return $ProductSubcategories;
		
		}

	}


//Список подкатегорий  	
	public static function getSubcategories()
	{
		
		$db = Db::getConnection();
		$Subcategories = array();
		$result = $db->query('SELECT * FROM type_product');

		$i = 0;
		while($row = $result->fetch()) {
			$Subcategories[$i]['ID_type'] = $row['ID_type'];
			$Subcategories[$i]['ID_category'] = $row['ID_category'];
			$Subcategories[$i]['Naimenovanie_type'] = $row['Naimenovanie_type'];
			$i++;
		}

		return $Subcategories;
		
		}


//Вывод всех товаров подкатегорий		
		public static function getProductView($id_cat, $id_type)
	{
		$id_cat = intval($id_cat);
		$id_type = intval($id_type);

		if ($id_cat && $id_type) {
		$db = Db::getConnection();
		$ProductView = array();
		$result = $db->query('SELECT * FROM products WHERE ID_type=' . $id_type);

		$i = 0;
		while($row = $result->fetch()) {
			$ProductView[$i]['ID_product'] = $row['ID_product'];
			$ProductView[$i]['ID_type'] = $row['ID_type'];
			$ProductView[$i]['model'] = $row['model'];
			$ProductView[$i]['sovmes'] = $row['sovmes'];
			$ProductView[$i]['proizv'] = $row['proizv'];
			$ProductView[$i]['datap'] = $row['datap'];
			$ProductView[$i]['info'] = $row['info'];
			$ProductView[$i]['price'] = $row['price'];
			$i++;
		}
		return $ProductView;
		
		}
	}

//Вывод конкретного товара
		public static function getProductByID($id_cat, $id_type, $id)
	{
		$id_cat = intval($id_cat);
		$id_type = intval($id_type);
		$id = intval($id);

		if ($id_cat && $id_type && $id) {
			$db = Db::getConnection();
			$result = $db->query('SELECT * FROM products WHERE ID_product=' . $id);
			$result->setFetchMode(PDO::FETCH_ASSOC);
			$ProductItem = $result->fetch();
			return $ProductItem;
		}
	}


// вывод категорий и подкатегорий
	public static function getProduct()
	{
		$db = Db::getConnection();
		$Product = array();
		$sub = array();
		$result = $db->query('SELECT * FROM category ORDER BY Sorting_number ASC LIMIT 10');
		$i = 0;
		while($row = $result->fetch()) {
			$Product[$i]['ID_category'] = $row['ID_category'];
			$Product[$i]['Category_name'] = $row['Category_name'];

			$result_2 = $db->query('SELECT * FROM type_product WHERE ID_category=' . $Product[$i]['ID_category']);
			$r=0;
			while($row_2 = $result_2->fetch()) {
				$sub[$r]['ID_type'] = $row_2['ID_type'];			 
				$sub[$r]['Naimenovanie_type'] = $row_2['Naimenovanie_type'];
				$r++;
			};

			$Product[$i]['Naimenovanie_type']=$sub;
			$i++;
		}
		
		return $Product;
	}

	
	const SHOW_BY_DEFAULT = 10;

	// Возвращает список товаров с указанными индентификторами cart
	public static function getProductByIDs($idsArray, $page)
	{
		$products = array();
		$idsString = implode(',', $idsArray);


		$limit = Product::SHOW_BY_DEFAULT;
        // Смещение (для запроса)
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;


		$db = Db::getConnection();

		$sql = "SELECT * FROM products WHERE ID_product IN ($idsString) LIMIT ".$limit." OFFSET ".$offset;

        $result = $db->query($sql);        
		$result->setFetchMode(PDO::FETCH_ASSOC);

		$i = 0;
        while ($row = $result->fetch()) {
		    $products[$i]['ID_product'] = $row['ID_product'];
			$products[$i]['ID_type'] = $row['ID_type'];
			$products[$i]['model'] = $row['model'];
			$products[$i]['sovmes'] = $row['sovmes'];
			$products[$i]['proizv'] = $row['proizv'];
			$products[$i]['datap'] = $row['datap'];
			$products[$i]['info'] = $row['info'];
			$products[$i]['price'] = $row['price'];
            $i++;
		}

		return $products;
	}



	// Возвращает список товаров с указанными индентификторами cart
	public static function getProductsByIDsCheck($idsArray)
	{
		$products = array();
		$idsString = implode(',', $idsArray);
		
		$db = Db::getConnection();

		$sql = "SELECT * FROM products WHERE ID_product IN ($idsString)";

        $result = $db->query($sql);        
		$result->setFetchMode(PDO::FETCH_ASSOC);

		$i = 0;
        while ($row = $result->fetch()) {
		    $products[$i]['ID_product'] = $row['ID_product'];
			$products[$i]['ID_type'] = $row['ID_type'];
			$products[$i]['model'] = $row['model'];
			$products[$i]['sovmes'] = $row['sovmes'];
			$products[$i]['proizv'] = $row['proizv'];
			$products[$i]['datap'] = $row['datap'];
			$products[$i]['info'] = $row['info'];
			$products[$i]['price'] = $row['price'];
            $i++;
		}

		return $products;
	}

//получение категорий по идентификатору

	public static function getCategoryById($id)
	{		
			$id = intval($id);

			if ($id) {
			$db = Db::getConnection();
			$result = $db->query('SELECT * FROM category WHERE ID_category=' . $id);
			$result->setFetchMode(PDO::FETCH_ASSOC);
			$ProductCategoryById = $result->fetch();
			return $ProductCategoryById;
			}
	}

//получение подкатегорий по идентификатору

	public static function getSubcategoryById($id_type)
	{		
			$id_type = intval($id_type);
			if ($id_type) {
			$db = Db::getConnection();
			$result = $db->query('SELECT * FROM type_product WHERE ID_type=' . $id_type);
			$result->setFetchMode(PDO::FETCH_ASSOC);
			$ProductSubategoryById = $result->fetch();
			return $ProductSubategoryById;
			}
	}


	
/*
* Действия над элементами в базе данных
*/

//добавление категории
	public static function createCategory($options)
	{
		$db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO category (Category_name, Sorting_number) VALUES (:Category_name, :Sorting_number)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':Category_name', $options['Category_name'], PDO::PARAM_STR);
   		$result->bindParam(':Sorting_number', $options['Sorting_number'], PDO::PARAM_INT);
   		
        return $result->execute();
    }

//редактирование категории
    public static function updateCategory($id, $name, $Sort)
	{
		// Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE category SET Category_name = :Category_name, Sorting_number = :Sorting_number  WHERE ID_category = :ID_category ";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':ID_category', $id, PDO::PARAM_INT);
        $result->bindParam(':Category_name', $name, PDO::PARAM_STR);
        $result->bindParam(':Sorting_number', $Sort, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function deleteCategory($id)
	{
	   // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM category WHERE ID_category = :ID_category';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':ID_category', $id, PDO::PARAM_INT);
        return $result->execute();
    }


// subcategory добавить
    public static function createSubcategory($options)
	{
		$db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO type_product (ID_category, Naimenovanie_type) VALUES (:ID_category, :Naimenovanie_type)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':ID_category', $options['ID_category'], PDO::PARAM_INT);
   		$result->bindParam(':Naimenovanie_type', $options['Naimenovanie_type'], PDO::PARAM_STR);   		
    	if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }


// изменить подкатегорию
    public static function updateSubcategory($id_type, $name, $category_id) 
    {

    	// Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE type_product SET ID_category = :ID_category, Naimenovanie_type = :Naimenovanie_type WHERE ID_type = :ID_type ";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':ID_type', $id_type, PDO::PARAM_INT);
        $result->bindParam(':ID_category', $category_id, PDO::PARAM_INT);
        $result->bindParam(':Naimenovanie_type', $name, PDO::PARAM_STR);
        
        return $result->execute();

    }

    public static function deleteSubcategory($id)
	{
	   // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM type_product WHERE ID_type = :ID_type';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':ID_type', $id, PDO::PARAM_INT);
        return $result->execute();
    }



// product by ID
public static function searchProducts($id)
	{
			$id = intval($id);
			if ($id) {
			$db = Db::getConnection();
			$result = $db->query('SELECT * FROM products WHERE ID_product=' . $id);
			$result->setFetchMode(PDO::FETCH_ASSOC);
			$ProductCategoryById = $result->fetch();
			return $ProductCategoryById;
			}
    }


// products добавить
    public static function createProducts($options)
	{
		$db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO products (ID_type, model, dlina, vysota, shirina, product_volume, ves, price) VALUES (:ID_type, :model, :dlina, :vysota, :shirina, :product_volume, :ves, :price)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':ID_type', $options['id_type'], PDO::PARAM_INT);
   		$result->bindParam(':model', $options['model'], PDO::PARAM_STR);
   		$result->bindParam(':sovmes', $options['somves'], PDO::PARAM_STR); 
   		$result->bindParam(':proizv', $options['proizv'], PDO::PARAM_STR); 
   		$result->bindParam(':datap', $options['datap'], PDO::PARAM_STR); 
   		$result->bindParam(':info', $options['info'], PDO::PARAM_STR); 
   		$result->bindParam(':price', $options['price'], PDO::PARAM_STR);    		
    	

        return $result->execute();
    }



    public static function updateProducts($id, $options)
    {
    	$db = Db::getConnection();

  		// Текст запроса к БД
    	$sql = "UPDATE products 
    	SET ID_type = :ID_type, model= :model, dlina= :dlina, vysota= :vysota, shirina = :shirina, product_volume = :product_volume, ves = :ves, price = :price
    	WHERE ID_product = :ID_product";     
    

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':ID_product', $id, PDO::PARAM_INT);

        $result->bindParam(':ID_type', $options['id_type'], PDO::PARAM_INT);
   		$result->bindParam(':model', $options['model'], PDO::PARAM_STR);
   		$result->bindParam(':sovmes', $options['somves'], PDO::PARAM_STR); 
   		$result->bindParam(':proizv', $options['proizv'], PDO::PARAM_STR); 
   		$result->bindParam(':datap', $options['datap'], PDO::PARAM_STR); 
   		$result->bindParam(':info', $options['info'], PDO::PARAM_STR); 
   		$result->bindParam(':price', $options['price'], PDO::PARAM_STR);    		
    	

        return $result->execute();

    }

     public static function deleteProducts($id)
	{
	   // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM products WHERE ID_product = :ID_product';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':ID_product', $id, PDO::PARAM_INT);
        return $result->execute();
    }




    /**
     * Возвращает путь к изображению
     * @param integer $id
     * @return string <p>Путь к изображению</p>
     */
    public static function getImage($id)
    {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';

        // Путь к папке с товарами
        $path = '/template/img_product/products/';

        // Путь к изображению товара
        $pathToProductImage = $path . $id . '.JPG';

        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage;
        }

        // Возвращаем путь изображения-пустышки
        return $path . $noImage;
    }
}