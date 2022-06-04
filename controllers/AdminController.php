<?php

/**
 * Контроллер AdminController
 * Главная страница в админпанели
 */
class AdminController extends AdminBase
{
    /**
     * Action для стартовой страницы "Панель администратора"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        if (isset($_POST['search_order']) && $_POST['order_id']!=null) {

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

         if (isset($_POST['search_product']) && $_POST['product_id']!=null) {

            $id = $_POST['product_id'];
            // Проверка доступа
            self::checkAdmin();
            // Получаем данные о конкретном заказе
            $product = Product::searchProducts($id);

            if ($product) {           

            // Подключаем вид
            header("Location: /admin/$id"); 
            }      
        } 


        // Подключаем вид
        require_once(ROOT . '/views/admin/index.php');
        return true;
    }

}



