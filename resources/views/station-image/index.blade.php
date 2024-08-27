<x-leaf.theme mode="navbar-light" title="ภาพถ่ายสถานี"
    description="บทความที่เกี่ยวข้องกับงายวิจัย ความรู้ที่เป็นประโยชน์และต้องการเผยแพร่สู่สาธารณะ"
    image="https://cdn-images-1.medium.com/max/1024/1*pnw6OuU-R4JXzgUUPWbmbg.jpeg">
    <section class="section section-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="h1 text-center">ภาพถ่ายสถานี</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-9">
                                    <a href="{{ url('/station-image/create') }}" class="btn btn-success btn-sm"
                                        title="Add New StationImage">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                    </a>
                                </div>
                                <div class="col-lg-3">
                                    <form method="GET" action="{{ url('/station-image') }}" accept-charset="UTF-8"
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
                                            <th>ภาพถ่าย</th>
                                            <th>เจ้าของภาพ</th>
                                            <th>สถานี</th>
                                            <th>การดำเนินการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($stationimage as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a href="{{ $item->url }}" target="_blank"><img src="{{ $item->url }}" height="100" /></a></td>
                                                <td>{{ $item->owner }}</td>
                                                <td>{{ $item->station_code }}</td>
                                                <td>
                                                    {{-- <a href="{{ url('/station-image/' . $item->id) }}"
                                                        title="View StationImage"><button class="btn btn-info btn-sm"><i
                                                                class="fa fa-eye" aria-hidden="true"></i>
                                                            View</button></a> --}}
                                                    <a href="{{ route('place.show' , $item->station_code) }}" title="Place">
                                                        <button class="btn btn-info btn-sm">
                                                            <i class="fa fa-map" aria-hidden="true"></i> Place
                                                        </button>
                                                    </a>
                                                    <a href="{{ url('/station-image/' . $item->id . '/edit') }}"
                                                        title="Edit StationImage"><button
                                                            class="btn btn-primary btn-sm"><i
                                                                class="fa fa-edit" aria-hidden="true"></i>
                                                            Edit</button></a>

                                                    <form method="POST"
                                                        action="{{ url('/station-image' . '/' . $item->id) }}"
                                                        accept-charset="UTF-8" style="display:inline">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            title="Delete StationImage"
                                                            onclick="return confirm('Confirm delete?')"><i
                                                                class="fa fa-trash" aria-hidden="true"></i>
                                                            Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination-wrapper"> {!! $stationimage->appends(['search' => Request::get('search')])->render() !!} </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-leaf.theme>
