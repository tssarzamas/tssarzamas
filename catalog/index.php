<?php include ROOT . '/views/layouts/header.php';?>


<div class="content">				
<div class="center">					
<div class="post">
	

<div class="content-page"> <!-- content-page -->
<div class="content-page__body"> <!-- content-page__body -->
<div class="menu-page"> <!-- menu-page -->
<div>
<div class="moduletable">  <!-- moduletable -->

<ul>
    <?php foreach ($Product as $productItem): ?>
    
    <?php 
    $quantity_sub = count($productItem['Naimenovanie_type']);
    if ($quantity_sub!=0):
    ?>

    <li class="deeper parent lil1"> <!-- deeper parent lil1 -->       
	
    <a href="/catalog/<?php echo $productItem['ID_category'];  ?>"><?php echo $productItem['Category_name']; ?></a>    
            
		<ul>  <!-- ul subcategory -->
		<?php foreach ($productItem['Naimenovanie_type'] as $Item): ?>

			<?php 
			$type = Product::getProductView($productItem['ID_category'], $Item['ID_type']);
			$count = count($type);
			if ($count != 0):
			?>

		<li class=" lil2">
		    <a href="/catalog/<?php echo $productItem['ID_category']; ?>/<?php echo $Item['ID_type'];  ?>">		   	
		    
		    <img src="<?php echo Product::getImage($Item['ID_type']); ?>">
		   	<span class="image-title"><?php echo $Item['Naimenovanie_type']; ?></span>
		   	
		   	</a>
		</li>
		<?php  endif; ?>
		<?php endforeach;?>
		</ul>  <!--end ul subcategory --> 
   

	</li> <!-- end deeper parent lil1 -->
	
	<?php  endif;  ?>

	<?php endforeach;?>    
</ul>

</div>  <!-- end moduletable -->
</div>
</div> <!-- end menu-page -->
</div> <!-- end content-page__body -->
</div> <!-- end content-page -->





</div>  <!-- post -->			
<div style="clear: both;">&nbsp;</div>
</div>			
</div>

<?php include  ROOT . '/views/layouts/footer.php'; ?>