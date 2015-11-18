<div class="col-md-9">
	<?php if($services->result_count() > 0): ?>
	<div class="row">
		<div class="row-homepage service-home">
			<div class="col-md-12 title-server-home">
				<h3>Dịch vụ</h3>
			</div>
			<?php foreach ($services as $key=>$row): ?>
			<?php if($key == 0): ?>
			<div class="col-md-6">
				<div class="td-module-image">
	                <div class="td-module-thumb">
	                	<a href="<?php echo create_url($row->id); ?>" title="<?php echo $row->title_vietnamese; ?>">
	                		<img class="entry-thumb td-animation-stack-type0-2" src="http://ehomesnamlong.com/wp-content/uploads/2015/11/11261691_1552663628328645_7716332463626704001_n-324x235.jpg" alt="" title="<?php echo $row->title_vietnamese; ?>">
	                	</a>
	                </div>
                </div>
            	<h4 itemprop="name" class="entry-title td-module-title">
            		<a href="<?php echo create_url($row->id); ?>" title="<?php echo $row->title_vietnamese; ?>"><?php echo $row->title_vietnamese; ?></a>
            	</h4>
	            <div class="td-excerpt"><?php echo $row->short_vietnamese; ?></div>
			</div>
			<?php else: break; endif; ?>
			<?php endforeach; ?>
			<div class="col-md-6">
				<?php foreach ($services as $key=>$row): ?>
				<?php if($key == 0): continue; endif; ?>
				<div class="row td_module_6 td_module_wrap td-animation-stack">
	        		<div class="col-md-4 td-module-thumb">
	        			<a href="<?php echo create_url($row->id); ?>" title="<?php echo $row->title_vietnamese; ?>">
	        				<img src="http://ehomesnamlong.com/wp-content/uploads/2015/11/nha-mau-ehome3-hinh-3_142013144647-100x70.jpeg" alt="<?php echo $row->title_vietnamese; ?>">
	        			</a>
	        		</div>
	        		<div class="col-md-8 item-details">
		            	<h5 class="entry-title td-module-title">
		            		<a href="<?php echo create_url($row->id); ?>" title="<?php echo $row->title_vietnamese; ?>"><?php echo $row->title_vietnamese; ?></a>
		            	</h5>
		            	<div class="td-module-meta-info">
			                <div class="td-post-date">
			                	<span>Ngày tạo: <?php echo get_date_from_sql($row->created); ?></span>
			                </div>
		                </div>
		            </div>
        		</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php if($advices->result_count() > 0): ?>
	<div class="row">
		<div class="row-homepage advices-home">
			<div class="col-md-12 advices-home">
				<h3>Tư vấn</h3>
			</div>
			<?php foreach ($advices as $key=>$row): ?>
			<?php if($key == 0): ?>
			<div class="col-md-6">
				<div class="td-module-image">
	                <div class="td-module-thumb">
	                	<a href="<?php echo create_url($row->id); ?>" title="<?php echo $row->title_vietnamese; ?>">
	                		<img class="entry-thumb td-animation-stack-type0-2" src="http://ehomesnamlong.com/wp-content/uploads/2015/11/11261691_1552663628328645_7716332463626704001_n-324x235.jpg" alt="" title="<?php echo $row->title_vietnamese; ?>">
	                	</a>
	                </div>
                </div>
            	<h4 itemprop="name" class="entry-title td-module-title">
            		<a href="<?php echo create_url($row->id); ?>" title="<?php echo $row->title_vietnamese; ?>"><?php echo $row->title_vietnamese; ?></a>
            	</h4>
	            <div class="td-excerpt"><?php echo $row->short_vietnamese; ?></div>
			</div>
			<?php else: break; endif; ?>
			<?php endforeach; ?>
			<div class="col-md-6">
				<?php foreach ($advices as $key=>$row): ?>
				<?php if($key == 0): continue; endif; ?>
				<div class="row td_module_6 td_module_wrap td-animation-stack">
	        		<div class="col-md-4 td-module-thumb">
	        			<a href="<?php echo create_url($row->id); ?>" title="<?php echo $row->title_vietnamese; ?>">
	        				<img src="http://ehomesnamlong.com/wp-content/uploads/2015/11/nha-mau-ehome3-hinh-3_142013144647-100x70.jpeg" alt="<?php echo $row->title_vietnamese; ?>">
	        			</a>
	        		</div>
	        		<div class="col-md-8 item-details">
		            	<h5 class="entry-title td-module-title">
		            		<a href="<?php echo create_url($row->id); ?>" title="<?php echo $row->title_vietnamese; ?>"><?php echo $row->title_vietnamese; ?></a>
		            	</h5>
		            	<div class="td-module-meta-info">
			                <div class="td-post-date">
			                	<span>Ngày tạo: <?php echo get_date_from_sql($row->created); ?></span>
			                </div>
		                </div>
		            </div>
        		</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php if($priceLists->result_count() > 0): ?>
	<div class="row">
		<div class="row-homepage price-list-home">
			<div class="col-md-12 price-list-home">
				<h3>Bảng giá</h3>
			</div>
			<?php foreach ($priceLists as $key=>$row): ?>
			<?php if($key == 0): ?>
			<div class="col-md-6">
				<div class="td-module-image">
	                <div class="td-module-thumb">
	                	<a href="<?php echo create_url($row->id); ?>" title="<?php echo $row->title_vietnamese; ?>">
	                		<img class="entry-thumb td-animation-stack-type0-2" src="http://ehomesnamlong.com/wp-content/uploads/2015/11/11261691_1552663628328645_7716332463626704001_n-324x235.jpg" alt="" title="<?php echo $row->title_vietnamese; ?>">
	                	</a>
	                </div>
                </div>
            	<h4 itemprop="name" class="entry-title td-module-title">
            		<a href="<?php echo create_url($row->id); ?>" title="<?php echo $row->title_vietnamese; ?>"><?php echo $row->title_vietnamese; ?></a>
            	</h4>
	            <div class="td-excerpt"><?php echo $row->short_vietnamese; ?></div>
			</div>
			<?php else: break; endif; ?>
			<?php endforeach; ?>
			<div class="col-md-6">
				<?php foreach ($priceLists as $key=>$row): ?>
				<?php if($key == 0): continue; endif; ?>
				<div class="row td_module_6 td_module_wrap td-animation-stack">
	        		<div class="col-md-4 td-module-thumb">
	        			<a href="<?php echo create_url($row->id); ?>" title="<?php echo $row->title_vietnamese; ?>">
	        				<img src="http://ehomesnamlong.com/wp-content/uploads/2015/11/nha-mau-ehome3-hinh-3_142013144647-100x70.jpeg" alt="<?php echo $row->title_vietnamese; ?>">
	        			</a>
	        		</div>
	        		<div class="col-md-8 item-details">
		            	<h5 class="entry-title td-module-title">
		            		<a href="<?php echo create_url($row->id); ?>" title="<?php echo $row->title_vietnamese; ?>"><?php echo $row->title_vietnamese; ?></a>
		            	</h5>
		            	<div class="td-module-meta-info">
			                <div class="td-post-date">
			                	<span>Ngày tạo: <?php echo get_date_from_sql($row->created); ?></span>
			                </div>
		                </div>
		            </div>
        		</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
</div>