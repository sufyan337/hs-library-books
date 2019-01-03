
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/form.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/table.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/button.min.css">


<?php
global $wpdb;

if(isset($_POST["delete"])){
	$id = $_POST["id"];
	$wpdb->delete( 'hs_branches', array( 'id' => $id ) );
}
if(isset($_POST["edit"])){
	$id = $_POST["id"];
	$row = $wpdb->get_row( "
		SELECT * FROM hs_branches WHERE id = $id",ARRAY_A );
	echo '<h1>Edit here</h1>
	<form action="" method="POST" id="edit_form">
		<input type="hidden" name="id" value="'.$id.'">
		<table class="ui striped table">
		<tr>
			<td>Edit Branch name:</td>
			<td>
				<input type="text" name="branch" value="'.$row["branch"].'">
			</td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="save" value="Save" class="ui mini green button"></td>
		</tr>
	</table>
</form>';
} else {
	echo '<h2>Add New Branch:</h2>
<form action="" method="POST">
	<table class="">
		<tr>
			<td>Branch Name</td>
			<td><input type="text" name="branch"></td>
			<td><input type="submit" name="submit" value="Add" 
				class="ui blue button mini">
			</td>
		</tr>		
	</table>
</form>';
}

if(isset($_POST["save"])){
    $wpdb->update( 
        	'hs_branches', 
        	array( 
        		'branch' => $_POST["branch"],
        		
        	), 
        	array( 'id' => $_POST["id"] ));
}

if(isset($_POST["submit"])){
global $wpdb;
$wpdb->insert( 
	'hs_branches', 
	array( 
		'branch' => $_POST["branch"]
		)
		);
}

$branches = $wpdb->get_results("SELECT * FROM hs_branches");
?>
<h1>List of Branches:</h1>
<table class="ui striped table">
	<thead>
	<tr>
		<th>   Branch name      </th>
		<th>    Edit          </th>
		<th>    Delete        </th>
	</tr>
	</thead> 
	
 <?php
foreach ( $branches as $branch ) 
{
 echo '
		<tr>
			<td>     '.$branch->branch.' </td>
			<td>
				<form method="POST">
					<input type="hidden" name="id" value="'.$branch->id.'">
					<input type="submit" name="edit" value="Edit" class="ui mini button blue">
				</form>
			</td>
			<td>
				<form method="POST">
				<input type="hidden" name="id" value="'.$branch->id.'">
				<input type="submit" name="delete" value="Delete" class="ui mini button red">
				</form>
			</td>
		</tr>';

}
?>
</table>
	



	


