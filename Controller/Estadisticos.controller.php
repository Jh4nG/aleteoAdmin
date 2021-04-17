<?php 
require_once dirname(__FILE__).'/Conexion.php';

class Estadisticos extends Conexion{

    public function __construct(){
        parent::__construct();
    }

    public function getInfo($parametros){
        $rdbVisitador = $this->getVisitadores($parametros['fechaIni'],$parametros['fechaFin']);
        $rdbVisitas = $this->getVisitas($parametros['fechaIni'],$parametros['fechaFin']);
        $rdbDispo = $this->getDispositivos($parametros['fechaIni'],$parametros['fechaFin']);
        $rdbPodcast = $this->getPodcast($parametros['fechaIni'],$parametros['fechaFin']);
        $rdbPeriodico = $this->getPeriodico($parametros['fechaIni'],$parametros['fechaFin']);
        
        echo json_encode(array(
            'visitador' => $rdbVisitador,
            'visitas' => $rdbVisitas,
            'dispositivos' => $rdbDispo,
            'podcast' => $rdbPodcast,
            'periodico' => $rdbPeriodico,
        ));
    }

    public function getVisitadores($fechaIni,$fechaFin){
        $sql="SELECT COUNT(*) as cantidad FROM visitador WHERE fecha_primer_visita BETWEEN ? AND ?";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute([$fechaIni,$fechaFin])){
            $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
            return $obj;
        }
    }

    public function getVisitas($fechaIni,$fechaFin){
        $sql="SELECT COUNT(*) as cantidad FROM visitas WHERE fecha_visita BETWEEN ? AND ?";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute([$fechaIni,$fechaFin])){
            $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
            return $obj;
        }
    }

    public function getDispositivos($fechaIni,$fechaFin){
        $sql = "UPDATE visitas SET dispositivo = 1 WHERE dispositivo IS NULL";
        $rdb = $this->con_aleteo->prepare($sql);
        $rdb->execute();
        $sql="SELECT COUNT(*) as cantidad, dispositivo FROM visitas WHERE fecha_visita BETWEEN ? AND ? GROUP BY dispositivo ORDER BY dispositivo ASC";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute([$fechaIni,$fechaFin])){
            $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
            return $obj;
        }
    }

    public function getPodcast($fechaIni,$fechaFin){
        $sql="SELECT COUNT(*) as cantidad FROM podcast WHERE DATE(fecha_creacion) BETWEEN ? AND ?";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute([$fechaIni,$fechaFin])){
            $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
            return $obj;
        }
    }

    public function getPeriodico($fechaIni,$fechaFin){
        $sql="SELECT COUNT(*) as cantidad FROM periodico WHERE DATE(per_fecha_ingreso) BETWEEN ? AND ?";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute([$fechaIni,$fechaFin])){
            $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
            return $obj;
        }
    }

    public function getGrafica($parametros){
        $fechaIni = $parametros['fechaIni'];
        $fechaFin = $parametros['fechaFin'];
        if($parametros['tipo'] == 1){
            $sql="SELECT COUNT(*) cantidad,Date_format(fecha_visita,'%d/%m') as fecha 
                    FROM visitas WHERE fecha_visita 
                    BETWEEN ? AND ? 
                    GROUP BY DATE(fecha_visita)";
        }else{
            $sql="SELECT COUNT(*) cantidad,Date_format(fecha_primer_visita,'%d/%m') as fecha 
                    FROM visitador WHERE fecha_primer_visita 
                    BETWEEN ? AND ? 
                    GROUP BY DATE(fecha_primer_visita)";
        }
        $sqlPag="SELECT COUNT(*) cantidad, pagina
                    FROM visitas WHERE fecha_visita 
                    BETWEEN ? AND ? 
                    GROUP BY pagina";
        $rdbPag = $this->con_aleteo->prepare($sqlPag);
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute([$fechaIni,$fechaFin]) && $rdbPag->execute([$fechaIni,$fechaFin])){
            $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
            $label = array();
            $data = array();
            for($i=0;$i<count($obj);$i++){
                array_push($label,$obj[$i]->fecha);
                array_push($data,$obj[$i]->cantidad);
            }
            $objPag = $rdbPag -> fetchAll(PDO::FETCH_OBJ);
            $labelPag = array();
            $dataPag = array();
            for($i=0;$i<count($objPag);$i++){
                array_push($labelPag,$objPag[$i]->pagina);
                array_push($dataPag,$objPag[$i]->cantidad);
            }
            echo json_encode(array(
                'label' => $label,
                'data' => $data,
                'labelPag' => $labelPag,
                'dataPag' => $dataPag,
            ));
        }
    }

    public function getVisitasTable($parametros){
        $fechaIni = $parametros['fechaIni'];
        $fechaFin = $parametros['fechaFin'];
        $sql="SELECT * FROM visitas WHERE DATE(fecha_visita) BETWEEN ? AND ? ORDER BY id_vis DESC";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute([$fechaIni,$fechaFin])){
            $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
            echo json_encode($obj);
        }
    }

}

if(isset($_POST) && count($_POST)>0){
    $metodo = $_POST['metodo'];
    $parametros = '';
    if(isset($_POST['parametros']) && $_POST['parametros'] != ''){
        $parametros = $_POST['parametros'];
    }
    $index = new Estadisticos();
    $index->$metodo($parametros);
}
?>