@extends('layouts.app')
@section('content')
	<div class="container">
		<p>
			<h1>AJAX Crud With Laravel</h1>
		</p>
		<div class="row">
			<div class="col-md-8">
				<table id="dataTable" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Detail</th>
							<th>Author</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody></tbody>
					
				</table>
				
			</div>
			<div class="col-md-4">
				<form action="">
					<div class="form-group myid">
						<label>ID</label>
						<input type="number" name="" id="id" class="form-control" readonly>
					</div>
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="" id="name" class="form-control">
					</div>
					<div class="form-group">
						<label>Detail</label>
						<textarea type="text" name="" id="detail" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<label>Author</label>
						<input type="text" name="" id="author" class="form-control">
					</div>
					<button type="button" id="save" class="btn btn-primary" onclick="saveData()">Submit</button>
					<button type="button" id="update" class="btn btn-warning" onclick="updateData()">Update</button>
				</form>
			</div>
		</div>
	</div>
	

<script>
	$('#dataTable').DataTable();
	$('#save').show();
	$('#update').hide();
	$('.myid').hide();

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
		}
	});
	

	function viewData() {
		$.ajax({
			url: '/cruds',
			type: 'GET',
			dataType: 'json',
			// data: {param1: 'value1'},
		})
		.done(function(response) {
			// console.log(response);
			var rows = '';
			$.each(response, function(key, value) {
				rows = rows + "<tr>";
				rows = rows + "<td>" + value.id + "</td>";
				rows = rows + "<td>" + value.name + "</td>";
				rows = rows + "<td>" + value.detail + "</td>";
				rows = rows + "<td>" + value.author + "</td>";
				rows = rows + "<td>";
				rows = rows + "<button type='button' class='btn btn-warning btn-sm' onclick='editData("+value.id+")'>Edit</button>";
				rows = rows + "<button type='button' class='btn btn-danger btn-sm' onclick='deleteData("+value.id+")'>Delete</button>";
				rows = rows + "</td></tr>";
			});
			$('tbody').html(rows);
		});
		
	}


	viewData();

	function saveData() {
		var name = $('#name').val();
		var detail = $('#detail').val();
		var author = $('#author').val();
		$.ajax({
			url: '/cruds',
			type: 'POST',
			dataType: 'json',
			data: {name: name, detail: detail, author: author},
		})
		.done(function(response) {
			viewData();
			clearData();
			$('#save').show();
		});
		
	}

	function clearData() {
		$('#id').val('');
		$('#name').val('');
		$('#detail').val('');
		$('#author').val('');
	}

	function editData(id) {
		$('#save').hide();
		$('#update').show();
		$('.myid').show();
		$.ajax({
			url: '/cruds/' + id + '/edit',
			type: 'GET',
			dataType: 'json',
			// data: {param1: 'value1'},
		})
		.done(function(response) {
			$('#id').val(response.id);
			$('#name').val(response.name);
			$('#detail').val(response.detail);
			$('#author').val(response.author);
		});
		
		
	}

	function updateData() {
		var id = $('#id').val();
		var name = $('#name').val();
		var detail = $('#detail').val();
		var author = $('#author').val();
		$.ajax({
			url: '/cruds/' + id,
			type: 'PUT',
			dataType: 'json',
			data: {name: name, detail: detail, author: author},
		})
		.done(function(response) {
			viewData();
			clearData();
			$('.myid').hide();
			$('#update').hide();
			$('#save').show();
		});
		
	}

	function deleteData(id) {
		$.ajax({
			url: '/cruds/' + id,
			type: 'DELETE',
			dataType: 'json',
			// data: {id: id},
		})
		.done(function() {
			viewData();
		});
		
	}

</script>
@endsection