@extends('admin.master')
@section('content')

<div class="container">

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <button style="margin: 5px;" class="btn btn-danger btn-xs delete-all" data-url="">Delete All</button>
    <table class="table table-bordered">
        <tr>
            <th><input type="checkbox" id="check_all"></th>
            <th>S.No.</th>
            <th>Name</th>
            <th>email</th>
            <th>Mobile</th>
            <th>status</th>
            <th width="100px">Action</th>
        </tr>

        @if($coustomers)
        @foreach($coustomers as $key => $coustomer)
        <tr id="tr_{{$coustomer->id}}">
            <td><input type="checkbox" class="checkbox" data-id="{{$coustomer->id}}"></td>
            <td>{{ ++$key }}</td>
            <td>{{ $coustomer->first_name }} {{ $coustomer->last_name }}</td>
            <td>{{ $coustomer->email }}</td>
            <td>{{ $coustomer->mobile }}</td>
            <td>{{ $coustomer->status }}</td>
            <td>
                <form action="{{route('coustomerDelete',$coustomer->id)}}" method="POST" style='display:inline'>

                    @csrf
                    @method('DELETE')

                    <button type="submit" data-toggle='confirmation' ,data-placement='left' class="btn
                        btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        @endif
    </table>
</div>
</body>
<script type="text/javascript">
$(document).ready(function() {
    $('#check_all').on('click', function(e) {
        if ($(this).is(':checked', true)) {
            $(".checkbox").prop('checked', true);
        } else {
            $(".checkbox").prop('checked', false);
        }
    });
    $('.checkbox').on('click', function() {
        if ($('.checkbox:checked').length == $('.checkbox').length) {
            $('#check_all').prop('checked', true);
        } else {
            $('#check_all').prop('checked', false);
        }
    });
    $('.delete-all').on('click', function(e) {
        var idsArr = [];
        $(".checkbox:checked").each(function() {
            idsArr.push($(this).attr('data-id'));
        });
        if (idsArr.length <= 0) {
            alert("Please select atleast one record to delete.");
        } else {
            if (confirm("Are you sure, you want to delete the selected categories?")) {
                var strIds = idsArr.join(",");
                $.ajax({
                    url: "{{ route('coustomerMulipleDestroy') }}",
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: 'ids=' + strIds,
                    success: function(data) {
                        if (data['status'] == true) {
                            $(".checkbox:checked").each(function() {
                                $(this).parents("tr").remove();
                            });
                            alert(data['message']);
                        } else {
                            alert('Whoops Something went wrong!!');
                        }
                    },
                    error: function(data) {
                        alert(data.responseText);
                    }
                });
            }
        }
    });
    $('[data-toggle=confirmation]').confirmation({
        rootSelector: '[data-toggle=confirmation]',
        onConfirm: function(event, element) {
            element.closest('form').submit();
        }
    });
});
</script>
@endsection