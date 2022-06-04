<?php include ROOT . '/views/layouts/header.php';  ?>

<div class="content"><div class="center"><div class="post">
     
<div class="content_history">         
  <?php $number = 1;  ?>
        <a href="/cabinet/"><div class="btn_cancel">Вернуться в личный кабинет</div></a>
        <br>        
        <h3 class="title">История ваших заказов</h3>             
        <div class="history_text">     
            <p>Имя покупателя: <?php echo $user['name']; ?> </p>                            
            <p>Телефон покупателя: <?php echo $user['phone']; ?></p>
            <p>Электронная почта: <?php echo $user['email']; ?> </p>
        </div>
       
        <div class="history_order"> <!--start history_order -->
        <table>
                <th width="100px">№ заказа</th>                   
                <th>Дата оформления</th>
                <th>Статус</th>
                <th></th>
                <th></th>
                <th></th>        
              
                <?php foreach ($ordersList as $order): ?>               
                    <tr>
                        <td>
                            <a href="/cabinet/orderView/<?php echo $order['ID_order']; ?>">
                                <?php echo $order['ID_order']; ?>
                            </a>
                        </td>                                 

                        <td>
                            <?php 
                            $arr = ['января', 'февраля', 'марта', 'апреля', 'мая',  'июня', 'июля','августа', 'сентября','октября','ноября','декабря'];                    
                            $date = new DateTime($order['date_order']);
                            $m = $date->format('m'); 
                            $month = $m-1;                 
                            $format = $date->format('d '.$arr[$month].' Y  в G:i:s'); 
                            echo $format;                                     
                            ?>                            
                        </td>

                        <td><?php echo Order::getStatusText($order['status']); ?></td>

                        <td width="220px">
                            <?php if ($order['status'] == 1 || $order['status'] == 2 || $order['status'] == 3): ?>
                               <a href="/cabinet/payment/<?php echo $order['ID_order'];?>" target='_blank' class='payment_check'> Счет на оплату <i class="fa fa-download"></i></a>
                            <?php endif; ?>                            
                        </td>
                        <td>
                            <a href="/cabinet/orderView/<?php echo $order['ID_order']; ?>" title="Просмотр заказа">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>                     
                        <td>
                            <?php  if ($order['status']==0 || $order['status']==1): ?>
                            <a href="/cabinet/orderCancel/<?php echo $order['ID_order']; ?>" title="Отменить заказ">
                                <i class="fa fa-times"></i>
                            </a>
                            <?php elseif ($order['status']==5): ?>
                            <a href="/cabinet/orderRestart/<?php echo $order['ID_order']; ?>" title="Возобновить заказ">
                            <i class="fa fa-plus"></i>
                            </a> 
                            <?php  endif; ?>
                        </td>                        
                    </tr>
            <?php endforeach; ?>
        </table>
        <div class="get_pagination">
        <?php echo $pagination->get(); ?>           
        </div>          
        </div> <!-- end history_order -->

</div> <!-- end content_history --> 

<?php if (count($ordersList)<=2): ?>
<div style="margin-top: 80px;"></div>       
<?php endif; ?>

</div></div><div style="clear: both;">&nbsp;</div></div>

<?php include  ROOT . '/views/layouts/footer.php'; ?>


