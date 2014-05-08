$(document).ready(function() {
	$("#LoadingImage").center();
	// set loading image in center position
	$("#LoadingImage").show();
	//  Loading gif image visible is true
	$.getJSON("./index.php/api/person", function(data) {// Loading user data from server
		$("#LoadingImage").hide();
		// hide after loading table row json data.
		$.each(data, function(i, user) {
			var userRow = constructTr(user);
			// call constructTr method to create new row
			$("#user-list-table tbody").append(userRow);
			// create new row (append new row user)
		});

		// add category button action starts
		$("#adduserBtn").click(function(e) {
			e.preventDefault();
			$("#modal-user-form").modal("show");
			// show modal dialogue for add new user
			$("#formCaption").text("Add New user");
			// set form caption as Add New user
		});

		// update user button actions starts
		$(".js-edit").click(function(e) {
			e.preventDefault();
			//stops the event action
			$("#modal-user-form").modal("show");
			// show modal dialogue for update users
			$("#formCaption").text("Update User");
			// set form caption as Update user
			$tr = $(this).closest("tr");
			$(".userName").val();
			// fetching tectbox id userName value
			var userId = $tr.attr("id");
			$("#userId").val(userId);
			doRead(userId);
		});

		$(".js-delete").click(function(e) {
			e.preventDefault();
			//stops the event action
			$tr = $(this).closest("tr");
			var userId = Number($tr.attr("id"));
			doDelete(userId);
		});
	});

function doRead(userId) {
	$.getJSON("./index.php/api/person/" + userId, function(dataObj) {
		$("#myuserAddForm")[0].reset();
		$("#userId").val(dataObj.variables.id);
		$("#Firstname").val(dataObj.variables.Firstname);
		$("#Lastname").val(dataObj.variables.Lastname);
		$("#Age").val(dataObj.variables.Age);

		if (dataObj.variables.Sex === "M")
		{
			$('#male').prop('checked', true);
		}
		else
		{
			$("#female").prop('checked', true);	
		}
	});
};

function doSave(postData) {
	$.ajax({
		url : "./index.php/api/person",
		type : "POST",
		headers : {
			"Accept" : "application/json; charset=utf-8",
			"Content-Type" : "application/json; charset=utf-8"
		},
		data : JSON.stringify(postData),
		dataType : "json",
		success : function(msg) {
			var userRow = undefined;
			postData.id = new Number(msg);
			userRow = constructTr(postData);

			$("#LoadingImage").hide();
			$("#user-list-table tbody").append(userRow);
			$("#modal-user-form").modal('hide');
		},
		error : function(xhr, status) {
			$("#LoadingImage").hide();
		}
	});
}

function doUpdate(postData) {
	$.ajax({
		url : "./index.php/api/person",
		type : "PUT",
			/*
			 headers : {
			 "Accept" : "application/json; charset=utf-8",
			 "Content-Type" : "application/json; charset=utf-8"
			},*/
			data : JSON.stringify(postData),
			dataType : "json",
			success : function(msg) {
				msg = new Number(msg);
				if (msg > 0) {
					$('#' + postData.id).find("td").eq(0).html(postData.id); 
					$('#' + postData.id).find("td").eq(1).html(postData.Firstname); 
					$('#' + postData.id).find("td").eq(2).html(postData.Lastname); 
					$('#' + postData.id).find("td").eq(3).html(postData.Sex);	
					$('#' + postData.id).find("td").eq(4).html(postData.Age);	
				} else {
					// show error message
				}

				$("#LoadingImage").hide();
				//$("#user-list-table tbody").append(userRow);
				$("#modal-user-form").modal("hide");
			},
			error : function(xhr, status) {
				$("#LoadingImage").hide();
			}
		});
}

function doDelete(userId) {
	$.ajax({
		url : "./index.php/api/person/" + userId,
		type : "DELETE"
	}).done(function() {
		$tr.fadeOut('slow', 'swing', function(here) {
			$(this).remove();
		});
	});
	$tr.fadeOut('slow', 'swing', function(here) {
		$(this).remove();
	});
}

function constructTr(user) {
	var userRow = '<tr id=' + user.id + '><td>' + 
	user.id + '</td><td>' 
	+ user.Firstname + "</td>" + '<td class="hidden-480"><h5>' 
	+ user.Lastname + '</h5></td><td>' 
	+ user.Sex + '</small ></td><td align="center">' 
	+ user.Age + '</td><td class="hidden-480"><h5>' 
	+ '<button class="btn btn-xs btn-info js-edit">E</button><button class="btn btn-xs btn-danger js-delete">D</button></td></tr>';
	return userRow;
};

$("#btnSaveuser").click(function(e) {
	e.preventDefault();
		//stops the event action
		var data = $("#myuserAddForm").serializeJSON();
		if (data.id === "" || data.id == undefined) {
			delete data["id"];
		} else {
			data.id = Number(data.id);
		}

		var method = "POST";

		if (data.id !== undefined) {
			doUpdate(data);
		} else {
			doSave(data);
		}

	});
});
