<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h3>Booking</h3>

	Trip: {{ $body['trip_name'] }} <br>
	Booked By: {{ $body['first_name'] . " " . $body['middle_name'] . " " . $body['last_name'] }} <br>
	Country: {{ $body['country'] }} <br>
	Email: {{ $body['email'] }} <br>
	Contact No: {{ $body['contact_no'] }} <br>
	Gender: {{ $body['gender'] }} <br>

	<h3>Trip Details</h3>
	No. of Travellers: {{ $body['no_of_travellers'] }} <br>
	Preferred Departure Date: {{ $body['preferred_departure_date'] }} <br>
	Message: {{ $body['emergency_contact'] }} <br>

	<h4>Traveller Information</h4>
	IP Address: {{ $body['ip_address'] }}
</body>
</html>
