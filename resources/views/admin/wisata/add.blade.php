@extends('layouts.app')

@section('content')
    {{-- //head --}}
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Add Wisata</h3>

            </div><!-- .nk-block-head-content -->

        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->

    {{-- body --}}
    <div class="nk-block">
        <div class="row mt-3">
            <div class="card card-bordered p-3">
                <div class="card-body">
                    <!-- Button trigger modal -->
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-5">
                                <div id='map' style='width: 60vh; height: 500px;'></div>
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Nama Wisata</label>
                                    <input type="text" class="form-control" required id="exampleFormControlInput1"
                                        placeholder="Nama Wisata">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Kategory Wisata</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        @foreach ($category as $item)
                                            <option value="{{ $item->id }}">{{ $item->category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Alamat Wisata</label>
                                    <textarea class="form-control" required id="exampleFormControlTextarea1" rows="2"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Latitude Wisata</label>
                                    <input type="text" class="form-control" required id="latitude"
                                        placeholder="latitude">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Longitude Wisata</label>
                                    <input type="text" class="form-control" required id="longitude"
                                        placeholder="longitude">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Jam Operasi Wisata</label>
                                    <input type="text" class="form-control" required placeholder="04:00 AM - 04:00 PM">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Wisata</label>
                                    <textarea class="form-control" required id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                <div class="form-group increment">
                                    <label for="">Photo</label>
                                    <div class="input-group">
                                        <input type="file" name="pp[]" class="form-control">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-primary btn-add"><i
                                                    class="fas fa-plus-square"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="clone invisible">
                                    <div class="input-group mt-2">
                                        <input type="file" name="pp[]" class="form-control">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-danger btn-remove"><i
                                                    class="fas fa-minus-square"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary col-12">Simpan Data</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- .nk-block -->
@endsection


@push('script')
    <script>
        jQuery(document).ready(function() {
            jQuery(".btn-add").click(function() {
                let markup = jQuery(".invisible").html();
                jQuery(".increment").append(markup);
            });
            jQuery("body").on("click", ".btn-remove", function() {
                jQuery(this).parents(".input-group").remove();
            })
        })
        var marker;
        mapboxgl.accessToken = 'pk.eyJ1IjoiemVuejIzIiwiYSI6ImNrdWY2aTdqbTFya3Ayb25uMnZwZWxtZGsifQ.-oQuHPuerUpLLNSVmAASnQ';
        const location112 = [106.625141, -6.618823, ];
        var map = new mapboxgl.Map({
            container: 'map',
            center: location112,
            zoom: 11.5,
            style: 'mapbox://styles/mapbox/streets-v11'
        });

        map.on('click', (e) => {

            const latitude = e.lngLat.lat
            const longitude = e.lngLat.lng
            document.getElementById("latitude").value = latitude;
            document.getElementById("longitude").value = longitude;
            if (marker) {
                marker.setLngLat([longitude, latitude])
                    .addTo(map);
            } else {
                marker = new mapboxgl.Marker({
                        color: "#FFFFFF",
                    }).setLngLat([longitude, latitude])
                    .addTo(map);
            }
        });
        // var coor = {
        //   !!json_encode($category - > toArray()) !!
        //};
        //   coor.forEach(element => {
        //     console.log(element);
        //  });
        map.addControl(
            new mapboxgl.GeolocateControl({
                positionOptions: {
                    enableHighAccuracy: true
                },
                trackUserLocation: true
            })
        );
        map.addControl(new mapboxgl.NavigationControl());
    </script>
@endpush
