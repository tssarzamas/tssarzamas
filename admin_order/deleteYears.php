<?php include ROOT . '/views/layouts/header_admin.php';  ?>

<div class="content">               
    <div class="center">                    
        <div class="post">
            <div class="header_admin"><b><a href="/admin/orders">Информация о заказах</a></b></div>
            
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
            <p>Удалить заказы давностью более 3х лет?</p>
            <p>Количество удаляемых заказов:  <?php echo $count_order_delete; ?></p>

            </div>            
            <br/>
            <input type="submit" name="submit" class="adminbtn" value="Удалить">
            <br/>
            </form>       
           
<div style="clear: both;">&nbsp;</div>
</div></div></div>


   

   



