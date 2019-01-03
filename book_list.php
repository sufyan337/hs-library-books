<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/table.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/button.min.css">
<?php
global $wpdb;
$subjects = $wpdb->get_results("SELECT * FROM hs_subjects", OBJECT_K);
$branches = $wpdb->get_results("SELECT * FROM hs_branches", OBJECT_K );
$years = $wpdb->get_results("SELECT * FROM hs_years", OBJECT_K );
if(isset($_POST["delete"])){
	$id = $_POST["id"];
	$wpdb->delete( 'hs_books', array( 'id' => $id ) );
}
if(isset($_POST["edit"])){
	$id = $_POST["id"];
	$row = $wpdb->get_row( "
		SELECT * FROM hs_books WHERE id = $id",ARRAY_A );
	echo '<h1>Edit here</h1>'; ?>
<form action="" method="POST" id="edit_form">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<table class="ui striped table">
	<tr>
		<td>Book Name</td>
		<td>
			<input type="text" name="book" value="<?php echo $row["book"]; ?>">
		</td>
	</tr>
	<tr>
		<td>Subject</td>
		<td>
			<select name="subject" id="subject">
				<?php
				foreach ($subjects as $subject){
					echo '<option 
					value="'.$subject->id.'">'.$subject->subject.'</option>';
			} ?>
			</select>
		</td>
	</tr>
	<tr>
	     <td>Branch</td>
	     <td><select name="branch" id="branch">
	     	<?php
	     	foreach ($branches as $branch){
	     		echo '<option 
	     		value="'.$branch->id.'">'.$branch->branch.'</option>';
	     	}
	     	?></select>
	     </td>
	</tr>
	<tr>
		<td>Year</td>
		<td>
			<select name="hs_year" id="hs_year">
				<?php
				foreach ($years as $year){
					echo '<option 
	     		value="'.$year->id.'">'.$year->year.'</option>';
				}
				?>
			</select>	
		</td> 
	</tr>	  
	<tr>
		<td></td>
		<td><input type="submit" name="save" value="Save" 
					class="ui green button mini"></td>
	</tr>
</table>
</form>
<script type="text/javascript">
	document.getElementById('subject').value="<?php echo $row["subject"]; ?>";
	document.getElementById('branch').value="<?php echo $row["branch"]; ?>";
	document.getElementById('hs_year').value="<?php echo $row["year"]; ?>";
</script>
<?php 
}

if(isset($_POST["save"])){
    $wpdb->update( 
        	'hs_books', 
        	array( 
        		'book' => $_POST["book"],
        		'subject' => $_POST["subject"],
        		'branch' => $_POST["branch"],
        		'year' => $_POST["hs_year"],
        		
        	), 
        	array( 'id' => $_POST["id"] ));
}

if(isset($_POST["submit"])){
global $wpdb;
$wpdb->insert( 
	'hs_books', 
	array( 
		'book' => $_POST["book"]
		)
		);
}

$books = $wpdb->get_results("SELECT * FROM hs_books");
?>
<h1>List of books:</h1>
<table class="ui striped table">
	<thead>
	<tr>
		<th>Book name	</th>
		<th>Subject		</th>
		<th>Branch		</th>
		<th>Year		</th>
		<th>Edit		</th>
		<th>Delete		</th>
	</tr>
	</thead> 
	
<?php

foreach ( $books as $book ){
	$sub = $book->subject;
	$brnch = $book->branch;
	$yr = $book->year;
 echo '
		<tr>
			<td>     '.$book->book.' 	</td>
			<td>     '.$subjects[$sub]->subject.' </td>
			<td>     '.$branches[$brnch]->branch.' 	</td>
			<td>     '.$years[$yr]->year.' 	</td>
			<td>
				<form method="POST">
					<input type="hidden" name="id" value="'.$book->id.'">
					<input type="submit" name="edit" value="Edit" class="ui mini button blue">
				</form>
			</td>
			<td>
				<form method="POST">
				<input type="hidden" name="id" value="'.$book->id.'">
				<input type="submit" name="delete" value="Delete" class="ui mini button red">
				</form>
			</td>
		</tr>';

}
?>
</table>
	



	


