<?php
// require_once ROOT. 'components/Pagination.php'
/**
 * Контроллер AdminOrderController
 * Управление заказами в админпанели
 */
class AdminOrderController extends AdminBase
{

    /**
     * Action для страницы "Управление заказами"
     */
    public function actionIndex($page = 1)
    {   
        // echo "page = $page";
        // Проверка доступа
        self::checkAdmin();

        // Получаем список заказов
        $ordersList = Order::getOrdersList($page);

        // Общее количетсво товаров (необходимо для постраничной навигации)
        $total = Order::getOrdersCount();

        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Order::SHOW_BY_DEFAULT, 'page-');
               
        if (isset($_POST['search']) && $_POST['order_id']!=null) {

            $id = $_POST['order_id'];
            $page = 1;
            // Проверка доступа
            self::checkAdmin();

            // Получаем данные о конкретном заказе
            $order = Order::getOrderById($id);

            if ($order) {

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
            header("Location: /admin/orders/view/$id"); 
            }      
        } 


        // Подключаем вид
        require_once(ROOT . '/views/admin_order/index.php');
        return true;
    }

    /**
     * Action для страницы "Редактирование заказа"
     */
    public function actionUpdateOrders($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем данные о конкретном заказе
        $order = Order::getOrderById($id);
        $UserByID = User::getUserById($order['ID_user']);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена   
            // Получаем данные из формы
           
            $status = $_POST['status'];

            // Сохраняем изменения
            Order::updateOrderById($id, $status);

            // Перенаправляем пользователя на страницу управлениями заказами
            header("Location: /admin/orders/view/$id");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_order/update.php');
        return true;
    }

    /**
     * Action для страницы "Просмотр заказа"
     */
    public function actionView($id, $page = 1)
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем данные о конкретном заказе
        $order = Order::getOrderById($id);

        // Получаем массив с идентификаторами и количеством товаров
        $productsQuantity = json_decode($order['products'], true);

        // Получаем массив с индентификаторами товаров
        $productsIds = array_keys($productsQuantity);

        // количество товаров в заказе
        $totalCount = Order::getTotalCount($productsQuantity);

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
        require_once(ROOT . '/views/admin_order/view.php');
        return true;
    }

    /**
     * Action для страницы "Удалить заказ"
     */
    public function actionDeleteOrders($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем данные о конкретном заказе
        $order = Order::getOrderById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем заказ
            Order::deleteOrderById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/orders");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_order/delete.php');
        return true;
    }

   
   public function actionDeleteOrdersYears()
    {
      // Проверка доступа
        self::checkAdmin();


        $ordersList = Order::getAllOrders();        
        $count_order_delete = 0;
        $date1 = date('Y-m-d h:i:s');
        $first = new DateTime($date1);
        
        foreach ($ordersList as $order) {        
        $second = new DateTime($order['date_order']);
        $diff = $first->diff($second);
        $week = $diff->format('%a') / 7 ; 
        if ($week>=144) { $count_order_delete++;} 
        }


        // Обработка формы
        if (isset($_POST['submit'])) {       
        
        $date1 = date('Y-m-d h:i:s');
        $first = new DateTime($date1);
        
        foreach ($ordersList as $order) {
        
        $second = new DateTime($order['date_order']);
        $diff = $first->diff($second);
        $week = $diff->format('%a') / 7 ; 

        if ($week>=144) {
        $count_order_delete++;
        Order::deleteOrdersYears($order['ID_order']);         
            
        } 
        
        }

        }

        require_once(ROOT . '/views/admin_order/deleteYears.php');
        return true;
    }


    /**
     * Action для страницы "Просмотр заказа"
     */
    public function actionDownloadOrders($id)
    {   

        $id = intval($id); 
        if ($id) {
        // Получаем данные о конкретном заказе
        $order = Order::getOrderById($id);
        // Получаем массив с идентификаторами и количеством товаров
        $productsQuantity = json_decode($order['products'], true);
        // Получаем массив с индентификаторами товаров
        $productsIds = array_keys($productsQuantity);
        // Получаем список товаров в заказе
        $products = Product::getProductsByIDsCheck($productsIds);

        // header('Location: /views/admin_order/statement/statement.php');     
        }        

        require_once(ROOT . '/views/admin_order/statement/statement.php');
        return true; 
    }

}
