<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/table.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/button.min.css">
<?php
global $wpdb;
$subjects = $wpdb->get_results("SELECT * FROM hs_subjects");
$branches = $wpdb->get_results("SELECT * FROM hs_branches");
$years 	  = $wpdb->get_results("SELECT * FROM hs_years");
if(isset($_POST["submit"])){
	$result = $wpdb->insert( 'hs_books', 
			array('book'  	=> $_POST["book"],
			      'subject' => $_POST["subject"],
			      'year' 	=> $_POST["hs_year"],
			      'branch' 	=> $_POST["branch"] ));
}
?>
<h1>Add new Book</h1>
<form method="POST" action="">
	<table class="ui striped table">
		<tr>
			<td>Book Name</td>
			<td>
				<input type="text" name="book" id="book" autofocus>
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
				}
?>
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
			<td><input type="submit" name="submit" value="Add" class="ui blue mini button"></td>
		</tr>
	</table>
</form>
<?php
if($result){
	echo '<h1 style="color:green;">"'.$_POST["book"].'" - Book added successfully.<h1>';
	?>
<script type="text/javascript">
	document.getElementById('subject').value="<?php echo $_POST["subject"]; ?>";
	document.getElementById('branch').value="<?php echo $_POST["branch"]; ?>";
	document.getElementById('hs_year').value="<?php echo $_POST["hs_year"]; ?>";
</script>
<?php
}