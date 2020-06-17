<?php require_once('mysqli_connect.php') ?>
<?php 
	
	$errors = "";

	if (isset($_POST['submit'])) {

		if (empty($_POST['task'])) {
			$errors = "You must fill in the task";
		}else{
			$task = $_POST['task'];
			$query = "INSERT INTO todolist (Task, Status) VALUES ('$task','Pending')";
			mysqli_query($db, $query);
			header('location: index.php');
		}
	}	

	if (isset($_GET['del_task'])) {
		$id = $_GET['del_task'];

		mysqli_query($db, "DELETE FROM Todolist WHERE id=".$id);
		header('location: index.php');
	}

	if(isset($_GET['comp_task'])){
		$id= $_GET['comp_task'];
		mysqli_query($db, "UPDATE Todolist SET Status = 'Completed' WHERE id=".$id);
		header('location: index.php');
	}

	if(isset($_GET['show_all'])){
		$tasks = mysqli_query($db, "SELECT * FROM Todolist ");
	} else if (isset($_GET['pending'])){
	$tasks = mysqli_query($db, "SELECT * FROM Todolist Where Status='Pending'");
	}else {
		$tasks = mysqli_query($db, "SELECT * FROM Todolist Where Status='Pending'");
	}
	

?>
<!DOCTYPE html>
<html>

<head>
	<title>ToDo List</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

	<div class="heading">
		<h2 style="font-style: 'Hervetica';">ToDo List</h2>
		<a href="index.php?show_all" class="btn">Show All</a> 
		<a href="index.php?pending" class="btn">Pending</a> 
	</div>
	
	<form method="post" action="index.php" class="input_form">
		<?php if (isset($errors)) { ?>
			<p><?php echo $errors; ?></p>
		<?php } ?>
		<input type="text" name="task" class="task_input">
		<button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
	</form>

	<table>
		<thead>
			<tr>
				<th>Compete</th>
				<th>Tasks</th>
				<th style="width: 60px;">Action</th>
				<th>Status</th>
			</tr>
		</thead>

		<tbody>
			<?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
				<tr>
					<td>
					<a href="index.php?comp_task=<?php echo $row['id'] ?>">Complete</a> 
					</td>
					<td class="task"> <?php echo $row['Task']; ?> </td>
					<td class="delete"> 
						<a href="index.php?del_task=<?php echo $row['id'] ?>">x</a> 
					</td>
					<td>
						<?php echo $row['Status']?>
					</td>
				</tr>
			<?php $i++; } ?>	
		</tbody>
	</table>

</body>
</html>