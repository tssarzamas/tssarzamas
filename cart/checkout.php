<?php include ROOT . '/views/layouts/header.php'; ?>


<div class="content"><div class="center"><div class="post">
<div style="margin-top: 5%;"></div>

<div>


<!-- result -->
<?php if ($result): ?>
	<div style="margin-top: 21%;"></div>
	<h2 class="title" align='center'>Заказ оформлен. Мы Вам перезвоним. Перейти к <a href="/cabinet/">личному кабинету</a></h2>
	<div style="margin-top: 21%;"></div>
<?php else: ?>	


<h2 class="title" align='center'>Для оформления заказа Потвердите ваши данные. Наш менеджер свяжется с Вами.</h2>
<br>
<p align='center'>Выбрано товаров: <?php echo $totalQuantity; ?>, на сумму: <?php echo $totalPrice; ?> руб.</p><br/>	
	<!-- errors -->
	<div>
		<?php if (isset($errors) && is_array($errors)): ?>
             <ul>
                <?php foreach ($errors as $error): ?>
                    <li> - <?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
	</div>


	<form action="#" method="post" align='center'>	
		<p class='checkout_text' ><b>Имя</b>: <?php echo $userName; ?></p>
		<p class='checkout_text' ><b>Телефон:</b> <?php echo $userPhone; ?></p>
		<p class='checkout_text' ><b>Адрес:</b> <?php echo $userAddress; ?></p>
		<br><br>
		<input type="submit" name="submit" class="confirm_order_btn" value="Оформить заказ" >
		
		<a href="/cabinet/edit/"><input type="button"  class="confirm_order_btn"   value="Изменить данные"></a>	
	</form>

<br>

<a href="/cart/"><font class="back_to_cart"> Вернуться к корзине</font></a>

<?php endif; ?>
</div>

<div style="margin-top: 11%;"></div>


</div></div></div>
<?php include  ROOT . '/views/layouts/footer.php'; ?>