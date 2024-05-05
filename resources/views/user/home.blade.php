@extends('layouts.user-view-index')
@section('content')
<table class="table">
    <h3><u>Specializations</u></h3>
    <p >These are the Specialization in our Hospital. You can click on the<b> specialization</b> to view our Doctors in each Specialization.</p><br>

    <tbody>
        <?php foreach ($specialization as $row) : ?>
            <tr>
                <td>
                    <a href="{{route('user.doctor.index',$row->id)}}" class=" text-dark"><i class='fas fa-calendar-check'></i>&nbsp;&nbsp;{{ $row->specialization }}</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

@endsection
