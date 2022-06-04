<?php include ROOT . '/views/layouts/header.php';  ?>

<div class="content">				
<div class="center">					
<div class="post">

			<h3 class="product_title">
				<a href='/catalog/<?php echo $id_cat; ?>'>
				<?php echo $category_name; ?>
				</a>
				 > 

				<a href='/catalog/<?php echo $id_cat;?>/<?php echo $id_type;?>'> 
					<?php echo $subcategory_name; ?>
				</a>
			</h3>
			<br>
			<!-- таблицу отсюда начинать -->						
		
			<div class="catalog_products">
			<table>
			<th>

			<td>Модель</td>
			<td>Совместимость</td>
			<td>Производитель</td>
			<td>Дата производства</td>
			<td>Цена, шт</td>
			<td></td>
										
			</th>
			<?php foreach ($ProductView as $ViewItem): ?>
				
				<tr>
					<td width="20px">
						<img src="<?php	echo Product::getImage($id_type);?>" height='60px'>
					</td>

					<td><a href='/catalog/<?php echo $id_cat;?>/<?php echo $id_type;?>/<?php echo $ViewItem['ID_product']; ?>'><?php echo $ViewItem['model']; ?></a></td>
					<td><?php echo $ViewItem['sovmes']; ?></td>
					<td><?php echo $ViewItem['proizv']; ?></td>
					<td><?php echo $ViewItem['datap']; ?></td>
					<td><?php echo $ViewItem['price']; ?> руб.</td>
					<td>
						<div class="corzina add-to-cart" data-id="<?php echo $ViewItem['ID_product']; ?>">
							<a href="#" ><i class="fa fa-shopping-cart"></i> В корзину</a>
						</div>
					</td>												
				
				</tr>

			<?php endforeach;?>			

			</table>
			</div>
		
<a href="/catalog/<?php echo $id_cat; ?>"><div class="back">Вернуться назад</div></a>

<?php if(count($ProductView) <= 3):?>
<div style="margin-top: 16%;">&nbsp;</div>
<?php endif; ?>


</div></div><div style="clear: both;">&nbsp;</div></div>

<?php include  ROOT . '/views/layouts/footer.php'; ?>