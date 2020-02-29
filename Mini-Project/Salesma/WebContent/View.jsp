<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<meta charset="UTF-8">
<title>Circuit Inspector</title>
</head>
<body>
<h1>Toy Inspector</h1>

	<form action="" method="post">

		<label for="fname">Inspector:</label> 
		<input type="text" id="inspector" required="required" name="inspector"><br> 
		
		<label for="lname">Toy ID:</label> 
		<input type="text" id="toyid" required="required" name="toyid">
		<input type="button" name="Load" value="Load" required="required" style="color: black">
		
		<br><br>
		<label>Circuit 1</label> <br> 
		
		<label>Voltage</label>
		<input type="text" required="required" name="voltage1"><br> 
		
		<label>Resistance</label>
		<input type="text" required="required" name="resistance1"> <br> 
		<label>Manufacture Location:</label> 
		
		<select id="mfgLoc1" required="required">
			<option value="USA">USA</option>
			<option value="Germany">Germany</option>
			<option value="China">China</option>
		</select> 
		<br>
		<br> 
		
		<label>Circuit 2</label> <br> 
		
		<label>Voltage</label>
		<input type="text" required="required" name="voltage2"><br> 
		
		<label>Resistance</label>
		<input type="text" required="required" name="resistance2"> <br> 
		
		<label>Manufacture Location:</label> 
		
		<select id="mfgLoc2" required="required">
			<option value="USA">USA</option>
			<option value="Germany">Germany</option>
			<option value="China">China</option>
		</select> 
		<br>
		<br> 
		<input type="submit" name="Submit" value="Save Toy" style="color: black">
		<input id="deleteButton" name="Delete" value="Delete Toy" style="color: black">
		
	</form>
</body>
</html>