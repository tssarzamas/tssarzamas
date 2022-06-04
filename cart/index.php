<?php
include ROOT . '/views/layouts/header.php';
 ?>

<div class="content">				
	<div class="center">					
		<div class="post">

			<h3 class="title">Вы добавили в корзину следующие товары: </h3>
			<br>
			<!-- таблицу отсюда начинать -->

			<?php if ($productsInCart):?>
			
			<div class="cart">
			<table id="table_cart">
			<th>
			<td>Модель</td>
			<td>Совместимость</td>
			<td>Производитель</td>
			<td>Дата производства</td>
			<td>Цена, шт</td>
			<td>Количество, шт</td>
			<td></td>
									
			</th>
			<?php foreach ($products as $product): ?>
				
				<tr id="cart_info_<?php echo $product['ID_product']; ?>">

					<td width="20px">
						<img src="<?php echo Product::getImage($product['ID_type']); ?>" height='60px'>
					</td> 

					<td><a href='/catalog/<?php echo $product['ID_product'];?>/<?php echo $product['ID_type'];?>/<?php echo $product['ID_product']; ?>'><?php echo $product['model']; ?></a></td>
					<td><?php echo $product['sovmes']; ?></td>
					<td><?php echo $product['proizv']; ?></td>
					<td><?php echo $product['datap']; ?></td>	
					<td><?php echo $product['price']; ?></td>				
					
					<td>				
						<div class="quantity">							
							<button  class="minus-btn" del-id="<?php echo $product['ID_product'];?>">-</button>
							
							<span id="num_count_<?php echo $product['ID_product'];?>" class="num_count">
								<?php echo $productsInCart[$product['ID_product']];?>
							</span> 
							
							<button class="plus-btn" plus-id="<?php echo $product['ID_product']; ?>" >+</button>				      
						</div>	
					</td>
					<td>
						<button class="delite-btn" delite-id="<?php echo $product['ID_product']; ?>">
						Удалить
						</button>
					</td>															
				
				</tr>

			<?php endforeach;?>			
			 
			</table>
			</div> <!-- конец таблицы корзины -->

			<div class="cart_total">
				Общая стоимость: 
				<!-- --><span id='total_price'> <?php echo $totalPrice?></span>
			</div>



			<div style="display: flex; justify-content: space-between; font-family: 'Bellota', cursive;">			
			<?php if (User::isGuest()): ?>					
			<div class="cart_link">Чтобы оформить заказ, <a href="/user/login" >войдите в личный кабинет</a></div>				
			<?php else: ?>					
			<a href="/cart/checkout/"><div class="checkout">Оформить заказ</div></a>			
			<?php endif; ?>	

			<div class="back deleteSession"><a href="#">Удалить все товары</a></div>
			
			</div>	

			<div class="get_pagination">
			<?php echo $pagination->get(); ?>           
			</div>   

			

			<?php if ($total>=6): ?>					
				<div style="height: 10px;"></div>	
			<?php else: ?>					
				<div style="height: 80px;"></div>
			<?php endif; ?>	


			<?php else: ?>
				<h3 class="title">Ваша корзина пуста</h3>
				<br>
				<h3 class="title"><a href="/catalog/">Перейти к каталогу продукции</a></h3>
				<div style="margin-top: 26%;"></div>
			<?php endif ?>
		

</div></div><div style="clear: both;">&nbsp;</div></div>



<?php include  ROOT . '/views/layouts/footer.php'; ?>

