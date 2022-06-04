<?php include ROOT . '/views/layouts/header.php';  ?>

<div class="content">               
<div class="center">                    
<div class="post">    
     

    <a href="/cabinet/history/<?php echo $order['ID_user']; ?>">
        <div class="btn_cancel">Вернуться к истории заказов</div>
    </a>


<br>

<h3 class="title">Информация о заказе №<?php echo $order['ID_order']; ?></h3>          
        
<div class="history_text">  <!-- start history text -->     

        <?php $user = User::getUserById($order['ID_user']);  ?>

        <p>Имя покупателя: <?php echo $user['name']; ?> </p>                            
        <p>Телефон покупателя: <?php echo $user['phone']; ?></p>
        <p>Электронная почта: <?php echo $user['email']; ?> </p>
        <p><b>Дата заказа:</b>
             <?php 
                    $arr = ['января', 'февраля', 'марта', 'апреля', 'мая',  'июня', 'июля','августа', 'сентября','октября','ноября','декабря'];                  

                    $date = new DateTime($order['date_order']);
                    $m = $date->format('m'); 
                    $month = $m-1;                 

                    $format = $date->format('d '.$arr[$month].' Y  в G:i:s'); 
                    echo $format;                                     
                    ?> 
        </p>
        <p><b>Статус заказа:</b> <?php echo Order::getStatusText($order['status']); ?></p>

        <?php if ($order['status']==5): ?>
        <br>      
        <a href="/cabinet/orderRestart/<?php echo $order['ID_order']; ?>">
                <div class="btn_cancel">Возобновить заказ</div>
        </a>        
        <?php  elseif ($order['status']==0 || $order['status']==1): ?>
        <br>
        <a href="/cabinet/orderCancel/<?php echo $order['ID_order']; ?>">
                <div class="btn_cancel" title="Вы можете отменить заказ до тех пока вы его не оплатили">Отменить заказ</div>
        </a>
        <?php  else: ?>
        <?php  endif; ?>
</div>    <!-- ehd history text -->        

<div class="products_in_order">   <!-- start products_in_order -->       
    <?php $number = 1; ?>
    <h3 class="title">Товары в заказе</h3>
    <br><br>
    <div class="history_order">  <!-- start history_order --> 
            <table>
                <tr >
                    <th width="80px" style="text-align: center;">ID товара</th>
                    <th width="60px" ></th>
                    <th>Модель</th>

                    <th width="100px">Совместимость</th>
                    <th width="100px">Производитель</th>
                    <th width="100px">Дата производства</th>
                    <th>Цена за шт.</th>
                    <th width="100px">Количество</th>
                </tr>
               
                <?php foreach ($products as $product): ?>
                        <tr>
                        <td><?php echo $product['ID_product'];  ?></td>
                        <td><img src='<?php echo Product::getImage($product["ID_type"]); ?>' height='50px'></td>
                        <td><?php echo $product['model']; ?></td>
                        <td><?php echo $product['sovmes']; ?></td>
                        <td><?php echo $product['sovmes']; ?></td>
                        <td><?php echo $product['datap']; ?></td>
                                      
                        <td>
                        <?php echo $product['price']; ?> руб.
                        </td>                
                        <td>
                        <?php echo $productsQuantity[$product['ID_product']]; ?>
                        </td>
                        </tr>
                <?php endforeach; ?>       
            </table>
    </div> <!-- end history_order --> 

    <div class="itog_order_text">
        <b>
        <p>Общее кол-во продукции: <?php echo $total;?> </p>
        <p>Итоговая стоимость заказа: <?php echo  $totalPrice; ?> руб.</p>
        </b>
    </div>        
   
<div class="get_pagination">
    <?php echo $pagination->get(); ?>           
</div>   


</div>  <!-- end products_in_order -->
             

<?php if ($total >= 18): ?>
<a href="/cabinet/history/<?php echo $order['ID_user']; ?>">
    <div class="btn_cancel">Вернуться к истории заказов</div>
</a>
<?php  endif; ?>

</div></div> <div style="clear: both;">&nbsp;</div> </div>

<?php include  ROOT . '/views/layouts/footer.php'; ?>