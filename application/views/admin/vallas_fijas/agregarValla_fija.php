<h1 class="text-center" style="color:#ba0d0d;">Nueva Valla</h1>
    <hr>

    <?php var_dump($periodos_pago) ?>
    <div class="col-lg-12">
        <form method="POST" enctype="multipart/form-data" action="<?= base_url("admin/vallas_fijas/guardarVallaFija")?>" name="guardarVallaFija" id="guardarVallaFija">
                <h6 class="text-center"> Datos de la valla </h6>
                <hr>
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="form-group">
                            <label for="numcontrol"> No Control: </label>
                            <input type="text" class="form-control" id="numcontrol" name="numcontrol" value=""  onchange="VerificarEspectacularDuplicado(this.value);">
                        </div>
                    </div>


                    <div class="col-lg-4 col-md-4" id="calle">
                        <div class="form-group">
                            <label for="calle" > Calle:</label>
                            <input type="text" class="form-control" id="calle" name="calle" value=""  step="any">
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-md-4" id="numero">
                        <div class="form-group">
                            <label for="numero" > Numero:</label>
                            <input type="number" class="form-control" id="numero" name="numero" value=""  step="any">
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4" id="colonia">
                        <div class="from-group">
                            <label for="colonia" > Colonia:</label>
                            <input type="text" class="form-control" id="colonia" name="colonia" value=""  step="any">
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-4" id="localidad">
                        <div class="form-group">
                            <label for="localidad" >Localidad:</label>
                            <input type="text" class="form-control" id="localidad" name="localidad" value=""  step="any">
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4" id="estado">
                        <div class="form-group">
                            <label for="estado" > Estado: </label>
                                <select name="estado" id="estadoselect" class="form-control">
                                    <option value="">selecciona un estado</option>
                                    <?php foreach($estados as $estado):?>
                                        <option value="<?= $estado['id'] .",". $estado['nombre']?>"><?= $estado['nombre']?></option>
                                    <?php endforeach?>
                                </select>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4" id="municipio">
                        <div class="form-group">
                            <label for="municipio" > Municipio: </label>
                            <select name="municipio" id="municipioselect" class="form-control">
                                <option value="">selecciona un estado</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4" id="latitud">
                        <div class="form-group">
                            <label for="latitud" >Latitud:</label>
                            <input type="text" class="form-control" id="latitud" name="latitud" value=""  step="any">
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4" id="longitud">
                        <div class="form-group">
                            <label for="longitud" >Longitud:</label>
                            <input type="text" class="form-control" id="longitud" name="longitud" value=""  step="any">
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12" id="referencias">
                        <div class="form-group">
                            <label for="referencias" >Referencias:</label>
                            <input type="text" class="form-control" id="referencias" name="referencias" value=""  step="any">
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 my-4">
                        <h6 class="text-center">Medidas</h6>
                        <hr>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label for="ancho" > Ancho(m): </label>
                                <input type="number" class="form-control" id="ancho" name="ancho" value=""  step="any">
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label for="alto" > Alto(m): </label>
                                <input type="number" class="form-control" id="alto" name="alto" value=""  step="any">
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <div class="form group">
                            <label for="material" > Material: </label>
                                    <input type="text" id="material" name="material" class="form-control" value="vinil" placeholder = "vinil - 65$"  readonly>
                                </select>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4"> 
                        <div class="form-group">
                            <label for="costodeimpresion" > Costo de impresion: </label>
                                <input type="text" class="form-control" id="costodeimpresion" name="costodeimpresion" value=""  step="any" readonly>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label for="costodeinstalacion" > Costo de instalacion: </label>
                                <input type="text" class="form-control" id="costodeinstalacion" name="costodeinstalacion" value=""  step="any" readonly>
                        </div>
                    </div>
                    
                    <div class="col-sm-2 col-md-2">
                        <div class="form-group">
                            <label for="precio" > Precio: </label>
                            <input type="text" class="form-control" id="precio" name="precio"  step="any" readonly>
                        </div>
                    </div>

                    <div class="col-sm-2 col-md-2">
                        <div class="form-group">
                            <label for="status"> Status: </label>
                                <select class="form-control" id="status" name="status" value="" >
                                    <option value="">Sel. Status</option>
                                    <option value="Disponible">Disponible</option>
                                    <option value="Ocupado">Ocupado</option>
                                    <option value="Aparado">Aparado</option>
                                    <option value="Reparacion">Reparacion</option>
                                    <option value="Bloqueado">Bloqueado</option>
                                </select>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label for="observaciones" > Obaservaciones: </label>
                            <textarea class="form-control" id="observaciones" name="observaciones"  step="any"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label for="acabados" > Acabados </label>
                            <textarea class="form-control" id="acabados" name="acabados"  step="any"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label for="imagen1" > Vista Corta : </label>
                                <input type="file" class="dropify" data-allowed-file-extensions="jpg jpeg"
                                    id="imagen1" name="imagen1"  />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label for="imagen1" > Vista Media : </label>
                                <input type="file" class="dropify" data-allowed-file-extensions="jpg jpeg"
                                    id="imagen2" name="imagen2"  />
                        </div>
                    </div>
                            
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label for="imagen1" > Vista Larga : </label>
                                <input type="file" class="dropify" data-allowed-file-extensions="jpg jpeg"
                                    id="imagen3" name="imagen3"  />
                        </div>
                    </div>
                    <div class="col-lg-12 my-5">
                        <h6 class="text-center"> Datos del propietario: </h6>
                        <hr>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group ">
                            <label for="propietario" > Propietario:</label>
                            <select class="form-control" id="propietario" name="propietario"  >
                                <option value="nuevo">Nuevo</option>
                                <option value="registrado">Registrado</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4 d-none" id="propietariosReg">
                        <div class="form-group ">
                            <label for="propietarioReg" > Propietarios registrados:</label>
                            <select class="form-control" id="propietarioReg" name="propietarioReg" >
                                <option value="">--selecciona--</option>
                                <?php foreach($propietarios as $propietario):?>
                                <option value="<?= $propietario['id']?>"><?= $propietario["nombre"]?></option>
                                <?php endforeach?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4" id="nombre">
                        <div class="form-group ">
                            <label for="nombreprop" > Nombre:</label>
                            <input type="text" class="form-control" id="nombreprop" name="nombreprop" value="" >
                        </div>
                    </div>

                    <div class="col-lg-3" id="celular">
                        <div class="form-group">
                            <label for="celular" > Celular: </label>
                            <input type="text" class="form-control" id="celular" name="celular" value="" >
                        </div>
                    </div>

                    <div class="col-lg-3" id="telefono">
                        <div class="form-group">
                            <label for="telefono" > Teléfono: </label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="" >
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="monto" > Monto: </label>
                            <input type="text" class="form-control" id="monto" name="monto" value="" >
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="iniciocontrato" > Inicio:</label>
                            <input type="date" class="form-control" id="iniciocontrato" name="iniciocontrato" value="" >
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="fincontrato" > Fin: </label>
                                <input type="date" class="form-control" id="fincontrato" name="fincontrato" value="" >
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="tipopago" > Tipo pago: </label>
                                <select class="form-control" id="tipopago" name="tipopago" value="" >
                                    <option value="">Sel. Tipo de pago</option>
                                    <?php foreach($tipos_pago as $tipo):?>
                                    <option value="<?= $tipo['id']?>"><?= $tipo['nombre']?></option>
                                    <?php endforeach ?>
                                </select>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="pago" > Periodo de Pago: </label>
                                <select class="form-control" id="periodopago" name="periodopago" value=""
                                    >
                                    <option value="">Periodo</option>
                                    <?php foreach($periodos_pago as $periodo):?>
                                    <option value="<?= $periodo['id']?>"><?= $periodo['periodo']?></option>
                                    <?php endforeach ?>
                                </select>
                        </div>
                    </div>

                    <!--<div class="col-lg-2">
                        <div class="form-group">
                            <label for="folio" > Folio: </label>
                            <input type="text" class="form-control" id="folio" name="folio" value="" >
                        </div>
                    </div>-->
<!-- 
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="monto" c>Contrato: </label>
                            <input type="file" id="monto" name="monto" value=""  step="any">
                        </div>
                    </div>  -->
                    
                </div>
                <div class="d-flex justify-content-end my-5">
                    <button type="submit" id="submitespectacular" class="btn btn-success">Guardar</button>
                </div>
        </form>
    </div>

<div id="answer">

</div>
<script>vallasit.classList.add("selected");</script>
<script src="<?= base_url("assets/js/vallas_fijas.js")?>"></script>	
<script>
// $(document).ready(function(){
//     $("#celular").mask('000-000-00-00');
//     $("#telefono").mask('000-000-00-00');

// })
</script>