<?php include  ROOT . '/views/layouts/header.php'; ?>

<div class="content">				
<div class="center">					
<div class="post">
	

<div class="content-page"> <!-- content-page -->
<div class="content-page__body"> <!-- content-page__body -->
<div class="menu-page"> <!-- menu-page -->
<div>
<div class="moduletable">  <!-- moduletable -->

<ul>
    
    <li class="deeper parent lil1"> <!-- deeper parent lil1 -->
       

    <a href='/catalog/<?php echo $id_cat; ?>'>
	<?php echo $category_name; ?>
	</a>  
            
		<ul>  <!-- ul subcategory -->

		<?php foreach ($ProductSubcategories as $productSubcategoriesItem): ?>
			<?php 
			$type = Product::getProductView($productSubcategoriesItem['ID_category'], $productSubcategoriesItem['ID_type']);
			$count = count($type);
			if ($count != 0):
			?>

			<li class="lil2">			
			<a href='/catalog/<?php echo $id_cat;?>/<?php echo $productSubcategoriesItem['ID_type']; ?>'>

			<img src="<?php	echo Product::getImage($productSubcategoriesItem['ID_type']);?>" >

		   	<span class="image-title"><?php echo $productSubcategoriesItem['Naimenovanie_type']; ?></span>

			</a>
			</li>
			<?php  endif; ?>
		<?php endforeach;?>			
		</ul>  <!--end ul subcategory --> 
   

	</li> <!-- end deeper parent lil1 -->
	  
</ul>
<a href="/catalog/"><div class="back">Вернуться назад</div></a>

</div>  <!-- end moduletable -->
</div>
</div> <!-- end menu-page -->
</div> <!-- end content-page__body -->
</div> <!-- end content-page -->

<div style="height: 35%;"></div>

</div></div><div style="clear: both;">&nbsp;</div></div>					



<?php include  ROOT . '/views/layouts/footer.php'; ?>