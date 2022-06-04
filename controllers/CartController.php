<?php

class CartController
{
    public function actionAdd($id)
    {
        // Добавляем товар в корзину
        Cart::addProduct($id);

        // Возвращаем пользователя на страницу
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    }

     public function actionAddAjax($id)
    {
        // Добавляем товар в корзину
        echo Cart::addProduct($id);
        return true;
    }

   public function actionIndex($page = 1)
    {

        $productsInCart = false;

        // Получим данные из корзины
        $productsInCart = Cart::getProducts();

        if ($productsInCart) {
            // Получаем полную информацию о товарах для списка
            $productsIds = array_keys($productsInCart);
            $products = Product::getProductByIDs($productsIds, $page);

            // Получаем общую стоимость товаров
           
            $products_prise = Product::getProductsByIDsCheck($productsIds);
            $totalPrice = Cart::getTotalPrice($products_prise);


        // Общее количеcтво товаров (необходимо для постраничной навигации)
        $total = count($productsIds);
        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');
        }

        require_once(ROOT . '/views/cart/index.php');

        return true;
    }
 

    public function actionMinCart($id)
    {   
       
        // кол-во конвретного товара
        $count_products_id = Cart::MinCart($id);
        // кол-во товаров в корзине
        $countItemsCart = Cart::countItems();
    
        // Получаем общую стоимость товаров  
        $productsInCart = Cart::getProducts();
        $productsIds = array_keys($productsInCart);        
        $products_prise = Product::getProductsByIDsCheck($productsIds);
        $totalPrice = Cart::getTotalPrice($products_prise);

        // массив элементов
        $arraymin = array($count_products_id, $countItemsCart, $totalPrice);


        $comma_separated = implode("|", $arraymin);
        echo $comma_separated;

        /*echo Cart::MinCart($id);*/
        return true;
    }

    public function actionPlusCart($id)
    {  
         
        $count_products_id = Cart::PlusCart($id);
        // кол-во товаров в корзине
        $countItemsCart = Cart::countItems();
    
        // Получаем общую стоимость товаров  
        $productsInCart = Cart::getProducts();
        $productsIds = array_keys($productsInCart);        
        $products_prise = Product::getProductsByIDsCheck($productsIds);
        $totalPrice = Cart::getTotalPrice($products_prise);

        // массив элементов
        $arraymin = array($count_products_id, $countItemsCart, $totalPrice);

        $comma_separated = implode("|", $arraymin);
        /**/
        echo $comma_separated;

        return true;
    }

    
    // удалить 1 товар из корзины
    public function actionDelCart($id)
    {   
        echo Cart::DelCart($id);
        return true;
    }

    //удалить все товары из корзины
   public function actionDeleteSession()
    {   

        // session_destroy();
        Cart::DeleteSessionProsucts();
        return true;
    }

    public function actionCheckout()
    {
        // Статус успешного оформления заказа
        $result = false;

          // Форма отправлена?
        if (isset($_POST['submit'])) {
            // Форма отправлена? - Да
            // Считываем данные формы
             /*$userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userAddress = $_POST['userAddress'];*/
            

            $userId = User::checkLogged();
            $user = User::getUserById($userId);
            $userName = $user['name'];
            $userPhone = $user['phone'];
            $userAddress = $user['address'];


            // Валидация полей

            $errors = false;                                
            if ($userName == 'не указан' || $userPhone == 'не указан' || $userAddress == 'не указан') {
               $errors[] = 'Не все данные указаны';
            }

          
            if ($errors == false) { 
            // условие верно? - Да
            // Сохраняем заказ в базе данных, Собираем информацию о заказе
                
                $productsInCart = Cart::getProducts(); //in session save
               
                if (User::isGuest()) {
                    $userId = false;
                } else {
                    $userId = User::checkLogged();
                }
                // Сохраняем заказ в БД
                $products = json_encode($productsInCart);


           
                if ($products != 'false') {
                $result = Order::save($userId, $products);
                } else {
                    $result = false;
                    header("Location: /catalog/");
                }
                
                if ($result) {
                    // !!!!!!Оповещаем администратора о новом заказе!!!!  
                    $adminEmail = 'lun.dola@ya.ru';
                    $message = 'http://tss.website';
                    $subject = 'Новый заказ! Номер заказа - '.$result.'.';
                    mail($adminEmail, $subject, $message);

                    // Очищаем корзину
                    Cart::DeleteSessionProsucts();
                }
                } else {
                // Форма заполнена корректно? - Нет
                // Итоги: общая стоимость, количество товаров
                $productsInCart = Cart::getProducts();
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIDsCheck($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();
            }
        } else {
            // Форма отправлена? - Нет
            // Получием данные из корзины      
            $productsInCart = Cart::getProducts();

            // В корзине есть товары?
            if ($productsInCart == false) {
                // В корзине есть товары? - Нет
                // Отправляем пользователя на главную искать товары
                header("Location: /catalog/");
            } else {
                // В корзине есть товары? - Да
                // Итоги: общая стоимость, количество товаров
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIDsCheck($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();

                $userName = false;
                $userPhone = false;
                $userComment = false;

                // Пользователь авторизирован?
                if (User::isGuest()) {
                    // Нет
                    // Значения для формы пустые
                } else {
                    // Да, авторизирован                    
                    // Получаем информацию о пользователе из БД по id
                    $userId = User::checkLogged();
                    $user = User::getUserById($userId);
                    // Подставляем в форму
                    $userName = $user['name'];
                    $userPhone = $user['phone'];
                    $userAddress = $user['address'];
                }
            }
        }

       require_once(ROOT . '/views/cart/checkout.php');
       return true;
    }

}
