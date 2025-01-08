@extends('layouts.email')

@section('content')
	@if(strtolower($salutation) == "admin")
	<p>An arbitration request has been received. Below are the details.</p>
	@else
		<p>Dear {{ $salutation }},</p>
		<p>Your request for arbitrtion has been received. NCIA will review the application and contact you in due time. Below is a copy of the application details you provided.</p>
	@endif

	<p><strong>1. Claimant's Representative</strong></p>
	
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
	

	<p><strong>2. Respondent's Representative</strong></p>
	
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

	<p><strong>3. Dispute Details</strong></p>
	
	<table class = "table table-striped">
		<tr>
			<th>1. Brief explanation of the nature of dispute, the amount involved, if any, and the specific relief sought</th>
			<td>{{ $request->nature_of_dispute }}</td>
		</tr>
		
		<tr>
			<th>2. Reference to a mediation clause in the manner specified in Part A set out in the First Schedule or a copy of the separate mediation agreement.</th>
			<td>{{ $request->mediation_clause }}</td>
		</tr>

		<tr>
			<th>3. Reference to the contract or other legal relationship out of or in relation to which the dispute arises.</th>
			<td>{{ $request->contract }}</td>
		</tr>
	</table>

	

@endsection