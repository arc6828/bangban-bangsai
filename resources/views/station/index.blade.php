<x-leaf.theme mode="navbar-light" title="สถานี"
    description="บทความที่เกี่ยวข้องกับงายวิจัย ความรู้ที่เป็นประโยชน์และต้องการเผยแพร่สู่สาธารณะ"
    image="https://cdn-images-1.medium.com/max/1024/1*pnw6OuU-R4JXzgUUPWbmbg.jpeg">

    <section class="section section-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="h1 text-center">สถานี</div>
                        <div class="card-body">
                            <div class="row d-none">
                                <div class="col-lg-9">
                                    <a href="{{ url('/station/create') }}" class="btn btn-success btn-sm"
                                        title="Add New Station">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                    </a>
                                </div>
                                <div class="col-lg-3">
                                    <form method="GET" action="{{ url('/station') }}" accept-charset="UTF-8"
                                        class="form-inline my-2 my-lg-0 float-right" role="search">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search"
                                                placeholder="Search..." value="{{ request('search') }}">
                                            <span class="input-group-append">
                                                <button class="btn btn-secondary" type="submit">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <br />
                            <br />
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>รหัสสถานี</th>
                                            <th>ชื่อสถานี</th>
                                            <th>ละติจูด</th>
                                            <th>ลองจิจูด</th>
                                            <th>การดำเนินการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($station as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->code }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->latitude }}</td>
                                                <td>{{ $item->longitude }}</td>
                                                <td>
                                                    <a href="{{ url('/place/' . $item->code) }}"
                                                        title="View Station"><button class="btn btn-info btn-sm"><i
                                                                class="fa fa-eye" aria-hidden="true"></i>
                                                            รายละเอียด</button></a>
                                                    {{-- <a href="{{ url('/station/' . $item->id . '/edit') }}"
                                                        title="Edit Station"><button class="btn btn-primary btn-sm"><i
                                                                class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                            Edit</button></a> --}}

                                                    <form method="POST"
                                                        action="{{ url('/station' . '/' . $item->id) }}"
                                                        accept-charset="UTF-8" style="display:inline">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            title="Delete Station"
                                                            onclick="return confirm('Confirm delete?')">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                            ลบ</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination-wrapper"> {!! $station->appends(['search' => Request::get('search')])->render() !!} </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-leaf.theme>
