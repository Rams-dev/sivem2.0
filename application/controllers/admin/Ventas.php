<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller {

	public function __Construct(){
		parent::__Construct();
		$this->load->model('EspectacularesModel');
		$this->load->model('ClientesModel');
		$this->load->model('VentasModel');
		$this->load->model('MediosModel');
		$this->load->model('EmpleadosModel');

	}
	public function index()
	{
		if($this->session->userdata('is_logged')){
            $espectaculares = $this->VentasModel->obtenerVentasEspectaculares();
            $vallas_fijas = $this->VentasModel->obtenerVentasVallas_fijas();
            $vallas_moviles = $this->VentasModel->obtenerVentasVallas_moviles();

            $data["ventas"] = array_merge($espectaculares,$vallas_fijas,$vallas_moviles);
            $this->load->view('admin/templates/__head');
            $this->load->view('admin/templates/__nav');
            $this->load->view('admin/ventas/ventas',$data);
            $this->load->view('admin/templates/__footer');
		}else{
			redirect('login');
		}
		
    }
    
    public function agregarVenta(){
        if($this->session->userdata('is_logged')){
            $data['clientes'] =  $this->ClientesModel->obtenerClientes();

            $this->load->view('admin/templates/__head');
            $this->load->view('admin/templates/__nav');
            $this->load->view('admin/ventas/agregarVenta', $data);
            $this->load->view('admin/templates/__footer');
    
        }else{
            redirect('login');
        }
    }

    function obtenerMedios($id_medio){
        if($this->session->userdata('is_logged')){
            
                // $mediosDisponibles = $this->MediosModel->obtenerMediosDisponibles($data['medio'],$data['fechaInicio'],$data['fechaTermino']);
                $mediosDisponibles = $this->MediosModel->obtenerMediosDisponibles($id_medio);
                $mediosApartados = $this->MediosModel->obtenerMediosApartados($id_medio);
                //$mediosReservados = $this->MediosModel->obtenerMediosReservados($data['medio'],$data['fechaInicio'],$data['fechaTermino']);
                // $medios = array();
                // for($i =0; $i<count($mediosDisponibles); $i++){
                //     for($j =0; $j<count($mediosApartados); $j++){
                //         if($mediosApartados[$j]['id_medio'] == $mediosDisponibles[$i]['id_medio']){
                //             unset($mediosDisponibles[$j]['id_medio'])
                //             array_push($medios)
                //         }
                //     }
                // }
                $medios = array_merge($mediosDisponibles, $mediosApartados);

                echo json_encode($medios);
                //echo json_encode($mediosReservados);

        }else{
            redirect('login');
        }
    }

    public function obtenerVallasMovilesDisponibles(){
        $h1 = $this->input->post("h1");
        $h2 = $this->input->post("h2");
        $f1 = $this->input->post("f1");
        $f2 = $this->input->post("f2");
        $id = $this->input->post("id");

        $vallas_disponibles = $this->MediosModel->obtenerMediosDisponibles($id);
        $vallas_apartadas_por_fecha = $this->MediosModel->obtenerMediosApartadosPorFecha($id,$f1,$f2);
        $vallas_disponibles_porhorario= $this->MediosModel->obtenerMediosApartadosPorHorario($id,$f1,$f2,$h1,$h2);
        $vallas = array_merge($vallas_disponibles,$vallas_apartadas_por_fecha);


        echo json_encode($vallas);
        
    }

    public function obtenerChoferesDisponibles(){
        $h1 = $this->input->post("h1");
        $h2 = $this->input->post("h2");
        $f1 = $this->input->post("f1");
        $f2 = $this->input->post("f2");

        $choferes = $this->EmpleadosModel->obtenerChoferes();
        echo json_encode($choferes);
        exit;

        if($data = $this->EmpleadosModel->obtenerChoferesDisponibles($h1,$h2,$f1,$f2)){
            echo json_encode($data);
        }
        // echo json_encode($data);
    }


    public function verificarDisponibilidad(){
        $data = $this->input->post();
        $ventasMedios = $this->VentasModel->obtenerVentasPorIdMedio($data['medio']);
        // var_dump(count($ventasMedios));
        $fi = $data['fechaInicio']; 
        $ft = $data['fechaTermino']; 
        for($i = 0; $i<count($ventasMedios); $i++){
            if($ventasMedios[$i]['fecha_inicio_contrato'] > $fi and $ventasMedios[$i]['fecha_inicio_contrato'] > $ft or $ventasMedios[$i]['fecha_termino_contrato'] <$fi and $ventasMedios[$i]['fecha_termino_contrato'] < $ft ){
            }else{
                echo json_encode(array("error" => "Este medio estará ocupado durante fechas seleccionadas" ));
                exit;
            }

            
        }
    //     $data = $this->input->post();
    //     if($data['medio'] == '1'){
    //         $espectacular = $this->EspectacularesModel->
            
    //     }
    //     $mediosReservados = $this->MediosModel->verificarDisponibilidad($data['medio'],$data['fechaInicio'],$data['fechaTermino']);
     }

    function obtenerMedioPorId($id_medio){
        if($this->session->userdata('is_logged')){
            $infoMedios =  $this->MediosModel->obtenerDatosMedioporId($id_medio);
            if($infoMedios){
            foreach($infoMedios as $info){
                $medio = $this->MediosModel->obtenerMediosPorId($id_medio,$info['tipo_medio']);
            }
            if($medio){
                echo json_encode($medio);
            }
            }else{
                echo json_encode("No hay registros");

            }
             
        }else{
            redirect('login');
        }

    }

    function guardarVenta(){
        if($this->session->userdata('is_logged')){
        $id_cliente = $this->input->post('cliente');
        $fechaInicio = $this->input->post('fechaInicio');
        $fechaTermino = $this->input->post('fechaTermino');
        $noPagos = $this->input->post('pagos');
        $factura = $this->input->post('factura');
        $tipoPago = $this->input->post('tipoDePago');
        $id_tipoMedio = $this->input->post('tipoMedio');
        $horai="";
        $horaf="";
        $id_chofer="";
        if($id_tipoMedio == "3"){
            $horai = $this->input->post("hinicio");
            $horaf = $this->input->post("htermino");
            $id_chofer = $this->input->post("chofer");
        }else{
            $horai="";
            $horaf="";
            $id_chofer="";
        }
        $monto = $this->input->post('monto');
        $fecha_venta =  date('Y-m-d h:i:s');
        $idsMedios =explode(',',$this->input->post("idmedios")); 
        $descuentoPocentaje = $this->input->post('descuentoCantidad');
        $descuentoPrecio = $this->input->post('descuento');
        $precio_final= $this->input->post('precio_final');
//         echo json_encode(array('success'=>' venta exitosa'));
// exit;

        //  $formData=$this->input->post();
        //  echo json_encode(array($id_cliente,$tipoArte,$fechaInicio,$fechaTermino,$noPagos,$factura,$tipoPago,$id_tipoMedio,$monto,$fecha_venta,$idsMedios,$descuentoPocentaje,$descuentoPrecio,$precio_final));
        //  exit;
        // for($m = 0; $m < count($idsMedios); $m++){
            //  echo json_encode($fecha_venta);
        // }
        //     echo json_encode($formData);
        // echo json_encode(array('error'=>' venta exitosa'));
            // exit;

        if(!$sql = $this->VentasModel->agregarVenta($id_cliente,$monto,$descuentoPocentaje, $descuentoPrecio, $precio_final,$fecha_venta,$factura)){
            echo json_encode(array('error' => 'error, intentalo mas tarde.'));
        }
        //var_dump($sql);
        for($m = 0; $m < count($idsMedios); $m++){
            if(!$query = $this->VentasModel->agregarVentaMedio($sql,$idsMedios[$m],$noPagos,$tipoPago,$fechaInicio,$fechaTermino,$horai,$horaf,$id_chofer)){
                echo json_encode(array('error'=> 'error, intentalo mas tarde.'));
                $this->VentasModel->eliminarVenta($sql);
            }else{
                $medioG = $this->MediosModel->cambiarStatusMedio($idsMedios[$m]);
            }
        }
        if($medioG){
            echo json_encode(array('success'=>' venta exitosa'));
        }else{
            echo json_encode(array('error'=>'no se pudo realizar la venta, intenta mas tarde'));


        }
        // echo json_encode(array($id_cliente,$tipoArte,$fechaInicio,$fechaTermino,$noPagos,$factura,$tipoPago,$tipoMedio,$medio,$fecha_venta, $monto));

    }else{
        redirect('login');
    }
    }
}