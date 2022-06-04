<?php include ROOT . '/views/layouts/header_admin.php';  ?>


<div class="content">				
	<div class="center">					
		<div class="post">

		<div class="admin_index">
				
			<div class="header_admin"><b><font class="active_link">Админ-панель</font></b></div>			
			<br>
			
			 
			<div class="button">
				<a href='/admin/category'><div class="adminbtn">Управление продукцией</div></a>
				<br>
				<a href='/admin/orders'><div class="adminbtn">Управление заказами</div></a>
			</div>


			<div class="table_search" align="right">
			<table>
				<tr>
					<td><div>Поиск продукции по ID</div></td>
					<td>
						<div class="d2">
			              <form action="#" method="post" >
			              <input type="text" placeholder="Введите ID_изделия..." name="product_id">
			              <button type="submit" name="search_product"><i class="fa fa-search"></i></button>
			              </form>
            			</div>
					</td>
				</tr>

				<tr>
					<td><div>Поиск заказа по ID</div></td>
					<td>
						<div class="d1">
			              <form action="#" method="post" >
			              <input type="text" placeholder="Введите ID_заказа..." name="order_id">
			              <button type="submit" name="search_order"><i class="fa fa-search"></i></button>
			              </form>
            			</div>						
					</td>
				</tr>
			</table>
			</div>


		</div>	
		



</div></div></div>





