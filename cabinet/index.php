<?php include  ROOT . '/views/layouts/header.php'; ?>

<div class="content">       
<div class="center">          
<div class="post">			

<div class="container_area">
					
	<h2 class="title_area">Личный кабинет</h2>

	<div class="personal_area">
		<table>
			<tr>	
				<td>Имя: </td>
				<td class="left"><?php echo $user['name'];?></td>
			</tr>
			<tr>	
				<td>Логин: </td>
				<td class="left"><?php echo $user['email'];?></td>
			</tr>
			<tr>	
				<td>Адрес: </td>
				<td class="left"><?php echo $user['address'];?></td>
			</tr>
			<tr>	
				<td>Номер телефона: </td>
				<td class="left"><?php echo $user['phone'];?></td>
			</tr>

			<?php if ($user['rights']=="a"): ?>	
			<tr>
				<td>Ваш статус:</td>
				<td class="left">
					администатор
				</td>
			</tr>
		<?php endif; ?>
		
		</table>
	</div>

	<a href="/cabinet/edit/"><button class="personal_areabtn">Изменить персональные данные</button></a>
	<!-- <a href="/cart/"><button class="personal_areabtn">Корзина</button></a> -->
	<a href="history/<?php echo $user['ID_user'];?>"><button class="personal_areabtn">История заказов</button></a>

	<?php 
	if ($user['rights']=="a") {
		echo '<a href="/admin/"><button class="personal_areabtn">Админпанель</button></a>';
	} 
	?>	

<?php if ($user['rights']=="p"): ?>	
<div style="margin-top: 2%;">&nbsp;</div>
<?php endif; ?>
</div>



</div>
</div>
<div style="clear: both;">&nbsp;</div>
</div>

<?php include  ROOT . '/views/layouts/footer.php'; ?>

