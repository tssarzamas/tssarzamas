<?php

class Cart
{

  /* Добавление товара в корзину (сессию)  */
    public static function addProduct($id)
    {
        $id = intval($id);

        // Пустой массив для товаров в корзине
        $productsInCart = array();

        // Если в корзине уже есть товары (они хранятся в сессии)
        if (isset($_SESSION['products'])) {
            // То заполним наш массив товарами
            $productsInCart = $_SESSION['products'];
        }

        // Если товар есть в корзине, но был добавлен еще раз, увеличим количество
        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id] ++;
        } else {
            // Добавляем нового товара в корзину
            $productsInCart[$id] = 1;
        }

        $_SESSION['products'] = $productsInCart;

        return self::countItems();
    }

    /*
     * Подсчет количество товаров в корзине (в сессии)
     */
    public static function countItems()
    {
        if (isset($_SESSION['products'])) {
            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count = $count + $quantity;
            }
            return $count;
        } else {
            return 0;
        }
    }

//save in session product
    public static function getProducts()
    {
        if (isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return false;
    }
    
// итоговая стомость товаров в корзине
    public static function getTotalPrice($products)
    {
        // Получаем массив с идентификаторами и количеством товаров в корзине
        $productsInCart = self::getProducts();

        // Подсчитываем общую стоимость
        $total = 0;
        if ($productsInCart) {
            // Если в корзине не пусто
            // Проходим по переданному в метод массиву товаров
            foreach ($products as $item) {
                // Находим общую стоимость: цена товара * количество товара
                $total += $item['price'] * $productsInCart[$item['ID_product']];
            }
        }

        return $total;
    }

   
      public static function MinCart($id)
    {
        $id = intval($id);
        if (isset($_SESSION['products'])) {// Если в корзине уже есть товары (они хранятся в сессии)
            $productsInCart = $_SESSION['products'];// То заполним наш массив товарами
        }
    
        if (array_key_exists($id, $productsInCart)) {
            if ($productsInCart[$id]>=2) {               
               $productsInCart[$id]--;
           } 
        }
     
        $_SESSION['products'] = $productsInCart;

        return  $productsInCart[$id];
    }

     public static function PlusCart($id)
    {
        $id = intval($id);
        if (isset($_SESSION['products'])) {// Если в корзине уже есть товары (они хранятся в сессии)
            $productsInCart = $_SESSION['products'];// То заполним наш массив товарами
        }
    
        if (array_key_exists($id, $productsInCart)) {                        
               $productsInCart[$id]++;           
        } 

        $_SESSION['products'] = $productsInCart;

        return $productsInCart[$id];
    }

     public static function DelCart($id) 
     {
            $id = intval($id);
            if (isset($_SESSION['products'])) {// Если в корзине уже есть товары (они хранятся в сессии)
                $productsInCart = $_SESSION['products'];// То заполним наш массив товарами
            }
             if (array_key_exists($id, $productsInCart)) {                        
                unset($productsInCart[$id]);          
            }                         
            $_SESSION['products'] = $productsInCart;      
            
            return self::countItems();
     }


    public static function DeleteSessionProsucts()
    {
         if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
        }

    }
        


}