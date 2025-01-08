@extends('layouts.email')

@section('content')
	@if(strtolower($salutation) == "admin")
	<p>An arbitration request has been received. Below are the details.</p>
	@else
		<p>Dear {{ $salutation }},</p>
		<p>Your request for arbitrtion has been received. NCIA will review the application and contact you in due time. Below is a copy of the application details you provided.</p>
	@endif

	<p><strong>1. Business Details</strong></p>
	<table class = "table table-striped">
		<tr>
			<th>Business Name</th>
			<td>{{ $request->business_name }} panel status</td>
		</tr>
		
		<tr>
			<th>Nature of Business</th>
			<td>{{ $request->nature_of_business }}</td>
		</tr>

		<tr>
			<th>Business Email Address</th>
			<td><a href="mailto:{{ $request->business_email }}">{{ $request->business_email }}</a></td>
		</tr>

		<tr>
			<th>Location</th>
			<td>{{ $request->business_location }}</td>
		</tr>

		<tr>
			<th colspan="2">Address Details</th>
		</tr>

		<tr>
			<th>Postal Address</th>
			<td>{{ $request->postal_address }}</td>
		</tr>

		<tr>
			<th>Postal Code</th>
			<td>{{ $request->postal_code }}</td>
		</tr>

		<tr>
			<th>City/Town</th>
			<td>{{ $request->town }}</td>
		</tr>
	</table>

	<p><strong>2. Claimant's Representative</strong></p>
	
	<table class = "table table-striped">
		<tr>
			<th>Name</th>
			<td>{{ $request->claimant_name }} panel status</td>
		</tr>
		
		<tr>
			<th>Telephone</th>
			<td>{{ $request->claimant_telephone }}</td>
		</tr>

		<tr>
			<th>Fax</th>
			<td>{{ $request->claimant_fax }}</td>
		</tr>

		<tr>
			<th>Email</th>
			<td><a href="mailto:{{ $request->claimant_email }}">{{ $request->claimant_email }}</a></td>
		</tr>
	</table>
	

	<p><strong>3. Respondent's Representative</strong></p>
	
	<table class = "table table-striped">
		<tr>
			<th>Name</th>
			<td>{{ $request->respondent_name }} panel status</td>
		</tr>
		
		<tr>
			<th>Telephone</th>
			<td>{{ $request->respondent_telephone }}</td>
		</tr>

		<tr>
			<th>Fax</th>
			<td>{{ $request->respondent_fax }}</td>
		</tr>

		<tr>
			<th>Email</th>
			<td><a href="mailto:{{ $request->respondent_email }}">{{ $request->respondent_email }}</a></td>
		</tr>
	</table>

	<p><strong>4. Dispute Details</strong></p>
	
	<table class = "table table-striped">
		<tr>
			<th>Copy of Contract</th>
			<td><a href="{{ route('download', ['fileName' =>$request->contract]) }}">Download</a></td>
		</tr>
		
		<tr>
			<th>Brief statement describing the nature and circumstances of the dispute giving rise to the claim, and specifying the relief sought by the claimant against the respondent</th>
			<td>{{ $request->statement }}</td>
		</tr>

		<tr>
			<th>Statement specifying the seat and language of arbitration, as agreed to in writing by the parties or as proposed by the claimant to the respondent</th>
			<td>{{ $request->seat_and_language }}</td>
		</tr>

		<tr>
			<th>Confirmation document addressed to the Registrar, that copies of the request for arbitration and all supporting documents have been served on all parties to the arbitration and the means of service used or intended to be used</th>
			<td><a href="{{ route('download', ['fileName' => $request->confirmation_letter]) }}">Download</a></td>
		</tr>
	</table>

	<p><strong>5. Claimant's Nominee</strong></p>
	
	<table class = "table table-striped">
		<tr>
			<th>Name</th>
			<td>{{ $request->nominee_name }} panel status</td>
		</tr>
		
		<tr>
			<th>Nationality</th>
			<td>{{ $request->nominee_telephone }}</td>
		</tr>

		<tr>
			<th>Qualifications</th>
			<td>{{ $request->nominee_fax }}</td>
		</tr>

		<tr>
			<th>Telephone</th>
			<td>{{ $request->nominee_email }}</td>
		</tr>

		<tr>
			<th>Fax</th>
			<td>{{ $request->nominee_email }}</td>
		</tr>

		<tr>
			<th>Email</th>
			<td><a href="mailto:{{ $request->nominee_email }}">{{ $request->nominee_email }}</a></td>
		</tr>

		<tr>
			<th colspan="2">Address Details</th>
		</tr>

		<tr>
			<th>Postal Address</th>
			<td>{{ $request->nominee_postal_address }}</td>
		</tr>

		<tr>
			<th>Postal Code</th>
			<td>{{ $request->nominee_postal_code }}</td>
		</tr>

		<tr>
			<th>City/Town</th>
			<td>{{ $request->nominee_town }}</td>
		</tr>
	</table>

	

@endsection