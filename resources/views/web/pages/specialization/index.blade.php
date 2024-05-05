@extends('layouts.public-layout')
@section('content')
<table class="table">
    <h3><u>Specializations</u></h3>
    <p >These are the Specialization in our Hospital. You can <b>click on the specialization</b> to view our Doctors in each Specialization.</p><br>
    <tbody>
        <?php foreach ($specialization as $row) : ?>
            <tr>
                <td>
                    <a href="{{route('doctor.index',$row->id)}}" class=" text-dark" style="font-size: 18px"><i class='fas fa-calendar-check'></i>&nbsp;&nbsp;{{ $row->specialization }}</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
@endsection
