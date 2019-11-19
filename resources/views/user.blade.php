<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('public/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css">

</head>
<body>
@if(count($user) > 0)

    <br>
    <h3 align="center" class="header-text">Search </h3>
    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <div class="form-group{{ $errors->has('username') ? ' has-error' : "" }}">
                User Name : <input type="text" value="{{Request::old('username')}}" class="form-control"
                                   name="last_name" placeholder="Enter You  User Name" id="user_name" >
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : "" }}">
                        First Name : <input type="text" value="{{Request::old('first_name')}}" class="form-control"
                                            name="first_name" placeholder="Enter You First Name" id="first_name" >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : "" }}">
                        Last Name : <input type="text" value="{{Request::old('last_name')}}" class="form-control"
                                           name="last_name" placeholder="Enter You  Last Name" id="last_name" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('gender') ? ' has-error' : "" }}">
                        Gender : <input type="text" value="{{Request::old('gender')}}" class="form-control"
                                        name="gender" placeholder="Enter You Gender" id="gender" >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('status') ? ' has-error' : "" }}">
                        Status : <input type="text" value="{{Request::old('status')}}" class="form-control"
                                        name="status" placeholder="Enter You  Status" id="status" >
                    </div>
                </div>
            </div>
            <div align="center">
                <button type="submit" class="btn btn-primary btn-lg" id="done"
                        onclick="Search()">Search
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-1">
    </div>
    <div align="center" class="col-md-12 table-responsive">
        <table id="example" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th class="center">User Name</th>
                <th class="center">first name</th>
                <th class="center">last name</th>
                <th class="center">gender</th>
                <th class="center">status</th>
            </tr>
            </thead>
            <tbody id="example1">

            @foreach($user as $users)

                <tr>
                    <td class="center">{{ $users->username }}</td>
                    <td class="center">{{ $users->first_name }}</td>
                    <td class="center">{{ $users->last_name }}</td>
                    <td class="center">{{$users->gender}}</td>
                    <td class="center">{{$users->status}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
        {{ $user->links() }}
    </div>
@else
    <div class="empty">There is no User to show</div>
@endif
</body>
<script>

    function Search() {

        var user_name = $('#user_name').val();
        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        var gender = $('#gender').val();
        var status = $('#status').val();
if(user_name != null)
{
        $.ajax({
            type: "GET",
            url: "{{url('filter')}}",
            cache: false,
            data: {
                'user_name': user_name,
                'first_name': first_name,
                'last_name': last_name,
                'gender': gender,
                'status': status,
            },
            success: function (data) {

                if (data.length != 0) {
                    $('#example1').empty();

                    for ($i = 0; $i < data.length; $i++) {
                        $("#example1").append('<td class="center">' + data[$i].user_name + '</td>'
                            + '<td class="center">' + data[$i].first_name + '</td>'
                            + '<td class="center">' + data[$i].last_name + '</td>'
                            + '<td class="center">' + data[$i].gender + '</td>'
                            + '<td class="center">' + data[$i].status + '</td>');
                    }
                } else {
                    $('#example1').empty();
                }
            },
        });
}
    }
</script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{asset('public/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/js/dataTables.bootstrap.min.js')}}"></script>
<script>
    $(document).ready(function () {

        $('#example').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true,
        });
    });
</script>
</html>




