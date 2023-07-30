@extends('layouts.app')

@section('content')
    {{-- //head --}}
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">List Wisata</h3>

            </div><!-- .nk-block-head-content -->

        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->

    {{-- body --}}
    <div class="nk-block">
        <div class="row mt-3">
            <div class="card card-bordered p-3">
                <div class="card-body">
                    <!-- Button trigger modal -->
                    <a href="{{ route('admin.wisata.add') }}" class="btn btn-primary mb-2">Add Wisata</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>number</th>
                                    <th>Nama Wisata</th>
                                    <th>Latitude</th>
                                    <th>Logitude</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Dibuat Oleh</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .nk-block -->
@endsection

@push('script')
    <script>
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '',
                columns: [{
                        data: 'no',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    },

                ]
            });
        });
    </script>
@endpush
