<?php include ROOT . '/views/layouts/header_admin.php';  ?>

<div class="content">               
    <div class="center">                    
        <div class="post">
            <div class="header_admin"><b><a href="/admin">Админ-панель</a></b></div>
            
            <div class="header_panel">
                <b>Удалить данный заказ или 
                    <a href="/admin/orders">
                        <ins>вернуться назад</ins>
                    </a>
                </b>
            </div>
            
            <hr>
         
            <form action="#" method="post" enctype="multipart/form-data">
            
            <div class="text_delete">
            <p>Удалить заказ №<?php echo $id. ' от '.$order['date_order']; ?></p>

           
            
            <br/>
            <p>Вы действительно хотите удалить этот заказ?</p>

            <?php 
            $date1 = date('Y-m-d h:i:s');
            $first = new DateTime($date1);
            $second = new DateTime($order['date_order']);
            $diff = $first->diff($second);
            $week = $diff->format('%a') / 7 ;                         
            // echo '<br>'.floor($week).'week';                    
            if ($week <= 144): // 3 года - 144 недели
            ?> 

            <br>
            <p>Этот заказ не достаточно стар для удаления. С даты оформления прошло НЕ более 3х лет</p>

            <?php else: ?>
            <br>
            <p>С даты оформления прошло более 3х лет</p>
            
            <?php endif; ?> 

            </div>            
            <br/>
            <input type="submit" name="submit" class="adminbtn" value="Удалить">
            <br/>
            </form>       
           
<div style="clear: both;">&nbsp;</div>
</div></div></div>


   

   



