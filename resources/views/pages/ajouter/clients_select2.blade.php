{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')


<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">{{$titre}}</h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
            </div>
        </div>
    </div>
    <!--begin::Form-->
    {!! Form::open(['url' => url('ajouter/'.$entreprise_id.'/clients'), 'id'=>'form_validation']) !!}
        <div class="card-body">
            <div class="form-group mb-8">
                <div class="alert alert-custom alert-default" role="alert">
                    <div class="alert-icon"><i class="flaticon-warning text-primary"></i></div>
                    <div class="alert-text">
                        {{$descriptif}}
                    </div>
                </div>
            </div>
            {!!Form::validation_select($type_client, 'type_client_id', 'Type',true,4)!!}
            {!!Form::validation_text_maxLength('nom', 'Nom',10,true,6)!!}
            {!!Form::validation_text_maxLength('nom_display', 'Nom Complet',40,true,6)!!}
            @foreach ($choix_entreprise as $key => $value)
                {!!Form::switch('entreprise_'.$value[0], $value[1],4,)!!}
            @endforeach

            {{-- {!!Form::validation_checkboxe($choix_entreprise,'Entreprise',true,6)!!} --}}
        </div>
        {!!Form::valider()!!}
    </form>
    <!--end::Form-->
</div>


@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
