<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>RK Demo</title>
		<meta name="description" content="Minimal empty page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- basic styles -->
		<link href="css/bootstrap.min.css" rel="stylesheet" />
		<script src="js/jquery-1.10.2.min.js"></script>
	</head>
	<body>
		<div class="main-container" id="main-container">
			<div class="main-container-inner">
				<a class="menu-toggler" id="menu-toggler" href="#"> <span class="menu-text"></span> </a>
				<div class="main-content">
					<div class="page-content">
						<div class="row">
							<center><h2><i class="icon-desktop color"></i>User List Modified</h2></center>
							<hr>
							<div class="col">
								<div class="col-xs-12">

									<div id="a" align="pull-right">
										<a href="#modal-user-form" role="button" data-toggle="modal" id="adduserBtn" class="btn btn-xs btn-info" title="Add Category"><i class="icon-plus">&nbsp;&nbsp;Add user</i></a>
										<!-- <a href="#" id="id-btn-dialogac1" class="btn btn-xs btn-info" title="Add Category" align="right"><i class="icon-plus">&nbsp;Add users</i></a> -->
									</div>
									<div class="table-responsive">
										<table id="user-list-table" class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th>Id</th>
													<th>First Name</th>
													<th>Last Name </th>
													<th>Sex</th>
													<th>Age</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>
							</div>
							<script src="js/jquery-1.10.2.min.js"></script>

							<script type="text/javascript">
								jQuery(function($) {
									$('table th input:checkbox').on('click', function() {
										var that = this;
										$(this).closest('table').find('tr > td:first-child input:checkbox').each(function() {
											this.checked = that.checked;
											$(this).closest('tr').toggleClass('selected');
										});
									});
								});
							</script>
							<div id="modal-user-form" class="modal" tabindex="-1">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">
												&times;
											</button>
											<h4 class="blue bigger" id="formCaption"></h4>
										</div>
										<div class="modal-body overflow-visible">
											<form id="myuserAddForm">
												<input type="hidden" value="" name="userId" id="userId"/>
												<div class="row">
													<div class="col-xs-12 col-sm-12">
														<div class="form-group">
															<label for="Firstname">First Name</label>
															<div>
																<input class="input-large" type="text" id="Firstname" placeholder="First Name" value=""  name="Firstname"/>
															</div>
														</div>
														<div class="form-group">
															<div class="form-group">
															<label for="Lastname">Last Name</label>
															<div>
																<input class="input-large" type="text" id="Lastname" placeholder="Last Name" value=""  name="Lastname"/>
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="form-group">
														<label for="Lastname">Age</label>
														<div>
															<input class="input-large" type="text" id="Age" placeholder="Age" value=""  name="Age"/>
														</div>
													</div>
													<div class="col-xs-6 col-sm-6">
														<div class="form-group">
															<label for="Sex">Sex</label>
															<div>
																<input type="radio" name="Sex" value="male">Male<br>
																<input type="radio" name="Sex" value="female">Female
															</div>
														</div>
													</div>
												</div>
											</form>
										</div>
										<div class="modal-footer">
											<button class="btn btn-sm btn-primary" id="btnSaveuser">
												<i class="icon-ok"></i>
												Save
											</button>
											<button class="btn btn-sm" data-dismiss="modal" id="btnCancelMnu">
												<i class="icon-remove"></i>
												Cancel
											</button>
										</div>
									</div>
								</div>
							</div><!-- PAGE CONTENT ENDS -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div><!-- /.main-content -->
			</div><!-- /.main-container-inner -->
		</div><!-- /.main-container -->
		<!-- basic scripts -->
		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='js/jquery-2.0.3.min.js'>" + "<" + "/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
		<script type="text/javascript">
		window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
		</script>
		<![endif]-->

		<div id="LoadingImage" style="display: none;align:top;vertical-align: center">
			<img src="images/loading.gif" align="middle"/><h1>Loading...</h1>
		</div>
		<script type="text/javascript">
			if ("ontouchend" in document)
				document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
		</script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/typeahead-bs2.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.serializeJSON.min.js"></script>
		<script src="js/json2.js"></script>
		<script src="js/arch.js"></script>
		<script src="js/users.js"></script>
	</body>
</html>