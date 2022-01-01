<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class detalleCompraControlador extends mainModel
	{
        /*PAGINAR LISTA Y BUSQUEDA*/
        public function paginador_detalleCompra_controlador($busqueda){

            $busqueda = mainModel::decryption($busqueda);
       
            $consulta = mainModel::ejecutar_consulta_simple("SELECT * FROM compra_detalle INNER JOIN producto ON compra_detalle.idProducto = producto.idProducto WHERE idCompra = '$busqueda'");


            if($consulta->rowCount()>=1){

                $contador = 1;

                while ($rows = $consulta->fetch()) {

                    echo '  <tr class="text-center text-uppercase">
                                <th scope="row">'.$contador.'</th>
                                <td>'.$rows['nombre'].'</td>
                                <td>'.$rows['cantidad'].'</td>
                                <td>S/'.$rows['precio'].' SOLES</td>
                                <td>S/'.$rows['subTotal'].' SOLES</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalDevolucion'.$contador.'"  data-toggle="tooltip" title="Registrar Devolución" data-placement="bottom">
                                        <i class="fas fa-dolly fa-fw"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <div class="modal fade" id="ModalDevolucion'.$contador.'" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form class=FormularioAjax" action="#" method="POST" data-form="save" autocomplete="off">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Realizar devolución (<span>'.$rows['nombre'].'</span>)</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="codigo_compra" id="codigo_compra" value="'.$rows['idCompra'].'">
                                                <input type="hidden" name="id_producto" id="id_producto" value="'.$rows['idProducto'].'">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6">
                                                            <div class="form-group bmd-form-group is-filled">
                                                                <label for="devolucion_caja" class="bmd-label-static">Caja</label>
                                                                <input type="text" class="form-control" value="Caja Principal" id="devolucion_caja" readonly="">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="form-group bmd-form-group">
                                                                <label for="devolucion_cantidad" class="bmd-label-static">Cantidad a devolver</label>
                                                                <input type="text" class="form-control" id="devolucion_cantidad" name="devolucion_cantidad" pattern="[0-9]{1,9}" maxlength="9">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-times-circle"></i> &nbsp; Cancelar</button>
                                                <button type="submit" class="btn btn-info"><i class="fas fa-dolly fa-fw"></i> &nbsp; Realizar devolución</button>
                                            </div>
                                            <div class="RespuestaAjax"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>';
                    $contador++;
                }
            }else{
                    echo ' <tr>
                                    <td colspan="6"> 
                                        <div class="alert alert-dark" role="alert">
                                            <i class="fas fa-bullhorn"></i> NO HAY REGISTOS EN EL SISTEMA 
                                        </div>
                                    </td>
                                </tr>';
                
            }

        }

	}