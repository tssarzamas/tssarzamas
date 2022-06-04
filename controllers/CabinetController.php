<?php
include_once ROOT.'/models/Cabinet.php';
include_once ROOT.'/models/User.php';

class CabinetController
{
	
	public function actionIndex()
	{
		// Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();
        
        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);
        
        require_once(ROOT . '/views/cabinet/index.php');

        return true;
	}
	

    public function actionEdit()
    {
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();
        // echo "$userId";
        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);
        // print_r($user);

        $name = $user['name'];
        $address = $user['address'];
        $phone = $user['phone'];        
       
        $result = false;     

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];

            $errors = false;
            
            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
             if (!User::checkPhone($phone)) {
                $errors[] = 'Не правильно введен номер телефона';
            }           
            if ($errors == false) {
                $result = User::edit($userId, $name, $address, $phone); 
                header("Location: /cabinet/");                
            }

        }

        require_once(ROOT . '/views/cabinet/edit.php');

        return true;
    }


    /*Список заказов пользователя */
    public function actionHistory($id, $page = 1)
    {
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();        
        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);
        // Получаем список заказов
        $ordersList = Order::getOrderListByIdUser($id, $page);


        // Общее количетсво товаров (необходимо для постраничной навигации)
        $countOrder = Order::getOrderCountUser($id);
        $total = count($countOrder);

        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Order::SHOW_BY_DEFAULT, 'page-');

        require_once(ROOT . '/views/cabinet/history.php');
        return true;
    
    }


    /*Список заказов пользователя */
    public function actionOrderView($id, $page = 1)  
    {   
        
        // Получаем данные о конкретном заказе
        $order = Order::getOrderById($id);

        // Получаем массив с идентификаторами и количеством товаров
        $productsQuantity = json_decode($order['products'], true);

        // Получаем массив с индентификаторами товаров
        $productsIds = array_keys($productsQuantity);

        // Получаем список товаров в заказе
        $products = Product::getProductByIDs($productsIds, $page);

        // итоговая стоимость заказа
        $products_prise = Product::getProductsByIDsCheck($productsIds);
        $totalPrice = Order::getTotalPrice($products_prise, $productsQuantity);

        // Общее количеcтво товаров (необходимо для постраничной навигации)
        $total = count($productsIds);
        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');
        
        // Подключаем вид
        require_once(ROOT . '/views/cabinet/viewOrder.php');
        return true;
    }
    
// отменить заказ
    public function actionOrderCancel($id, $page = 1)
    {        
        // Сохраняем изменения
        $status = '5';       
        Order::updateOrderById($id, $status);

        // Получаем данные о конкретном заказе
        $order = Order::getOrderById($id);

        // Получаем массив с идентификаторами и количеством товаров
        $productsQuantity = json_decode($order['products'], true);

        // Получаем массив с индентификаторами товаров
        $productsIds = array_keys($productsQuantity);

        // Получаем список товаров в заказе
        $products = Product::getProductByIDs($productsIds, $page);                         

        // для навигации
        $products_prise = Product::getProductsByIDsCheck($productsIds);
        $totalPrice = Order::getTotalPrice($products_prise, $productsQuantity);
        $total = count($productsIds);
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');
        // Подключаем вид
        require_once(ROOT . '/views/cabinet/viewOrder.php');
        return true; 
    }
//  возобновить заказ
    public function actionOrderRestart($id, $page = 1)
    {        
        // Сохраняем изменения
        $status = '0';       
        Order::updateOrderById($id, $status);

        // Получаем данные о конкретном заказе
        $order = Order::getOrderById($id);

        // Получаем массив с идентификаторами и количеством товаров
        $productsQuantity = json_decode($order['products'], true);

        // Получаем массив с индентификаторами товаров
        $productsIds = array_keys($productsQuantity);

        // Получаем список товаров в заказе
        $products = Product::getProductByIDs($productsIds, $page);                         


         // для навигации
        $products_prise = Product::getProductsByIDsCheck($productsIds);
        $totalPrice = Order::getTotalPrice($products_prise, $productsQuantity);
        $total = count($productsIds);
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');
        // Подключаем вид
        require_once(ROOT . '/views/cabinet/viewOrder.php');
        return true; 
    }


// СЧЕТ НА ОПЛАТУ
    public function actionPayment($id_order)
    {   

        $id = intval($id_order); 
        if ($id) {
        // Получаем данные о конкретном заказе
        $order = Order::getOrderById($id);
        // Получаем массив с идентификаторами и количеством товаров
        $productsQuantity = json_decode($order['products'], true);
        // Получаем массив с индентификаторами товаров
        $productsIds = array_keys($productsQuantity);
        // Получаем список товаров в заказе
        $products = Product::getProductsByIDsCheck($productsIds);       

        // 
     }
        // header("Location: /views/pdf/pdf.php");
        

        require_once(ROOT . '/views/payment/pdf/payment.php');
        // require_once(ROOT . '/views/payment/index.php');
        return true; 
    }
}





