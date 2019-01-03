
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/form.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/table.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/button.min.css">


<?php
global $wpdb;
if(isset($_POST["submit"])){
global $wpdb;
$wpdb->insert( 
	'hs_years', 
	array( 
		'year' => $_POST["hs_year"]
		)
		);
}

if(isset($_POST["edit"])){
    $id = $_POST["id"];
    $row = $wpdb->get_row("SELECT * FROM hs_years WHERE id = $id", ARRAY_A);
    echo '<h2>Edit Year Name</h2>
<form method="POST" action="">
<input type="hidden" name="id" value="'.$row["id"].'">
	<table class="ui striped table">
		<tr>
			<td>Edit:</td>
			<td>
				<input type="text" name="year" value="'.$row["year"].'">
			</td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="save" value="Save" class="ui green mini button"></td>
		</tr>
	</table>
</form>';
} else {
	echo '<h2>Add new Academic Year</h2>
<form action="" method="POST">
	<table>
		<tr>
			<td>Enter year name:</td>
			<td>
				<input type="text" name="hs_year">
			</td>
			<td><input type="submit" name="submit" value="Add" class="ui blue button mini"></td>
		</tr>		
	</table>
</form>';
}
if(isset($_POST["save"])){
    $wpdb->update( 
        	'hs_years', 
        	array( 
        		'year' => $_POST["year"],
        		
        	), 
        	array( 'id' => $_POST["id"] ));
}
if(isset($_POST["delete"])){
    $wpdb->delete( 'hs_years', array( 'id' => $_POST["id"] ) );
}
?>


<?php
$years = $wpdb->get_results("SELECT * FROM hs_years");
?>
	<table class="ui striped table">
		<thead>
		<tr>
			<th>   Year          </th>
			<th>    Edit          </th>
			<th>    Delete        </th>
		</tr>
		</thead> 
	
 <?php
foreach ( $years as $year ) 
{
 echo '
		<tr>
			<td>     '.$year->year.' </td>
			<td>
				<form method="POST">
					<input type="hidden" name="id" value="'.$year->id.'">
					<input type="submit" name="edit" value="Edit" class="ui mini blue button">
				</form>
			</td>
			<td>
				<form method="POST">
				<input type="hidden" name="id" value="'.$year->id.'">
				<input type="submit" name="delete" value="Delete" class="ui mini red button">
				</form>
			</td>
		</tr>';

}
?>
</table>
	



	


