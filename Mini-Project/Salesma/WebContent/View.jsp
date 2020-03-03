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

	<div class="border">
		<h1 style="text-align: center">Toy Inspector</h1>

		<form target="/Controller">
			<div class="padding">
				<label for="name">Inspector:</label> 
				<input type="text"
					id="inspector"  name="inspector"><br>

				<label for="toyid">Toy ID:</label> <input type="text" id="toyid"
					 name="toyid"> <input type="submit"
					name="btnLoad" value="Load"  style="color: black">
			</div>

			<div class="row">
				<div class="column">
					<label>Circuit 1</label> <br> <label>Voltage</label> <input
						type="text"  name="voltage1"> <br>

					<label>Resistance</label> <input type="text" 
						name="resistance1"> <br> <label>Manufacture
						Location:</label> <select id="mfgLoc1" >
						<option value="USA">USA</option>
						<option value="Germany">Germany</option>
						<option value="China">China</option>
					</select>
				</div>

				<div class="column">
					<label>Circuit 2</label> <br> <label>Voltage</label> <input
						type="text"  name="voltage2"> <br>

					<label>Resistance</label> <input type="text" 
						name="resistance2"> <br> <label>Manufacture
						Location:</label> <select id="mfgLoc2" >
						<option value="USA">USA</option>
						<option value="Germany">Germany</option>
						<option value="China">China</option>
					</select>
				</div>
			</div>

			<input type="submit" name="btnSave" value="Save Toy"
				style="color: black"> <input type="submit" id="deleteButton"
				name="btnDelete" value="Delete Toy" style="color: black">
		</form>
	</div>

</body>
</html>