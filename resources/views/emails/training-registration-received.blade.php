@extends('layouts.email')

@section('content')
	@if(strtolower($salutation) == "admin")
	<p>New training registration received. Below are the details.</p>
	@else
		<p>Dear {{ $salutation}},</p>
		<p>Your application for {{ $trainingCalendarRegistration->activity }} training programme has been received. NCIA will review the details and contact you in due time.</p>
	@endif

	
	<table class = "table table-striped">
		<tr>
			<th>Title</th>
			<td>{{ $trainingCalendarRegistration->training_calendar->activity }}</td>
		</tr>
		
		<tr>
			<th>First Name</th>
			<td>{{ $trainingCalendarRegistration->first_name }}</td>
		</tr>

		<tr>
			<th>Middle Name</th>
			<td>{{ $trainingCalendarRegistration->middle_name }}</td>
		</tr>

		<tr>
			<th>Last Name</th>
			<td>{{ $trainingCalendarRegistration->last_name }}</td>
		</tr>

		<tr>
			<th>Telephone</th>
			<td>{{ $trainingCalendarRegistration->telephone }}</td>
		</tr>

		<tr>
			<th>Gender</th>
			<td>{{ $trainingCalendarRegistration->gender }}</td>
		</tr>

		<tr>
			<th>Address</th>
			<td>{{ $trainingCalendarRegistration->address }}</td>
		</tr>

		<tr>
			<th>Postal Code</th>
			<td>{{ $trainingCalendarRegistration->postal_code }}</td>
		</tr>

		<tr>
			<th>Town/City</th>
			<td>{{ $trainingCalendarRegistration->city }}</td>
		</tr>

		<tr>
			<th>Mobile</th>
			<td>{{ $trainingCalendarRegistration->mobile }}</td>
		</tr>

		<tr>
			<th>Email</th>
			<td>{{ $trainingCalendarRegistration->email }}</td>
		</tr>

		<tr>
			<th>Firm</th>
			<td>{{ $trainingCalendarRegistration->firm }}</td>
		</tr>

		<tr>
			<th>Bank Transfer Date</th>
			<td>{{ $trainingCalendarRegistration->bank_transfer_date }}</td>
		</tr>

		<tr>
			<th>Payment Method</th>
			<td>{{ $trainingCalendarRegistration->payment_method }}</td>
		</tr>

		<tr>
			<th>Receipt_no</th>
			<td>{{ $trainingCalendarRegistration->receipt_no }}</td>
		</tr>
	</table>

@endsection