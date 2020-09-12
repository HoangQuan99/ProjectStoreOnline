
	<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php
					$getDell = $pd->getDell();
					if($getDell)
					{
						while ($resultdell=$getDell->fetch_assoc()) {

				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result['productId'] ?>"> <img src="admin/uploads/<?php echo $resultdell['image'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>DELL</h2>
						<p><?php echo $resultdell['productName'] ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $resultdell['productId'] ?>">Add to cart</a></span></div>
				   </div>
			   </div>	
			   <?php
			   		}	 
			   	}
			   ?>		
	<!-- <-------------------> 
			   <?php
					$getIP = $pd->getIP();
					if($getIP)
					{
						while ($resultip=$getIP->fetch_assoc()){

				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?proid=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $resultip['image'] ?>" alt="" / ></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Apple</h2>
						  <p><?php echo $resultdell['productName'] ?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $resultip['productId'] ?>">Add to cart</a></span></div>
					</div>
				</div>
				<?php
			   		}	 
			   	}
			   ?>	
			</div>
			<div class="section group">
			<?php
					$getSS = $pd->getSS();
					if($getSS)
					{
						while ($resultss=$getSS->fetch_assoc()){

				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result['productId'] ?>"> <img src="admin/uploads/<?php echo $resultss['image'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Sam Sung</h2>
						<p><?php echo $resultss['productName'] ?>.</p>
						<div class="button"><span><a href="details.php?proid=<?php echo $resultss['productId'] ?>">Add to cart</a></span></div>
				   </div>
			   </div>	
			   <?php
			   		}	 
			   	}
			   ?>		
		 <!-- <------------------->
		 		<?php
					$getXM = $pd->getXM();
					if($getXM)
					{
						while ($resultxm=$getXM->fetch_assoc()){

				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?proid=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $resultxm['image'] ?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Xiao Mi</h2>
						  <p><?php echo $resultxm['productName'] ?>.</p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $resultxm['productId'] ?>">Add to cart</a></span></div>
					</div>
				</div>
				<?php
			   		}	 
			   	}
			   ?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	