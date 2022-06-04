<?php include  ROOT . '/views/layouts/header.php'; ?>


<div class="content">       
<div class="center">          
<div class="post">					


<div class="container_area">
					
	<h2 class="title_area">Редактировать данные</h2>

	
	<div class="personal_area">
		<form action="#" method="post">			

		<div class="form_text_edit">
			<p><b> Имя: </b></p>
			<input type="text" name="name" class="psw_form_edit" placeholder="ФИО" value="<?php echo $user['name'];?>">
		</div>
		<div class="form_text_edit">
			<p><b>Адрес: </b></p>
			<input type="text" name="address" class="psw_form_edit" placeholder="Город, улица, дом, квартира" value="<?php echo $user['address'];?>">
		</div>
		<div class="form_text_edit">
			<p><b>Номер телефона: </b></p>
			<input type="text" name="phone" id="phone" class="psw_form_edit" placeholder="89101300203" value="<?php echo $user['phone'];?>">
<script>
$(function(){
  $("#phone").mask("8 (999) 999 99 99");
});
</script>		

</div>


	<!-- вывод ошибок -->
		<?php if (isset($errors) && is_array($errors)): ?>
			<ul id="message">
				<?php foreach ($errors as $error): ?>
				<li> <?php echo $error; ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	<!-- конец вывода ошибок -->
		<input type="submit" name="submit" value="Сохранить" class="personal_areabtn">

		</form>

		<a href="/cabinet/"><button class="personal_areabtn">Вернуться к личному кабинету</button></a>
	</div>

</div>


<div style="margin-top: 0%;"></div>


</div>
</div>
<div style="clear: both;">&nbsp;</div>
</div>



<?php include  ROOT . '/views/layouts/footer.php'; ?>