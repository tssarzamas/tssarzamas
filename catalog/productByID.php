<?php
include ROOT . '/views/layouts/header.php';
 ?>


<div class="content"><div class="center"><div class="post">
	<h3 class="product_title" >
		<!--  категория -->
		<a href='/catalog/<?php echo $id_cat; ?>'>
			<?php echo $category_name; ?>
		</a>
		> 
		<a href='/catalog/<?php echo $id_cat;?>/<?php echo $id_type;?>'> 
			<?php echo $subcategory_name; ?>
		</a>
		> 	
		<!--  конкретный продукт -->
		<a href='/catalog/<?php echo $id_cat;?>/<?php echo $id_type;?>/<?php echo $id;?>'>
			<?php echo $ProductItem['model']; ?>
		</a>
	</h3>


	

	<div class="product_area"> <!-- start product area -->

		<div class="product_image">
			<img src="<?php echo Product::getImage($id_type);?>"  height='350px'>
		</div>


	<div class="block_efg"> <!-- start block_efg -->

	    <div class="extra_fields_group"></div>

	     <div class="extra_fields_el">
		   <span class="extra_fields_name">Модель</span>                                                                       
		   <span class="extra_fields_value"><?php echo $ProductItem['model']; ?></span>
	    </div>

	    <div class="extra_fields_el">
		   <span class="extra_fields_name">Совместимость</span>                                                                    
		   <span class="extra_fields_value"><?php echo $ProductItem['sovmes'] ; ?></span>
	    </div>

	     <div class="extra_fields_el">
		   <span class="extra_fields_name">Производитель</span>                                                             
		   <span class="extra_fields_value"><?php echo $ProductItem['proizv'] ; ?></span>
	    </div>
	                                    
	    <div class="extra_fields_el">
		   <span class="extra_fields_name">Дата производства</span>                                                                   
		   <span class="extra_fields_value"><?php echo $ProductItem['datap'] ; ?></span>
	    </div>
            <div class="extra_fields_el">
		   <span class="extra_fields_name">Информация</span>                                                               
		   <span class="extra_fields_value"><?php echo $ProductItem['info'] ; ?></span>
	    </div>

	<div class="flex_byId"> <!--  start flex_byId -->
		<a href="#">
			<div class="byId_corzina add-to-cart" data-id="<?php echo $id; ?>" >
			<i class="fa fa-shopping-cart"></i> В корзину
			</div>
		</a>
		<div style="margin-top: 10px;"></div>  	
	</div><!--  flex_byId -->


	</div><!-- end block_efg -->	
	</div><!-- end product area -->

	<div style="height: 9%;"></div>
	


</div></div><div style="clear: both;">&nbsp;</div></div>

<?php include  ROOT . '/views/layouts/footer.php'; ?>