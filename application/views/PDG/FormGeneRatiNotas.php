
<aside class="right-side strech">
  <?php $formClass=array('class'=>'form-horizontal','role'=>'form','autocomplete'=>'on','id' =>'FrmGeneRatiNotas');?>
  <?=form_open('PDG/perfil/create',$formClass); ?>
  <fieldset>
  <!-- Form Name -->
  <legend>Generación Ratificación de Notas</legend>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="no_referencia">No. Referencia</label>  
    <div class="col-md-5">
    <input id="no_referencia" name="no_referencia" type="text" placeholder="No. Referencia" class="form-control input-md" required="">
      
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="carta_dirigida_a">Carta Dirigida A</label>  
    <div class="col-md-5">
    <input id="carta_dirigida_a" name="carta_dirigida_a" type="text" placeholder="Ej. Jose Miguel Perez Hernandez" class="form-control input-md" required="">
      
    </div>
  </div>

  <!-- Multiple Radios (inline) -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="ciclo">Ciclo</label>
    <div class="col-md-4"> 
      <label class="radio-inline" for="ciclo-0">
        <input type="radio" name="ciclo" id="ciclo-0" value="1" checked="checked">
        1
      </label> 
      <label class="radio-inline" for="ciclo-1">
        <input type="radio" name="ciclo" id="ciclo-1" value="2">
        2
      </label>
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="anio">Año</label>  
    <div class="col-md-4">
    <input id="anio" name="anio" type="text" placeholder="" class="form-control input-md">
      
    </div>
  </div>

  <!-- Select Basic -->
  <div class="form-group">
    <label class="col-md-1 control-label" for="selectbasic">Equipo</label>
    <div class="col-md-1">
      <select id="selectbasic_equipo" name="selectbasic_equipo" class="form-control">
        <?php foreach($equipo as $row):?>
        <option value="1"><?php echo $row['id_equipo_tg'];?></option>
        <?php endforeach;?>
      </select>
    </div>
  </div>


  <!-- Textarea -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="tema">Tema</label>
    <div class="col-md-4">                     
      <textarea class="form-control" id="tema" name="tema"></textarea>
    </div>
  </div>

  <!-- Button -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="ver_ratifica_generada"></label>
    <div class="col-md-4">
      <button id="ver_ratifica_generada" name="ver_ratifica_generada" class="btn btn-primary">Ver Ratificación Generada</button>
    </div>
  </div>

  <!-- Button -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="generar_ratificación"></label>
    <div class="col-md-4">
      <button id="generar_ratificación" name="generar_ratificación" class="btn btn-primary">Generar</button>
    </div>
  </div>

  <!-- Button -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="cancelar"></label>
    <div class="col-md-4">
      <button id="cancelar" name="cancelar" class="btn btn-danger">Cancelar</button>
    </div>
  </div>

  </fieldset>
  <?=form_close();?>
</aside>
