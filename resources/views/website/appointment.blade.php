@extends('home')
@section('title')
	Appointments
@endsection
@section('content')
<div class="container bootstrap snippet">
<br>
<h1 class="mb-5 text-center">List Of Appointments</h1>
<div class="row">
	<div class="col-sm-12">
    <table class="table-fill">
      <thead>
        <tr>
          <th class="text-left">Doctor Name</th>
          <th class="text-left">Date</th>
          <th class="text-left">Time</th>
          <th class="text-left">Accept/Reject</th>
        </tr>
      </thead>
      <tbody class="table-hover">
        @foreach($appointments as $appointment)
        <tr>
          <td class="text-left">{{$appointment->doctorInfo->doctor_first_name}} {{$appointment->doctorInfo->doctor_last_name}}</td>
          <td class="text-left">{{$appointment->appointment_date}}</td>
          <td class="text-left">{{$appointment->appointment_time}}</td>
          <td class="text-left" id="{{ $appointment->appointment_id }}">
            @if($appointment->status_id == 1)
            <button type="button" class="btn btn-success alertStatus" data-id="{{ $appointment->appointment_id }}" data-status="2">Accept</button>
            <button type="button" class="btn btn-danger alertStatus" data-id="{{ $appointment->appointment_id }}" data-status="3">Reject</button>
            @elseif($appointment->status_id == 2)
            <button type="button" class="btn btn-success disabled">Accept</button>
            @else
            <button type="button" class="btn btn-danger disabled">Rejected</button>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
</div>
@endsection