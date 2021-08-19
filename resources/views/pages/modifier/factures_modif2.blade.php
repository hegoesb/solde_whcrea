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
    {!! Form::open(['url' => url('modifier/'.$entreprise->id.'/factures/'.$facture->id), 'id'=>'form_validation']) !!}
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
            {!!Form::validation_text_minMaxLength_value('numero', 'Numéro',$facture->numero,15,15,true,4)!!}
            {!!Form::validation_selected($chantiers, 'chantier_id', 'Chantier',true,4)!!}
            {!!Form::validation_selected($type_factures, 'type_facture_id', 'Type',true,4)!!}
            {!!Form::validation_selected($collaborateurs, 'collaborateur_id', 'Personne en charge de la facture',true,4)!!}
            {!!Form::validation_text_maxLength_value('total_ht', 'Total HT',$facture->total_ht,25,true,4)!!}
            {!!Form::validation_text_maxLength_value('total_ttc', 'Total TTC',$facture->total_ttc,25,true,4)!!}
            {!!Form::validation_date_value('date_creation', 'Date de création',$facture->date_echeance,true,4)!!}
            {!!Form::validation_date_value('date_echeance', 'Date d\'échéance',$facture->date_echeance,true,4)!!}
            {!!Form::validation_date_value('date_envoie', 'Date d\'envoie',$facture->date_envoie,false,4)!!}
            {!!Form::validation_text_value('retenuegarantie_ht', 'Valeur de la retenue de garantie (HT)',$facture->retenuegarantie_ht==null ? 0 : $facture->retenuegarantie_ht,false,4, )!!}
        </div>
        {!!Form::modifier($lien)!!}
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
