							<table class="table table-striped table-bordered table-hover" id="datatable">
								<thead>
								<tr role="row" class="heading">
							<?php
								if(isset($dataTable['header'])){
									for($i=0; $i<count($dataTable['header']); $i++){
									?>
									<th width="<?php echo $dataTable['header'][$i]['width'];?>">
										 <?php echo $dataTable['header'][$i]['title'];?>
									</th>
									<?php
									}
								}
							?>
								</tr>
								<tr role="row" class="filter">
									<td></td>
									<td>
										<select name="search_id_user_type" id="search_id_user_type" class="form-control form-filter input-sm">
											<option value="">- All -</option>
											<?php 
											if($user_type['count']){ 
												for($i=0; $i<count($user_type['rows']); $i++){
											?>
											<option value="<?php echo $user_type['rows'][$i]['id']; ?>"><?php echo $user_type['rows'][$i]['name']; ?></option>
											<?php 
												}
											}
											?>
										</select>
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" id="search_name" name="search_name" placeholder="Search by Name">
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" id="search_username" name="search_username" placeholder="Search by Username">
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" id="search_email" name="search_email" placeholder="Search by E-mail">
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" id="search_phone" name="search_phone" placeholder="Search by Phone">
									</td>
									<td>
										<select name="search_status" id="search_status" class="form-control form-filter input-sm">
											<option value="">- All -</option>
											<option value="1">Active</option>
											<option value="0">Inactive</option>
										</select>
									</td>
									<td>
										<div class="margin-bottom-5">
											<button class="btn btn-sm yellow filter-submit margin-bottom" title="Search"><i class="fa fa-search"></i></button>
											<button class="btn btn-sm red filter-cancel" title="Reset" onclick="clearSearchForm()"><i class="fa fa-times"></i></button>
										</div>
										
									</td>
								</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
