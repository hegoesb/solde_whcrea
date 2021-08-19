@section('styles')
    {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/formvalidation/0.6.2-dev/css/formValidation.min.css') !!}
@endsection

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
    {!! Form::open(['url' => url('ajouter/'.$entreprise->id.'/factures'), 'id'=>'form_validation']) !!}
        <div class="card-body">
            <div class="form-group mb-8">
                <div class="alert alert-custom alert-default" role="alert">
                    <div class="alert-icon"><i class="flaticon-warning text-primary"></i></div>
                    <div class="alert-text">
                        {{$descriptif}}
                    </div>
                </div>
                @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            {!!Form::validation_text_minMaxLength_value('numero', 'Numéro',$entreprise->prefixe_facture,15,15,true,6)!!}
            {!!Form::validation_select($chantiers, 'chantier_id', 'Chantier',true,4)!!}
            {!!Form::validation_select($type_factures, 'type_facture_id', 'Type',true,4)!!}
            {!!Form::validation_select($collaborateurs, 'collaborateur_id', 'Personne en charge de la facture',true,4)!!}
            {!!Form::validation_text_maxLength('total_ht', 'Total HT',25,true,6)!!}
            {!!Form::validation_text_maxLength('total_ttc', 'Total TTC',25,true,6)!!}
            {!!Form::validation_date('date_creation', 'Date de création',true,4)!!}
            {!!Form::validation_date('date_echeance', 'Date d\'échéance',true,4)!!}
            {!!Form::validation_date('date_envoie', 'Date d\'envoie',false,4)!!}
            {!!Form::validation_text_commentaire('retenuegarantie_ht', 'Valeur de la retenue de garantie (HT)',false,4, 'A remplir si la retenue de garantie existe pour ce client')!!}
        </div>
        {!!Form::valider()!!}
    </form>
    <!--end::Form-->
</div>


@endsection

{{-- Scripts Section --}}
@section('scripts')
    {!! Html::script('js/pages/crud/forms/validation/form-controls.js') !!}
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
