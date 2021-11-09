@foreach ($asistances as $attendance)
    <div>
        <p>{{ $attendance->full_name }}</p>
        <br>
        <img style="width: 400px" src="storage/uploads/{{ $attendance->image }}">
    </div>
    <br>
@endforeach
