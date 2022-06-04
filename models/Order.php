<?php

class Order
{
    const SHOW_BY_DEFAULT = 10;

    public static function save($userId, $products) {
        
        $db = Db::getConnection();
               
        // $date_order='';
        $status='0';

        // echo "$name <br> $email <br> $password - $pass <br> rights - $rights <br> $address";

        $sql = "INSERT INTO orders (products, ID_user, status) VALUES (:products, :ID_user, :status)";
        
        $result = $db->prepare($sql);
        $result->bindParam(':products', $products, PDO::PARAM_STR);
        // $result->bindParam(':date_order', $date_order, PDO::PARAM_STR);
        $result->bindParam(':ID_user', $userId, PDO::PARAM_STR);        
        $result->bindParam(':status', $status, PDO::PARAM_STR);
         
        $result->execute();
        $id_order = $db->lastInsertId();
       
        return $id_order;
        
    }
     public static function getAllOrders()
    {   

      
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT * FROM orders');
        $AllOrders = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $AllOrders[$i]['ID_order'] = $row['ID_order'];
            $AllOrders[$i]['date_order'] = $row['date_order'];
            $AllOrders[$i]['ID_user'] = $row['ID_user'];
            $AllOrders[$i]['status'] = $row['status'];
            $i++;
        }
        return $AllOrders;
    }

    /* Возвращает список заказов со страничной навигацией */
    public static function getOrdersList($page)
    {   

        $limit = Order::SHOW_BY_DEFAULT;
        // Смещение (для запроса)
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT ID_order, date_order, ID_user,  status 
            FROM orders ORDER BY (date_order)  DESC LIMIT '.self::SHOW_BY_DEFAULT. ' OFFSET '.$offset);
        $ordersList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $ordersList[$i]['ID_order'] = $row['ID_order'];
            $ordersList[$i]['date_order'] = $row['date_order'];
            $ordersList[$i]['ID_user'] = $row['ID_user'];
            $ordersList[$i]['status'] = $row['status'];
            $i++;
        }
        return $ordersList;
    }

    /*
     * Возвращает текстое пояснение статуса для заказа :
     */
    public static function getStatusText($status)
    {
        switch ($status) {
            case '0':
                return 'Новый заказ';
                break;
            case '1':
                return 'Одобрено администратором';
                break;
            case '2':
                return 'В обработке';
                break;
            case '3':
                return 'Закрыт';
                break;
            case '4':
                return 'Отказано в исполнении';
                break;
            case '5':
                return 'Отменено пользователем';
                break;
        }
    }

    /* Возвращает заказ с указанным id  */
    public static function getOrderById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM orders WHERE ID_order = :ID_order';

        $result = $db->prepare($sql);
        $result->bindParam(':ID_order', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполняем запрос
        $result->execute();

        // Возвращаем данные
        return $result->fetch();
    }

    /**
     * Удаляет заказ с заданным id
     */
    public static function deleteOrderById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM orders WHERE ID_order = :ID_order';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':ID_order', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /*
     * Редактирует заказ с заданным id
     */
    public static function updateOrderById($id, $status)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE orders
            SET                 
                status = :status 
            WHERE ID_order = :ID_order";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':ID_order', $id, PDO::PARAM_INT);
        // $result->bindParam(':ID_user', $userName, PDO::PARAM_STR);
        // $result->bindParam(':date_order', $date, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_STR);
        return $result->execute();
    }


     public static function deleteOrdersYears($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM orders WHERE ID_order = :ID_order';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':ID_order', $id, PDO::PARAM_INT);
        return $result->execute();
    }



    public static function getOrderListByIdUser($id, $page)
    {
        $limit = Order::SHOW_BY_DEFAULT;
        // Смещение (для запроса)
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

       // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT * FROM orders 
            WHERE ID_user ='.$id.
            ' ORDER BY date_order DESC LIMIT '.self::SHOW_BY_DEFAULT.
            ' OFFSET '.$offset);
       
        $ordersListByIdUser = array();
        $i = 0;

        while ($row = $result->fetch()) {
            $ordersListByIdUser[$i]['ID_order'] = $row['ID_order'];
            $ordersListByIdUser[$i]['date_order'] = $row['date_order'];
            $ordersListByIdUser[$i]['products'] = $row['products'];
            $ordersListByIdUser[$i]['ID_user'] = $row['ID_user'];
            $ordersListByIdUser[$i]['status'] = $row['status'];
            $i++;
        }
        return $ordersListByIdUser;
     
    }


    

    // количество заказов конкретного пользователя
     public static function getOrderCountUser($id)
    {
       
        $db = Db::getConnection();

        $result = $db->query('SELECT * FROM orders
            WHERE ID_user ='.$id.' ORDER BY date_order DESC');
       
        $ordersCountUser = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $ordersCountUser[$i]['ID_order'] = $row['ID_order'];
            $ordersCountUser[$i]['date_order'] = $row['date_order'];
            $ordersCountUser[$i]['products'] = $row['products'];
            $ordersCountUser[$i]['ID_user'] = $row['ID_user'];
            $ordersCountUser[$i]['status'] = $row['status'];
            $i++;
        }
        return $ordersCountUser;
    }
        

    /* Возвращает количество всех заказов  */
    public static function getOrdersCount()
    {   
      
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT * FROM orders');
        $ordersList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $ordersList[$i]['ID_order'] = $row['ID_order'];
            $ordersList[$i]['date_order'] = $row['date_order'];
            $ordersList[$i]['ID_user'] = $row['ID_user'];
            $ordersList[$i]['status'] = $row['status'];
            $i++;
        }
        $total = count($ordersList);
        
        return $total;
    }


    // итоговая стомость товаров в заказе
    public static function getTotalPrice($products, $productsQuantity)
    {
        // Подсчитываем общую стоимость
        $total = 0;
        foreach ($products as $item) {
            // Находим общую стоимость: цена товара * количество товара
            $total += $item['price'] * $productsQuantity[$item['ID_product']];
        }
        return $total;
    }

      // итоговое количество товаров в заказе
    public static function getTotalCount($productsQuantity)
    {
        // Подсчитываем общую стоимость
        $total = 0;
        foreach ($productsQuantity as $item) {
            // Находим общую стоимость: цена товара * количество товара
            $total = $total + $item;
        }
        return $total;
    }


    // перевод суммы в пропись

   public static function number2string($num) 
{    
   $nul='ноль';
    $ten=array(
        array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'),
        array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'),
    );
    $a20=array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
    $tens=array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
    $hundred=array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
    $unit=array( // Units
        array('копейка' ,'копейки' ,'копеек',    1),
        array('рубль'   ,'рубля'   ,'рублей'    ,0),
        array('тысяча'  ,'тысячи'  ,'тысяч'     ,1),
        array('миллион' ,'миллиона','миллионов' ,0),
        array('миллиард','милиарда','миллиардов',0),
    );
    //
    list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
    $out = array();
    if (intval($rub)>0) {
        foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
            if (!intval($v)) continue;
            $uk = sizeof($unit)-$uk-1; // unit key
            $gender = $unit[$uk][3];
            list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
            // mega-logic
            $out[] = $hundred[$i1]; # 1xx-9xx
            if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
            else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
            // units without rub & kop
            if ($uk>1) $out[]= self::morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
        } //foreach
    }
    else $out[] = $nul;
    $out[] = self::morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
    $out[] = $kop.' '.self::morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
    return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
}

    /**
     * Склоняем словоформу
     * @ author runcore
     */
    public static function morph($n, $f1, $f2, $f5) {
        $n = abs(intval($n)) % 100;
        if ($n>10 && $n<20) return $f5;
        $n = $n % 10;
        if ($n>1 && $n<5) return $f2;
        if ($n==1) return $f1;
        return $f5;
    }


}