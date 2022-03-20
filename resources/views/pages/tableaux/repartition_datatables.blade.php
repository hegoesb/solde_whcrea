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

    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">{{$titre}}
                    <div class="text-muted pt-2 font-size-sm">{{$descriptif}}</div>
                </h3>
            </div>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover js-exportable" id="kt_datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Label</th>
                        <th>2017</th>
                        <th>2018</th>
                        <th>2019</th>
                        <th>2020</th>
                        <th>2021</th>
                        <th>2022</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($data)
                        @foreach ($data as $key => $value)
                            {{-- <tr class="gradeX {{ $value['justificatif']==1 ? '' : 'text-danger' }}"> --}}
                            <tr class="gradeX">
                                <td @isset($value['id'][1]) data-toggle="tooltip" data-theme="dark" title="{{$value['id'][1]}}" @endisset>{{$value['id'][0]}}</td>
                                <td @isset($value['nom'][1]) data-toggle="tooltip" data-theme="dark" title="{{$value['nom'][1]}}" @endisset>{{$value['nom'][0]}}</td>
                                <td @isset($value['2017'][1]) data-toggle="tooltip" data-theme="dark" title="{{$value['2017'][1]}}" @endisset>{{$value['2017'][0]}}</td>
                                <td @isset($value['2018'][1]) data-toggle="tooltip" data-theme="dark" title="{{$value['2018'][1]}}" @endisset>{{$value['2018'][0]}}</td>
                                <td @isset($value['2019'][1]) data-toggle="tooltip" data-theme="dark" title="{{$value['2019'][1]}}" @endisset>{{$value['2019'][0]}}</td>
                                <td @isset($value['2020'][1]) data-toggle="tooltip" data-theme="dark" title="{{$value['2020'][1]}}" @endisset>{{$value['2020'][0]}}</td>
                                <td @isset($value['2021'][1]) data-toggle="tooltip" data-theme="dark" title="{{$value['2021'][1]}}" @endisset>{{$value['2021'][0]}}</td>
                                <td @isset($value['2022'][1]) data-toggle="tooltip" data-theme="dark" title="{{$value['2022'][1]}}" @endisset>{{$value['2022'][0]}}</td>
                                <td @isset($value['total'][1]) data-toggle="tooltip" data-theme="dark" title="{{$value['total'][1]}}" @endisset>{{$value['total'][0]}}</td>
                            </tr>
                        @endforeach
                    @endisset
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Label</th>
                        <th>2017</th>
                        <th>2018</th>
                        <th>2019</th>
                        <th>2020</th>
                        <th>2021</th>
                        <th>2022</th>
                        <th>Total</th>
                    </tr>
                </tfoot>

            </table>
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

    <script>
        $(function () {
            //Exportable table
            $('.js-exportable').DataTable({
                dom: 'Bfrltip',
                responsive: true,
                buttons: [

                    {extend: 'copy', title: '{{$titre}}' },
                    {extend: 'csv', title: '{{$titre}}' },
                    {extend: 'excel', title: '{{$titre}}' },
                    {extend: 'pdf', title: '{{$titre}}'},
                    {extend: 'print', title: '{{$titre}}'}

                ],
                "lengthMenu": [[-1, 10, 25, 50,100], ["All", 10, 25, 50,100]],
                "order": [[ {{$colonne_order}}, '{{$ordre}}' ]],
                // "order": [[ 1, "asc" ]],
                "columnDefs": [
                    // { "orderable": false ,    "targets": [4]},
                    // { "width": "54px", "targets": 8 },
                ],
                "oLanguage": {
                  "sUrl": "//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json"
                },
                initComplete: function () {
                    this.api().columns([]).every( function () {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo( $(column.footer()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search( val ? '^'+val+'$' : '', true, false )
                                    .draw();
                            } );

                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        } );
                    } );
                },

            });
        });
        $('[data-toggle="tooltip"]').tooltip({container:"body"})
    </script>


@endsection
