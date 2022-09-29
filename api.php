<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>API</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>

<h3>Notices</h3>
<form id="addNotice">
	<label>User</label>
	<input type="email" id='user' name=""><br />
	<label>Subject</label>
	<input type="text" id='subject' name=""><br />
	<label>Descrition</label>
	<input type="text" id='desc' name=""><br />
	<button type='submit'>Submit Notice</button>
</form>
<table>
	<thead>
		<tr>
			<th>no.</th>
			<th>user</th>
			<th>subject</th>
			<th>description</th>
		</tr>
	</thead>
	<tbody id='list_notices'></tbody>
</table>
</body>
</html>


<script type="text/javascript">
	$('#addNotice').submit(function(e){
		e.preventDefault()
		var notice = {
			user:$('#user').val(),
			subject:$('#subject').val(),
			description:$('#desc').val(),
		}
		// alert(JSON.stringify(notice))
		$.post(`http://esystems/Online_notice_board/api/noticeAPI.php`, JSON.stringify(notice), function(data,status){
			alert(data.message)
			listNotice();
			$('#user').val('')
			$('#subject').val('')
			$('#desc').val('')
		})
	})
	function listNotice(){
	$.get('http://esystems/Online_notice_board/api/noticeAPI.php', function(data, status){
		// console.log(data);
		var i = 1;
		var ty = "";
		for(var x of data){
			console.log(x)
			ty += `<tr><td>${i}</td><td>${x.user}</td><td>${x.subject}</td><td>${x.Description}</td></tr>`
			i++;
		}
		$('#list_notices').html(ty)
		// console.log(ty)
	})
	}
	listNotice();
</script>