@extends('layouts.email')

@section('content')
	@if(strtolower($salutation) == "admin")
	<p>New booking request for {{ $booking->room->room_name }} received. Below are the details.</p>
	@else
		<p>Dear {{ $salutation}},</p>
		<p>Your booking request for {{ $booking->room->room_name }} has been received. NCIA will review the details and contact you in due time. Below are the details that you sumitted.</p>
	@endif

	
	<table class = "table table-striped">
		<tr>
			<th>Room</th>
			<td>{{ $booking->room->room_name }}</td>
		</tr>
		
		<tr>
			<th>Duration</th>
			<td>{{ $booking->duration() }}</td>
		</tr>

		<tr>
			<th>From</th>
			<td>{{ $booking->from->toFormattedDateString() }}</td>
		</tr>

		<tr>
			<th>To</th>
			<td>{{ $booking->to->toFormattedDateString() }}</td>
		</tr>

		<tr>
			<th>Number of Participants</th>
			<td>{{ $booking->no_of_participants }}</td>
		</tr>

		<tr>
			<th>Name of organization\entity</th>
			<td>{{ $booking->organization }}</td>
		</tr>

		<tr>
			<th>Nature of Session</th>
			<td>{{ $booking->nature_of_session }}</td>
		</tr>

		<tr>
			<th>Contact Person</th>
			<td>{{ $booking->contact_name }}</td>
		</tr>

		<tr>
			<th>Telephone</th>
			<td>{{ $booking->telephone }}</td>
		</tr>

		<tr>
			<th>Email</th>
			<td>{{ $booking->email }}</td>
		</tr>
	</table>

@endsection