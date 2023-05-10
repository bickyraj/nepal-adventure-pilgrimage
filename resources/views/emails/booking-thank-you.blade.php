<!DOCTYPE html>
<html>
<head>
	<title>{{ config('app.name') }}</title>
</head>
<body>
	<h3>Dear {{ $body['full_name'] }}</h3>

	<p>
        Thank you for booking your trip "{{ $body['trip_name'] }}" with us! We're thrilled to have you on board and look forward to providing you with a memorable experience.</p>

        <p>We have received your booking details and will be processing them shortly. If you have any questions or concerns in the meantime, please don't hesitate to reach out to us.
        </p>

        <p>
        We'll be in touch with you soon to confirm your itinerary and provide you with additional information about your trip.
        </p>

        <p>
        Thank you again for choosing us as your travel partner. We can't wait to help you make unforgettable memories.
        </p>
    </p>
    <div>Best regards,</div>
    <div>{{ config('app.name') }}</div>
</body>
</html>
