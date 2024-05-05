@extends('layouts.admin-view-index')
@section('content')

<a href="javascript:history.back()" class="text-dark" style="font-size: 20px"><i class='fas fa-chevron-left' style='font-size:24px'></i>Back</a><br>

    <h2><u><span style="color: blueviolet">{{ $selectedDate }}</span> - Time Slots</u></h2><br>
    @if ($timeSlots->isEmpty())
        <p>No time slots available.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($timeSlots as $time)
                    <tr>
                        <td>{{ $time->start_time }} - {{ $time->end_time }}</td>
                        <td>
                            @if ($time->status == 0)
                                Pending
                            @elseif ($time->status == 1)
                            <span style="color: green;">Booked</span>
                            @endif
                            <td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection
