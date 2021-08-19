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
    {!! Form::open(['url' => url('modifier/'.$entreprise->id.'/chantiers/'.$chantier->id), 'id'=>'form_validation']) !!}
        <div class="card-body">
            <div class="form-group mb-8">
                <div class="alert alert-custom alert-default" role="alert">
                    <div class="alert-icon"><i class="flaticon-warning text-primary"></i></div>
                    <div class="alert-text">
                        {{$descriptif}}
                    </div>
                </div>
            </div>
            {!!Form::validation_text_disabled('identifiant', 'Identifiant',$chantier->identifiant,true,4)!!}
            {!!Form::validation_text_maxLength_value('nom', 'Nom',$chantier->nom,15,true,4)!!}
            {!!Form::validation_text_maxLength_value('libelle', 'Libellé',$chantier->libelle,50,true,4)!!}
            {!!Form::validation_selected($choix_client, 'client_id', 'Client',true,4)!!}
            {!!Form::validation_selected($choix_etape, 'etape_chantier_id', 'Etape du chantier',true,4)!!}
            {!!Form::validation_date_value('date_debut', 'Date début', $chantier->date_debut,true,4)!!}
        </div>
        {!!Form::modifier($lien)!!}
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
