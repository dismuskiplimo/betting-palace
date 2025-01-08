hbhbbhbh@extends('layouts.email')

@section('content')
	@if(strtolower($salutation) == "admin")
	<p>A new {{ $panel->panel_type }} panel status application has been received. Below are the details.</p>
	@else
		<p>Dear {{ $salutation}},</p>
		<p>Your {{ $panel->panel_type }} panel status application has been received. NCIA will review the application and contact you in due time. Below is a copy of the application details you provided.</p>
	@endif

	<p><strong>1. Personal Information</strong></p>
	<table class = "table table-striped">
		<tr>
			<th>Panel</th>
			<td>{{ ucfirst($panel->panel_type) }} panel status</td>
		</tr>
		
		<tr>
			<th>First Name</th>
			<td>{{ $panel->first_name }}</td>
		</tr>

		<tr>
			<th>Middle Name</th>
			<td>{{ $panel->middle_name }}</td>
		</tr>

		<tr>
			<th>Last Name</th>
			<td>{{ $panel->last_name }}</td>
		</tr>

		<tr>
			<th>Panel Category</th>
			<td>{{ ucfirst($panel->panel_category) . ' ' . $panel->panel_type }}</td>
		</tr>

		<tr>
			<th>Nationality</th>
			<td>{{ $panel->nationality }}</td>
		</tr>

		<tr>
			<th>ID/Pssport Number</th>
			<td>{{ $panel->id_no }}</td>
		</tr>

		<tr>
			<th>Other Nationality</th>
			<td>{{ $panel->other_nationality }}</td>
		</tr>

		<tr>
			<th>Other ID/Pssport Number</th>
			<td>{{ $panel->other_id_no }}</td>
		</tr>

		<tr>
			<th>Mailing/Physical Address</th>
			<td>{{ $panel->mailing_address }}</td>
		</tr>

		<tr>
			<th>Firm</th>
			<td>{{ $panel->firm }}</td>
		</tr>

		<tr>
			<th>Mailing country</th>
			<td>{{ $panel->mailing_country }}</td>
		</tr>

		<tr>
			<th>City</th>
			<td>{{ $panel->city }}</td>
		</tr>

		<tr>
			<th>Postal code</th>
			<td>{{ $panel->postal_code }}</td>
		</tr>

		<tr>
			<th>Telephone</th>
			<td><a href="tel:{{ $panel->phone }}"></a>{{ $panel->phone }}</td>
		</tr>

		<tr>
			<th>Fax</th>
			<td>{{ $panel->fax }}</td>
		</tr>

		<tr>
			<th>Email</th>
			<td><a href="mailto:{{ $panel->email }}"></a>{{ $panel->email }}</td>
		</tr>

		<tr>
			<th>Primary occupation</th>
			<td>{{ $panel->occupation }}</td>
		</tr>
	</table>

	<p><strong>2. Education</strong></p>
	
	<p>i) Academic Qualifications</p>
	
	@if ($panel->academicQualifications()->count())
		<table class = "table table-striped">
			<thead>
				<th>Year Awarded</th>
				<th>Degree/Certificate</th>
				<th>Institution</th>
			</thead>

			<tbody>
				@foreach ($panel->academicQualifications()->get() as $academicQualification)
					<tr>
						<td>{{ $academicQualification->year }}</td>
						<td>{{ $academicQualification->degree }}</td>
						<td>{{ $academicQualification->institution }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<p class="text-muted">None</p>
	@endif

	<p>ii) Mediation Training</p>
	
	@if ($panel->training()->count())
		<table class="table table-striped">
			<thead>
				<th>Year Awarded</th>
				<th>Nature of training</th>
				<th>Institution</th>
			</thead>

			<tbody>
				@foreach ($panel->training()->get() as $training)
					<tr>
						<td>{{ $training->year }}</td>
						<td>{{ $training->nature }}</td>
						<td>{{ $training->institution }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<p class="text-muted">None</p>
	@endif

	<p>iii) Other Training</p>

	@if ($panel->otherTraining()->count())
		<table class = "table table-striped">
			<thead>
				<th>Year Awarded</th>
				<th>Nature of training</th>
				<th>Institution</th>
			</thead>

			<tbody>
				@foreach ($panel->otherTraining()->get() as $training)
					<tr>
						<td>{{ $training->year }}</td>
						<td>{{ $training->nature }}</td>
						<td>{{ $training->institution }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<p class="text-muted">None</p>
	@endif

	<p><strong>3. {{ $panel->panel_type == 'arbitrator' ? 'Arbitration' : 'Mediation' }} Experience</strong></p>

	<table class="table table-striped">
		<thead>
			<th></th>
			<th>Commercial</th>
			<th>Construction</th>
			<th>Investor/State</th>
			<th>Other(Special)</th>
		</thead>

		<tbody>
			<tr>
				<th>Sole {{ $panel->panel_type }}</th>
				<td>{{ $panel->sole_commercial }}</td>
				<td>{{ $panel->sole_construction }}</td>
				<td>{{ $panel->sole_investor }}</td>
				<td>{{ $panel->sole_other }}</td>
			</tr>

			<tr>
				<th>{{ $panel->panel_type == 'arbitrator' ? 'Member arbitrator panel' : 'Co-mediator' }}</th>
				<td>{{ $panel->member_commercial }}</td>
				<td>{{ $panel->member_construction }}</td>
				<td>{{ $panel->member_investor }}</td>
				<td>{{ $panel->member_other }}</td>
			</tr>

			<tr>
				<th>Counsel/Agent</th>
				<td>{{ $panel->counsel_commercial }}</td>
				<td>{{ $panel->counsel_construction }}</td>
				<td>{{ $panel->counsel_investor }}</td>
				<td>{{ $panel->counsel_other }}</td>
			</tr>
		</tbody>
	</table>

	<p><strong>4. Disputes handled</strong></p>

	@if ($panel->disputes()->count())
		<table class = "table table-striped">
			<thead>
				<th>Type of dispute</th>
				<th>Issues</th>
				<th>Value of dispute</th>
				<th>Nature of evidence</th>
				<th>Duration of dispute</th>
			</thead>

			<tbody>
				@foreach ($panel->disputes()->get() as $dispute)
					<tr>
						<td>{{ $dispute->type }}</td>
						<td>{{ $dispute->issue }}</td>
						<td>{{ $dispute->value }}</td>
						<td>{{ $dispute->evidence }}</td>
						<td>{{ $dispute->duration }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<p class="text-muted">None</p>
	@endif

	<p>- Number of years you have acted as an Arbitrator: {{ $panel->years_acted }}</p>
	<p>- Certified/accredited {{ ucfirst($panel->panel_type) }} or listed in the panel of any other {{ $panel->panel_type == 'arbitration' ? 'arbitral/Arbitration' : 'mediation' }} institution? {{ $panel->certified ? 'Yes' : 'No' }}</p>
	<p>- Certification particulars: {{ $panel->certified_particulars }}</p>
	<p>- {{ $panel->panel_type == 'arbitrator' ? 'Arbitration' : 'Mediation' }} is primary practice? {{ $panel->primary_practice ? 'Yes' : 'No' }}</p>

	@if($panel->panel_type == 'arbitration')
		<p>- willing to be appointed as an Emergency Arbitrator? {{ $panel->willing_to_be_emergency_arbitrator ? 'Yes' : 'No' }}</p>
		<p>- Emergency arbitrator contact details</p>
		<p>- Tel No. {{ $panel->emergency_tel_no }}</p>
		<p>- Email Address {{ $panel->emergency_email }}</p>
		<p>- Physical Address {{ $panel->emergency_physical_address }}</p>
	@endif

	<p><strong>Other Information</strong></p>
	<p>i) Relevant Experience <br>{{ $panel->relevant_expereince }}</p>
	<p>ii) Preferred areas of practice as a(n) {{ ucfirst($panel->panel_type) }} <br>{{ $panel->preferred_areas }}</p>

	<p>Cirriculum Vitae (CV): <a href="{{ route('download', ['fileName' => $panel->cv_url]) }}">Download</a></p>
@endsection