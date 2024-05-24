<?php
    include_once "Partido.php";
    class PartidoBasquetBol extends Partido{
        private $cantInfracciones;
        private $coef_Penalizacion;

        public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2, $cantInfracciones){
            parent::__construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2);
            $this->cantInfracciones=$cantInfracciones;
            $this->coef_Penalizacion=0.75;

        }
        public function getCantInfracciones(){
            return $this->cantInfracciones;
        }
        public function getCoefPenalizacion(){
            return $this->coef_Penalizacion;
        }
        public function setCantInfracciones($cantInfracciones){
            $this->cantInfracciones=$cantInfracciones;
        }
        public function setCoefPenalizacion($coef_Penalizacion){
            $this->coef_Penalizacion=$coef_Penalizacion;
        }
        public function __toString(){
            $cad=parent::__toString();
            $cad.="\nCant.Infracciones:".$this->getCantInfracciones();

            return $cad;
        }
        public function coeficientePartido(){
            $coef_Base=parent::coeficientePartido();
            $coef_Penalizacion=$this->getCoefPenalizacion();
            $cantInfracciones=$this->getCantInfracciones();

            $coef=$coef_Base-($coef_Penalizacion*$cantInfracciones);
            return $coef;
        }
    }
?>