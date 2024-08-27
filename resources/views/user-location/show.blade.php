<x-bootstrap title="">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">UserLocation {{ $userlocation->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/user-location') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/user-location/' . $userlocation->id . '/edit') }}" title="Edit UserLocation"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('userlocation' . '/' . $userlocation->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete UserLocation" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $userlocation->id }}</td>
                                    </tr>
                                    <tr><th> Title </th><td> {{ $userlocation->title }} </td></tr><tr><th> Address </th><td> {{ $userlocation->address }} </td></tr><tr><th> Latitude </th><td> {{ $userlocation->latitude }} </td></tr><tr><th> Longitude </th><td> {{ $userlocation->longitude }} </td></tr><tr><th> Owner </th><td> {{ $userlocation->owner }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-bootstrap>