<div class="pos-tab-content">
    <div class="row">

  <div class="col-sm-4">
            {!! Form::label('enable_timbre',  'Activier timbre fiscale :') !!}
            <div class="input-group">
                <span class="input-group-addon">
           {!! Form::checkbox('enable_timbre', 1, $business->enable_timbre) !!}
                </span>

                <select class="form-control" id="timbre_value"
                    name="timbre_value" 
                    @if(!$business->enable_timbre) disabled @endif>
                  
                  <option value="" @if(!$business->enable_timbre) selected @endif>Selectionner Montant</option>
                  <option value="1" @if($business->timbre_value == 1) selected @endif>1 DT</option>
                  <option value="0.1" @if($business->timbre_value == 0.1) selected @endif>0.1 DT</option>
                </select>
            </div>
        </div>









    </div>
</div>