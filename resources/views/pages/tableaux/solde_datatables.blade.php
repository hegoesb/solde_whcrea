{{-- Extends layout --}}
@extends('layout.default')
{{-- Styles Section --}}
@section('styles')
    {{-- fontawesome --}}
    <link href="{{ asset('/your-path-to-fontawesome/css/fontawesome.css') }}" rel="stylesheet" type="text/css"/>

    {{-- datatable --}}
    <link href="{{ asset('https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
        {{-- boutton --}}
        <link href="{{ asset('https://cdn.datatables.net/buttons/1.6.5/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
        {{-- Responsive --}}
        <link href="{{ asset('https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>

    {{-- <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/> --}}
@endsection


<link href="/your-path-to-fontawesome/css/fontawesome.css" rel="stylesheet">
{{-- Content --}}
@section('content')

<div class="row">

    @foreach ($soldes as $solde)
    <div class="col-lg-6 col-xxl-4">

        <div class="card card-custom {{ @$class }}">
            {{-- Header --}}
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">{{$solde['nom']}}</span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">Solde avec dépenses communes / Ajout dépense non prise en compte en écriture bancaire</span>
                </h3>
            </div>

            {{-- Body --}}
            <div class="card-body pt-3 pb-0">
                {{-- Table --}}
                <div class="table-responsive">
                    <table class="table table-borderless table-vertical-center">
                        <thead>
                            <tr>
                                <th class="p-0" style="width: 50px"></th>
                                <th class="p-0" style="min-width: 200px"></th>
                                <th class="p-0" style="min-width: 100px"></th>
                                <th class="p-0" style="min-width: 125px"></th>
                                <th class="p-0" style="min-width: 110px"></th>
                                <th class="p-0" style="min-width: 150px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="pl-0 py-4">
                                    <div class="symbol symbol-50 symbol-light mr-1">
                                        <span class="symbol-label">
                                            <img src="{{ asset($solde['Solde'][2]) }}" class="h-50 align-self-center"/>
                                        </span>
                                    </div>
                                </td>
                                <td class="pl-0">
                                    <div>
                                        <span class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$solde['Solde'][1]}}</span>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                        {{$solde['Solde'][0]}}€
                                    </span>
                                </td>
                            </tr>
                            @foreach ($solde['Dépense'] as $depense)
                            <tr>
                                <td class="pl-0 py-4">
                                    <div class="symbol symbol-50 symbol-light mr-1">
                                        <span class="symbol-label">
                                            <img src="{{ asset($depense[2]) }}" class="h-50 align-self-center"/>
                                        </span>
                                    </div>
                                </td>
                                <td class="pl-0">
                                    <div>
                                        <span class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$depense[1]}}</span>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                        {{$depense[0]}}€
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td class="text-right">
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                    </span>
                                </td>
                                <td class="text-right">
                                    <div class="symbol symbol-50 symbol-light mr-1">
                                        <span class="symbol-label">
                                            <img src="{{ asset('media/svg/icons/Cooking/Dinner.svg') }}" class="h-50 align-self-center"/>
                                        </span>
                                    </div>
                                </td>

                                <td class="text-right">
                                    <span class="label label-lg label-light-primary label-inline font-size-lg text-dark-75 font-weight-bolder">{{$solde['Solde_F'][0]}}€</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @endforeach

    <div class="card card-custom bg-gray-100 {{ @$class }}">
        {{-- Header --}}
        <div class="card-header border-0 bg-danger py-5">
            <h3 class="card-title font-weight-bolder text-white">Solde Final</h3>
        </div>
        {{-- Body --}}
        <div class="card-body p-0 position-relative overflow-hidden">
            {{-- Chart --}}
            <div id="kt_mixed_widget_1_chart" class="card-rounded-bottom bg-danger" style="height: 200px"></div>

            {{-- Stats --}}
            <div class="card-spacer mt-n25">
                {{-- Row --}}
                <div class="row m-0">
                    <div class="col bg-light-primary px-6 py-8 rounded-xl mb-7">
                        {{ Metronic::getSVG("media/svg/icons/Communication/Add-user.svg", "svg-icon-3x svg-icon-primary d-block my-2") }}
                        <a href="#" class="text-dark-75  font-weight-bold font-size-h6 mt-2">
                            Remi doit à Fabien
                        </a>
                    </div>
                </div>
                {{-- Row --}}
                <div class="row m-0">
                    <div class="col bg-light-success px-6 py-8 rounded-xl">
                        {{ Metronic::getSVG("media/svg/icons/Communication/Urgent-mail.svg", "svg-icon-3x svg-icon-success d-block my-2") }}
                        <a href="#" class=" text-dark-75 font-weight-bold font-size-h6 mt-2">
                            {{$soldes['Fabien']['Solde_F'][0]-$soldes['Remi']['Solde_F'][0]}}€
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection



{{-- Scripts Section --}}
@section('scripts')
    {{-- datatable --}}
    <script src="{{ asset('https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
        {{-- boutton --}}
        <script src="{{ asset('https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('https://cdn.datatables.net/buttons/1.6.5/js/buttons.bootstrap4.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('https://cdn.datatables.net/buttons/1.6.5/js/buttons.colVis.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js') }}" type="text/javascript"></script>
        {{-- Responsive --}}
        <script src="{{ asset('https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js') }}" type="text/javascript"></script>
        {{-- Page length --}}
        {{-- <script src="{{ asset('https://code.jquery.com/jquery-3.5.1.js') }}" type="text/javascript"></script> --}}




    {{-- page scripts --}}
    {{-- <script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script> --}}
    {{-- <script src="{{ asset('js/app.js') }}" type="text/javascript"></script> --}}
    {{-- tooltips --}}
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/tooltipster/4.2.8/js/tooltipster.bundle.min.js') }}" type="text/javascript"></script>




@endsection
