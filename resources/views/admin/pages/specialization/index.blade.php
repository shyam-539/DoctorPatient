@extends('layouts.admin-index')
@section('content')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">

<h2><u>Specializations</u></h2>

@if(Session::has('success'))
    <p class="alert alert-success">{{ Session::get('success') }}</p>
@endif
@if(Session::has('error'))
    <p class="alert alert-danger">{{ Session::get('error') }}</p>
@endif

<p>Can Edit and Delete Specialization</p><br>
<table class="table table-striped">

    <tbody>
         @foreach ($data as $datas )
            <tr>
                <td>{{ $datas->specialization }}</td>
                <td><a href="{{route('admin.specialization.edit',['specialization'=>$datas->id])}}"><i class='far fa-edit'></i></a></td>
                <td><a href="javascript:void(0)" class="delete" data-id="{{ $datas->id }}" ><i class="fa fa-trash"></i></a></td>

            </tr>
        @endforeach
    </tbody>
</table>

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $('.delete').on('click', function () {
        // console.log($(this).data('id'));
        var $self = $(this);
        var id = $(this).data('id');
        if (confirm("Are you sure you want to delete this specialization?")) {
            $.ajax({
                url: '/admin/specialization/' + id,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $self.closest('tr').remove();
                },
                error: function(xhr, status, error) {
                    alert('Failed to delete specialization. Please try again.');
                }
            });
        }

    });

</script>

@endpush

@endsection
