<?php
/*
 * Контроллер AdminProductController
 * Управление товарами в админпанели
 */
class AdminProductController extends AdminBase
{
 //Действия над категориями

// показать категории
    public function actionCategory()
    {
        // Проверка доступа
        self::checkAdmin();
        // Получаем список категорий
        $ProductGenus = Product::getProductGenus();
        // Подключаем вид
        require_once(ROOT . '/views/admin_product/category/index.php');
        return true;
    }
  
//добавить категорию
    public function actionCreateCategory()
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['Category_name'] = $_POST['Category_name'];
            $options['Sorting_number'] = $_POST['Sorting_number'];
          
            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['Category_name']) || empty($options['Category_name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новый товар
                $id = Product::createCategory($options);

                // Перенаправляем пользователя на страницу управлениями 
                header("Location: /admin/category");
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_product/category/create.php');
        return true;
    }

//редкатировать категорию
    public function actionUpdateCategory($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем данные о категории
        $category = Product::getCategoryById($id);
        $category_name = $category['Category_name'];
        $Sorting_number = $category['Sorting_number'];

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $name = $_POST['Category_name'];
            $Sort = $_POST['Sorting_number'];
            // Сохраняем изменения
            Product::updateCategory($id, $name, $Sort);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/category");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_product/category/update.php');
        return true;
    }

//удалить категорию
    public function actionDeleteCategory($id)
    {
        
        self::checkAdmin(); // Проверка доступа
        
        // получение наименования категории
        $category = Product::getCategoryById($id);
        $category_name = $category['Category_name'];


        if (isset($_POST['submit'])) {
            // Если форма отправлена, удаляем товар
            Product::deleteCategory($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/category");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_product/category/delete.php');
        return true;
    }


//Действия над подкатегориями

//показать подкатегории
     public function actionSubcategory($id_cat)
        {
            // Проверка доступа
            self::checkAdmin();

            // Получаем список категорий
            $ProductSubcategories = Product::getProductSubcategories($id_cat);

            // $id = $ProductSubcategories['ID_category'];
            $category = Product::getCategoryById($id_cat);
            $category_name = $category['Category_name'];

            // Подключаем вид
            require_once(ROOT . '/views/admin_product/subcategory/index.php');
            return true;
        }


    //добавить подкатегорию
    public function actionCreateSubcategory($id_cat)
    {
        // Проверка доступа
        self::checkAdmin();

        $category = Product::getProductGenus(); //select +

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена, Получаем данные из формы
            $options['Naimenovanie_type'] = $_POST['Naimenovanie_type'];
            $options['ID_category'] = $_POST['category'];


            $errors = false; // Флаг ошибок в форме

            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['Naimenovanie_type']) || empty($options['Naimenovanie_type'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // Если ошибок нет
                $id = Product::createSubcategory($options);
                   
                // Если запись добавлена
                if ($id) {
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папку, дадим новое имя
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/template/img_product/products/{$id}.jpg");
                    }
                };

                $id_category = $options['ID_category'];
                // Перенаправляем пользователя на страницу
                 header("Location: /admin/subcategory/$id_category");
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_product/subcategory/create.php');
        return true;
    }

    //редкатировать категорию
    public function actionUpdateSubcategory($id_type)
    {
        // Проверка доступа
        self::checkAdmin();
        
        $categoriesList = Product::getProductGenus(); //для выпадающего списка

        // Получаем данные о подкатегории
        $Subcategory = Product::getSubcategoryById($id_type);  
        
        //текущее наименование категории
        $Subcategory_id_cat = $Subcategory['ID_category']; //id cat        
        $category_this = Product::getCategoryById($Subcategory_id_cat);
        $category_name = $category_this['Category_name'];


        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $name = $_POST['Naimenovanie_type'];
            $category_id = $_POST['category'];
           
            // Сохраняем изменения          
            if (Product::updateSubcategory($id_type, $name, $category_id)) {
                // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папку, дадим новое имя
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/template/img_product/products/{$id_type}.jpg");
                    }
                };

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/subcategory/$category_id");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_product/subcategory/update.php');
        return true;
    }

     public function actionDeleteSubcategory($id)
    {
        
        self::checkAdmin(); // Проверка доступа
        
        // Получаем данные о подкатегории
        $Subcategory = Product::getSubcategoryById($id);         
        $subcategory_name = $Subcategory['Naimenovanie_type'];
        $category_id = $Subcategory['ID_category'];


        if (isset($_POST['submit'])) {
            // Если форма отправлена, удаляем товар
            Product::deleteSubcategory($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/subcategory/$category_id");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_product/subcategory/delete.php');
        return true;
    }

// products 


    // посмотреть products

    public function actionProducts($id_cat, $id_type)
        {
            // Проверка доступа
            self::checkAdmin();

            // Получаем продукцию
            $productList = array();
            $productList = Product::getProductView($id_cat, $id_type);         


            // Получаем список подкатегорий
            $ProductSubcategories = Product::getProductSubcategories($id_cat);

            // Получаем категорию по ИД
            $category = Product::getCategoryById($id_cat);
            $category_name = $category['Category_name'];

            // Получанение подкатегорий для списка
            $subcategory = Product::getSubcategoryById($id_type);
            $subcategory_name = $subcategory['Naimenovanie_type'];


            // Подключаем вид
            require_once(ROOT . '/views/admin_product/products/index.php');
            return true;
        }
    
    //добавить product
    public function actionCreateProducts($id_cat, $id_type)
    {
        // Проверка доступа
        self::checkAdmin();

        $Subcategory = Product::getProductSubcategories($id_cat); //select +

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена, Получаем данные из формы

            $options['id_type'] = $_POST['subcategory'];            
            $options['model'] = $_POST['model'];
            $options['dlina'] = $_POST['dlina'];
            $options['vysota'] = $_POST['vysota'];
            $options['shirina'] = $_POST['shirina'];
            $options['product_volume'] = $_POST['product_volume'];
            $options['ves'] = $_POST['ves'];
            $options['price'] = $_POST['price'];
            
            $errors = false; // Флаг ошибок в форме
            
            if ($errors == false) {
                // Если ошибок нет
                Product::createProducts($options);                   
                $id_subcat = $options['id_type'];
                // Перенаправляем пользователя на страницу
                 header("Location: /admin/products/$id_cat/$id_subcat");
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_product/products/create.php');
        return true;
    }

     //редкатировать product
    public function actionUpdateProducts($id_cat, $id_type, $id)
    {
        // Проверка доступа
        self::checkAdmin();
        
        $Subcategory = Product::getProductSubcategories($id_cat); //select +
        $productById = Product::getProductByID($id_cat, $id_type, $id); // product ID

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['id_type'] = $_POST['subcategory'];            
            $options['model'] = $_POST['model'];
            $options['dlina'] = $_POST['dlina'];
            $options['vysota'] = $_POST['vysota'];
            $options['shirina'] = $_POST['shirina'];
            $options['product_volume'] = $_POST['product_volume'];
            $options['ves'] = $_POST['ves'];
            $options['price'] = $_POST['price'];

            // Сохраняем изменения          
            Product::updateProducts($id, $options);


            $id_subcat = $options['id_type'];
            header("Location: /admin/products/$id_cat/$id_subcat");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_product/products/update.php');
        return true;
    }

    // удалить изделие
     public function actionDeleteProducts($id_cat, $id_type, $id)
    {
        
        self::checkAdmin(); // Проверка доступа
        
       $productById = Product::getProductByID($id_cat, $id_type, $id); // product ID

        if (isset($_POST['submit'])) {
            // Если форма отправлена, удаляем товар
            Product::deleteProducts($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/products/$id_cat/$id_type");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_product/products/delete.php');
        return true;
    }


        public static function actionUpdateByID($id)
        {
        // Проверка доступа
        self::checkAdmin();
        $productById = Product::searchProducts($id); 
        $id_type = $productById['ID_type'];
        $Subcategory = Product::getSubcategories();

         // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['id_type'] = $_POST['subcategory'];            
            $options['model'] = $_POST['model'];
            $options['dlina'] = $_POST['dlina'];
            $options['vysota'] = $_POST['vysota'];
            $options['shirina'] = $_POST['shirina'];
            $options['product_volume'] = $_POST['product_volume'];
            $options['ves'] = $_POST['ves'];
            $options['price'] = $_POST['price'];

            // Сохраняем изменения          
            Product::updateProducts($id, $options);

            header("Location: /admin/$id");
        }


        // Подключаем вид
        require_once(ROOT . '/views/admin_product/products/updateID.php');
        return true;
        }

}
