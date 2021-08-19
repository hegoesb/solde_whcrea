<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;

class FormMacroProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    //--------------------------------------------------//
    //                                                  //
    //                       Bouton                     //
    //                                                  //
    //--------------------------------------------------//


        Form::macro('valider', function()
        {
            return sprintf('
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">Valider</button>
                    <button type="reset" class="btn btn-secondary">Effacer</button>
                </div>'
            );
        });

        Form::macro('modifier', function($lien)
        {
            return sprintf('
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">Modifier</button>
                    <button type="button" onclick="window.location.href = \'%s\';" class="btn btn-secondary">Retour</button>
                </div>', $lien,
            );
        });

    //--------------------------------------------------//
    //                                                  //
    //                    Validation                    //
    //                                                  //
    //--------------------------------------------------//




        Form::macro('validation_checkboxe', function($input, $label, $required=true, $col=6 )
        {

            if($required==true){
                $required='required';
            }else{
                $required='';
            }


            foreach ($input as $key => $value) {
                if($key==0){
                    $options =
                        '<label class="checkbox">
                            <input type="checkbox"  name="'.$value[0].'"/>
                            <span></span>
                            '.$value[1].'
                        </label>';
                }else{
                    $options .=
                        '<label class="checkbox">
                            <input type="checkbox"  name="'.$value[0].'"/>
                            <span></span>
                            '.$value[1].'
                        </label>';
                }
            }

            return sprintf('
                <div class="form-group row">
                    <label class="col-2 col-form-label">%s</label>
                    <div class="col-%s col-form-label">
                        <div class="checkbox-list %s">
                            %s
                        </div>
                    </div>
                </div>
                ',  $label, $col, $required, $options,
            );
        });

        Form::macro('validation_text_commentaire', function($name, $label, $required=true, $col=6 , $commentaire=null)
        {

            if($required==true){
                $required='required';
            }else{
                $required='';
            }
            if($commentaire==null){
                $commentaire='';
            }else{
                $commentaire='<div class="help-info">'.$commentaire.'</div>';
            }


            return sprintf('
                <div class="form-group row">
                    <label  class="col-2 col-form-label">%s</label>
                    <div class="col-%s">
                        <input class="form-control" type="text" name="%s" %s/>
                    </div>
                    %s
                </div>
                ',  $label, $col, $name, $required, $commentaire,
            );
        });

        Form::macro('validation_text_value', function($name, $label, $value, $required=true, $col=6 )
        {

            if($required==true){
                $required='required';
            }else{
                $required='';
            }

            return sprintf('
                <div class="form-group row">
                    <label  class="col-2 col-form-label">%s</label>
                    <div class="col-%s">
                        <input class="form-control" type="text" name="%s" value="%s", %s/>
                    </div>
                </div>
                ',  $label, $col, $name, $value, $required,
            );
        });

        Form::macro('validation_text_disabled', function($name, $label, $value, $required=true, $col=6 )
        {

            if($required==true){
                $required='required';
            }else{
                $required='';
            }

            return sprintf('
                <div class="form-group row">
                    <label  class="col-2 col-form-label">%s</label>
                    <div class="col-%s">
                        <input class="form-control" type="text" disabled="disabled" name="%s" value="%s", %s/>
                    </div>
                </div>
                ',  $label, $col, $name, $value, $required,
            );
        });


        Form::macro('validation_text_maxLength', function($name, $label, $maxlength=10, $required=true, $col=6 )
        {

            if($required==true){
                $required='required';
            }else{
                $required='';
            }

            return sprintf('
                <div class="form-group row">
                    <label  class="col-2 col-form-label">%s</label>
                    <div class="col-%s">
                        <input class="form-control" type="text" name="%s" maxlength="%s" %s/>
                    </div>
                    <div class="help-info">Max. %s caractères</div>
                </div>
                ',  $label, $col, $name, $maxlength, $required, $maxlength,
            );
        });

        Form::macro('validation_text_maxLength_value', function($name, $label, $value, $maxlength=10, $required=true, $col=6 )
        {

            if($required==true){
                $required='required';
            }else{
                $required='';
            }

            return sprintf('
                <div class="form-group row">
                    <label  class="col-2 col-form-label">%s</label>
                    <div class="col-%s">
                        <input class="form-control" type="text" name="%s" maxlength="%s" value="%s" %s/>
                    </div>
                    <div class="help-info">Max. %s caractères</div>
                </div>
                ',  $label, $col, $name, $maxlength, $value, $required, $maxlength,
            );
        });

        Form::macro('validation_text_minMaxLength_value', function($name, $label, $value, $minlength=10, $maxlength=10, $required=true, $col=6 )
        {

            if($required==true){
                $required='required';
            }else{
                $required='';
            }

            return sprintf('
                <div class="form-group row">
                    <label  class="col-2 col-form-label">%s</label>
                    <div class="col-%s">
                        <input class="form-control" type="text" name="%s" minlength="%s" maxlength="%s" value="%s" %s/>
                    </div>
                    <div class="help-info">Min. %s / Max. %s caractères</div>
                </div>
                ',  $label, $col, $name, $minlength, $maxlength, $value, $required, $minlength, $maxlength,
            );
        });

        Form::macro('validation_select', function($input, $name, $label, $required=true, $col=4)
        {

            if($required==true){
                $required='required';
            }else{
                $required='';
            }

            foreach ($input as $key => $value) {
                if($key==0){
                    $options = '<option value="'.$value[0].'">'.$value[1].'</option>';
                }else{
                    $options .= '<option value="'.$value[0].'">'.$value[1].'</option>';
                }
            }


            return sprintf('
                <div class="form-group row">
                    <label class="col-form-label col-lg-2 col-sm-12">%s</label>
                    <div class=" col-lg-%s col-md-9 col-sm-12">
                        <select class="form-control kt-select2 select2" name="%s" %s>
                            <option value="" >-- Please select --</option>
                            %s
                        </select>
                    </div>
                </div>
                ',  $label, $col, $name, $required, $options
            );
        });

        Form::macro('validation_selected', function($input, $name, $label, $required=true, $col=4)
        {

            if($required==true){
                $required='required';
            }else{
                $required='';
            }

            foreach ($input as $key => $value) {
                if($key==0){
                    if($value[2]==1){
                        $options = '<option value="'.$value[0].'" selected>'.$value[1].'</option>';
                    }else{
                        $options = '<option value="'.$value[0].'">'.$value[1].'</option>';
                    }
                }else{
                    if($value[2]==1){
                        $options .= '<option value="'.$value[0].'" selected>'.$value[1].'</option>';
                    }else{
                        $options .= '<option value="'.$value[0].'">'.$value[1].'</option>';
                    }
                }
            }

            return sprintf('
                <div class="form-group row">
                    <label class="col-form-label col-lg-2 col-sm-12">%s</label>
                    <div class=" col-lg-%s col-md-9 col-sm-12">
                        <select class="form-control kt-select2 select2" name="%s" %s>
                            <option value="" >-- Please select --</option>
                            %s
                        </select>
                    </div>
                </div>
                ',  $label, $col, $name, $required, $options
            );
        });

        Form::macro('validation_date', function($name, $label, $required=true, $col=4)
        {

            if($required==true){
                $required='required';
            }else{
                $required='';
            }

            return sprintf('
                <div class="form-group row">
                    <label for="example-date-input" class="col-2 col-form-label">%s</label>
                    <div class="col-%s">
                        <input class="form-control" type="date"  name="%s" %s/>
                    </div>
                </div>
                ',  $label, $col, $name, $required
            );
        });

        Form::macro('validation_date_value', function($name, $label, $value, $required=true, $col=4)
        {

            if($required==true){
                $required='required';
            }else{
                $required='';
            }

            return sprintf('
                <div class="form-group row">
                    <label for="example-date-input" class="col-2 col-form-label">%s</label>
                    <div class="col-%s">
                        <input class="form-control" type="date" value="%s" name="%s" %s/>
                    </div>
                </div>
                ',  $label, $col, $value, $name, $required
            );
        });



    //--------------------------------------------------//
    //                                                  //
    //                        switch                    //
    //                                                  //
    //--------------------------------------------------//

        Form::macro('switch', function($name, $label,$col=4,$checked=true)
        {

            if($checked==true){
                $checked='checked';
            }else{
                $checked='';
            }

            return sprintf('
                <div class="form-group row">
                    <label class="col-form-label col-lg-2 col-sm-12">%s</label>
                    <div class=" col-lg-%s col-md-9 col-sm-12">
                        <span class="switch switch-icon">
                            <label>
                                <input type="checkbox" %s name="%s"/>
                                <span></span>
                            </label>
                        </span>
                    </div>
                </div>
                ',  $label, $col, $checked, $name
            );
        });

    //--------------------------------------------------//
    //                                                  //
    //                     upload                       //
    //                                                  //
    //--------------------------------------------------//

        Form::macro('upload', function($name, $label,$col=4,$checked=true)
        {

            return sprintf('
                <div class="form-group row">
                    <label class="col-form-label col-lg-2 col-sm-12">%s</label>
                    <div class=" col-lg-%s col-md-9 col-sm-12">
                        <input type="file" class="file-input" name="%s" />
                    </div>
                </div>
                ',  $label, $col, $name
            );
        });

    }
}
