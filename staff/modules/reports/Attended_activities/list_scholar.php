	<?php
		if(!isset($_SESSION['USERID'])){
		redirect(web_root."admin/index.php");
	}

	?>

	<div class="row">
		<div class="col-lg-12"> 
				<h3  >List of Reports<small>|  <label class="label label-xs" style="font-size: 12px"><a href="index.php?view=add">  <i class="fa fa-plus-circle fw-fa"></i> New</a></label> |</small></h3> 
				
				</div>
			</div>
					<form action="controller.php?action=delete" Method="POST">  
					<div class="table-responsive">			
					<table id="example" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
					
					<thead>
						<tr>
							<th width="5%">#</th>
							<th>
							Department</th>
							<th>Description</th>
							<th width="10%" >Action</th>
					
						</tr>	
					</thead> 
					<tbody>
						<?php   
							$mydb->setQuery("SELECT * 
												FROM  `tbldepartment`");
							$cur = $mydb->loadResultList();

							foreach ($cur as $result) {
							echo '<tr>';
							echo '<td width="5%" align="center"></td>';
							echo '<td>'. $result->DEPARTMENT.'</td>';
							echo '<td>'. $result->DESCRIPTION.'</td>';
						
							echo '<td align="center" > <a title="Edit" href="index.php?view=edit&id='.$result->DEPARTMENTID.'"  class="btn btn-info btn-xs  ">  <span class="fa fa-edit fw-fa"></span></a>
										<a title="Delete" href="controller.php?action=delete&id='.$result->DEPARTMENTID.'" class="btn btn-danger btn-xs" ><span class="fa fa-trash-o fw-fa"></span> </a>
										</td>';
							echo '</tr>';
						} 
						?>
					</tbody>
						
					</table>

				</div>
					</form>
		