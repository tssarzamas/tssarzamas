<?php include ROOT . '/views/layouts/header_admin.php';  ?>

<div class="content">               
    <div class="center">                    
        <div class="post">
     
            <div class="header_admin"><b><font class="active_link">Информация о заказах</font></b></div>
            
            <br>
            

            <a href='/admin/orders/deleteOrdersYears'>
                <div class="adminbtn"> <i class="fa fa-times"></i> 
                    Удалить все заказы давностью более 3х лет
                </div>
            </a>

            <br>           

            <div class="d1">
              <form action="#" method="post" >
              <input type="text" placeholder="Введите ID_заказа..." name="order_id">
              <button type="submit" name="search"><i class="fa fa-search"></i></button>
              </form>
            </div>
           

            <br><br>
            

            <div>         
            <table>

                <th width="100px">ID заказа</th>
                <th>Имя покупателя</th>                
                <th>Телефон покупателя</th>
                <th>Дата оформления</th>
                <th>Статус</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>                   

               
                <?php foreach ($ordersList as $order): ?>  
                    <tr>
                        <td>
                            <a href="/admin/order/view/<?php echo $order['ID_order']; ?>">
                                <?php echo $order['ID_order']; ?>
                            </a>
                        </td>

                        <?php $UserByID = User::getUserById($order['ID_user']); ?>
                        <td><?php echo $UserByID['name']; ?></td>
                        <td><?php echo $UserByID['phone']; ?></td>                    
                        

                        <td>
                            <?php                                 
                            $date = new DateTime($order['date_order']);              
                            $format = $date->format('d.m.Y  в G:i:s'); 
                            echo $format;                                     
                            ?>      
                        </td>

                        <td><?php echo Order::getStatusText($order['status']); ?></td>


                        <td>
                            <a href="/admin/orders/view/<?php echo $order['ID_order']; ?>" title="Смотреть">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>

                        <td>
                            <a href="/admin/orders/updateOrders/<?php echo $order['ID_order']; ?>" title="Редактировать">
                                <i class="fa fa-pencil-square-o"></i>
                            </a>
                        </td>
                        
                        <td>
                            <a href="/admin/orders/deleteOrders/<?php echo $order['ID_order']; ?>" title="Удалить">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>

                         <td>
                            <a href="/admin/orders/downloadOrders/<?php echo $order['ID_order']; ?>" title="Скачать ведомость" target="_blank">
                                <i class="fa fa-download"></i>
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>

            </table>
            </div>


<div class="get_pagination">
<?php echo $pagination->get(); ?>           
</div>    



<div style="clear: both;">&nbsp;</div>
</div></div></div>


