<%@page import="model.Toy"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Kembell / Berkstresser Enterprises</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
	<%
		Toy myToy = null;
		if (request.getAttribute("toy") != null) {
			myToy = (Toy) request.getAttribute("toy");
		}
	%>
	<form action="Controller">
		<div id=wrapper>
			<h1>Toy</h1>
			<label for="txtToyID">Toy ID</label><br> 
			<input type=text name=txtToyID id=txtToyID
				value=<%=(myToy == null ? "\"\"" : "\"" + myToy.getToyID() + "\"")%>>
				<br>
			<label for="txtInspector">Inspector</label>
			<br> 
			<input type=text name=txtInspector id=txtInspector
				value=<%=(myToy == null ? "\"\"" : "\"" + myToy.getInspector() + "\"")%>>
				<br>
			<label for="txtCode">Toy Code</label>
			<br> 
			<input type=number name=txtCode id=txtCode
				value=<%=(myToy == null ? "\"\"" : "\"" + myToy.getToyCode() + "\"")%>>
				<br>
			<label for="txtInspectionDateTime">Inspection Date / Time</label> 
			<br>
			<input type=text name=txtInspectionDateTime id=txtInspectionDateTime
				value=<%=(myToy == null ? "\"\"" : "\"" + myToy.getInspectionDateTime() + "\"")%>><br>
			
			
			<h2>Circuit 1</h2>
			<div id=circuit1>
				<label for="txtVoltage1">Voltage</label>
				<br> 
				<input type=number name=txtVoltage1 id=txtVoltage1 min=0.01 step=0.01
					value=<%=(myToy == null ? "\"\"" : "\"" + myToy.getCircuits().get(0).getVoltage() + "\"")%>>
					<br>
				<label for="txtResistance1">Resistance</label>
				<br> 
				<input type=number name=txtResistance1 id=txtResistance1 min=0.01 step=0.01
					value=<%=(myToy == null ? "\"\"" : "\"" + myToy.getCircuits().get(0).getResistance() + "\"")%>>
				<br>
				<label for="txtManufactureLocation1"> Manufacture Location</label>
				<br>
				<input type=text name=txtManufactureLocation1
					id=txtManufactureLocation1 min=0.01 step=0.01
					value=<%=(myToy == null ? "\"\"" : "\"" + myToy.getCircuits().get(0).getManufactureLocation() + "\"")%>><br>
				</div>
				
			<h2>Circuit 2</h2>
			<div id=circuit2>
				<label for="txtVoltage2">Voltage</label><br> <input type=number
					name=txtVoltage2 id=txtVoltage1 min=0.01 step=0.01
					value=<%=(myToy == null ? "\"\"" : "\"" + myToy.getCircuits().get(1).getVoltage() + "\"")%>>
				<br>
				<label for="txtResistance2">Resistance</label><br> <input
					type=number name=txtResistance2 id=txtResistance1 min=0.01
					step=0.01
					value=<%=(myToy == null ? "\"\"" : "\"" + myToy.getCircuits().get(1).getResistance() + "\"")%>>
				<br>
				<label for="txtManufactureLocation2"> Manufacture Location</label>
				<br>
				<input type=text name=txtManufactureLocation2
					id=txtManufactureLocation1 min=0.01 step=0.01
					value=<%=(myToy == null ? "\"\"" : "\"" + myToy.getCircuits().get(1).getManufactureLocation() + "\"")%>><br>
			</div>

			<input type=submit value="Load" name=btnLoad> 
			<input type=submit value="Save" name=btnSave> 
			<input type=submit value="Delete" name=btnDelete>
		</div>
	</form>
</body>
</html>