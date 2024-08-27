<x-bootstrap title="">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">LineUser {{ $lineuser->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/line-user') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/line-user/' . $lineuser->id . '/edit') }}" title="Edit LineUser"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('lineuser' . '/' . $lineuser->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete LineUser" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $lineuser->id }}</td>
                                    </tr>
                                    <tr><th> UserId </th><td> {{ $lineuser->userId }} </td></tr><tr><th> DisplayName </th><td> {{ $lineuser->displayName }} </td></tr><tr><th> PictureUrl </th><td> {{ $lineuser->pictureUrl }} </td></tr><tr><th> StatusMessage </th><td> {{ $lineuser->statusMessage }} </td></tr><tr><th> Language </th><td> {{ $lineuser->language }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-bootstrap>