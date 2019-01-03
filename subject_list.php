<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/table.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/button.min.css">
<?php
global $wpdb;
if(isset($_POST["edit"])){
    $id = $_POST["id"];
    $row = $wpdb->get_row("SELECT * FROM hs_subjects WHERE id = $id", ARRAY_A);
    echo '<h1>Edit Subject Name</h1>
<form method="POST" action="">
<input type="hidden" name="id" value="'.$row["id"].'">
	<table class="ui striped table">
		<tr>
			<td>Subject</td>
			<td>
				<input type="text" name="subject" value="'.$row["subject"].'">
				<input type="submit" name="save" value="Save" 
						class="ui green button mini"></td>
		</tr>
	</table>
</form>';
} else {
	echo '<h2>Add New Subject</h2>
<form method="POST" action="">
	<table>
		<tr>
			<td>Add Subject</td>
			<td>
				<input type="text" name="subject" autofocus>
			</td>
			<td><input type="submit" name="add" value="Add" class="ui blue mini button"></td>
		</tr>
	</table>
</form>';
}
if(isset($_POST["save"])){
    $wpdb->update( 
        	'hs_subjects', 
        	array( 
        		'subject' => $_POST["subject"],
        		
        	), 
        	array( 'id' => $_POST["id"] ));
}
if(isset($_POST["delete"])){
    $wpdb->delete( 'hs_subjects', array( 'id' => $_POST["id"] ) );
}

if(isset($_POST["add"])){
$wpdb->insert( 
	'hs_subjects', 
	array( 
	      'subject'  => $_POST["subject"]
	  )
);
}



$rows = $wpdb->get_results("SELECT * FROM hs_subjects");
?>
	<table class="ui striped table">
		<thead>
    		<tr>
                <th>Subject</th>
                <th>Edit</th>
                <th>Delete</th>
    		</tr>
		</thead> 
 <?php
foreach ( $rows as $row ) 
{
 echo '
		<tr>
			<td>     '.$row->subject.'     </td>
			<td>
				<form method="POST">
					<input type="hidden" name="id" value="'.$row->id.'">
					<input type="submit" name="edit" value="Edit" class="ui mini blue button">
				</form>
			</td>
			<td>
				<form method="POST">
				<input type="hidden" name="id" value="'.$row->id.'">
				<input type="submit" name="delete" value="Delete" class="ui mini red button">
				</form>
			</td>
		</tr>';
}
?>
</table>

