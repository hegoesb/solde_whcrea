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
                        <th data-toggle="tooltip" data-theme="dark" title="Relevé Bancaire">RB</th>
                        <th>Date</th>
                        <th>Libellé</th>
                        <th>Débit</th>
                        <th>Crédit</th>
                        <th data-toggle="tooltip" data-theme="dark" title="Dépensé Par">Par</th>
                        <th data-toggle="tooltip" data-theme="dark" title="Type dépense">Type</th>
                        <th>Projet</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($data)
                        @foreach ($data as $key => $value)
                            {{-- <tr class="gradeX {{ $value['justificatif']==1 ? '' : 'text-danger' }}"> --}}
                            <tr class="gradeX">
                                <td>{{$value['id']}}</td>
                                <td>{{$value['num_releve']}}</td>
                                <td>{{$value['dateo']}}</td>
                                <td>{{$value['label']}}</td>
                                <td class="text-danger">{{$value['debit']}}</td>
                                <td class="text-primary">{{$value['credit']}}</td>
                                <td>{{$value['depense_par']}}</td>
                                <td>{{$value['type_depense']}}</td>
                                <td>{{$value['projet']}}</td>
                            </tr>
                        @endforeach
                    @endisset
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>RB</th>
                        <th>Date</th>
                        <th>Libellé</th>
                        <th id="Debit" class="text-danger">Débit</th>
                        <th id="Credit" class="text-primary">Crédit</th>
                        <th>Par</th>
                        <th>Type</th>
                        <th>Projet</th>
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
                    this.api().columns([1,2,6,7,8]).every( function () {
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
                "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
                //Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1 : typeof i === 'number' ?  i : 0;
                };
                //total_salary over all pages
                total_debit = api.column( 4 ).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
                },0 );
                total_credit = api.column( 5 ).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
                },0 );
                //total_page_salary over this page
                total_page_debit = api.column( 4, { page: 'current'} ).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
                }, 0 );
                total_page_debit = parseFloat(total_page_debit);
                total_page_credit = api.column( 5, { page: 'current'} ).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
                }, 0 );
                total_page_credit = parseFloat(total_page_credit);
                // total_salary = parseFloat(total_salary);
                //Update footer
                $('#Debit').html(''+total_page_debit.toFixed(2));
                $('#Credit').html(''+total_page_credit.toFixed(2));
                // $('#totalSalary').html('D= '+total_page_salary.toFixed(2)+"<br> T= "+total_salary.toFixed(2));
                },


            });
        });
        $('[data-toggle="tooltip"]').tooltip({container:"body"})
    </script>


@endsection
