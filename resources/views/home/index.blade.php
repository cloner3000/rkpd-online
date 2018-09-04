@extends('layouts.master_admin')
@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto"><h3 class="m-subheader__title ">Dashboard</h3></div>
        </div>
    </div>
    <div class="m-content">
        <div class="m-portlet ">
            <div class="m-portlet__body  m-portlet__body--no-padding">
                <div class="row m-row--no-padding m-row--col-separator-xl">
                   @foreach($items as $key => $item)
                        <div class="col-md-12 col-lg-6 col-xl-4">
                            <!--begin::New Feedbacks-->
                            <div class="m-widget24">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">
                                        {{ get_name_tahapan($key) }}
                                    </h4>
                                    <br>
                                    <span class="m-widget24__desc">
                                        Usulan Kegiatan
                                    </span>
                                    <span class="m-widget24__stats m--font-info">
                                        {{ get_format_currency($item['total']) }}
                                    </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-info" role="progressbar" style="width: {{ get_percent($item['total'], $item['transfer']) }};" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="m-widget24__change">
                                        Transfer
												</span>
                                    <span class="m-widget24__number">
                                        {{ get_percent($item['total'], $item['transfer']) }}
                                    </span>
                                </div>
                            </div>
                            <!--end::New Feedbacks-->
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer.javascript')
    <script src="{{ asset('/metronic/assets/app/js/dashboard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/metronic/assets/vendors/custom/fullcalendar/fullcalendar.bundle.js') }}" type="text/javascript"></script>
@endpush
