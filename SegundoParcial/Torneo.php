<?php
    class Torneo{
        private $colPartidos;
        private $entregaPremiosAlosjugadoresDeCadaPartido;
        private $importe;
        
        public function __construct($colPartidos, $entregaPremiosAlosjugadoresDeCadaPartido, $importe){
            $this->colPartidos=$colPartidos;
            $this->entregaPremiosAlosJugadoresDeCadaPartido=$entregaPremiosAlosjugadoresDeCadaPartido;
            $this->importe=$importe;
        }
        public function getColPartidos(){
            return $this->colPartidos;
        }
        public function getEntregaPremios(){
            return $this->entregaPRemiosAlosJugadoresDeCadaPartido;
        }
        public function getImporte(){
            return $this->importe;
        }
        public function setColPartidos($colPartidos){
            $this->colPartidos=$colPartidos;
        }
        public function setEntregaPremios($entregaPremiosAlosjugadoresDeCadaPartido){
            $this->entregaPremiosAlosjugadoresDeCadaPartido=$entregaPremiosAlosjugadoresDeCadaPartido;
        }
        public function setImporte($importe){
            $this->importe=$importe;
        }
        public function retornarColPartidos(){
            $cad="";
            $colPartidos=$this->getColPartidos();
            foreach($colPartidos as $unPartido){
                $cad.=$unPartido."\n";
            }
            return $cad;
        }
        public function __toString(){
            $cad="\nCOLECCION  PARTIDOS:".$this->retornarColPartidos().
                 "\nEntrega premios a los ganadores de cada partido:".$this->getEntregaPremios().
                 "\nImporte: $".$this->getImporte();
            return $cad;
        }
        public function ingresarPartido($OBJEquipo1, $OBJEquipo2, $fecha, $tipoPartido){
            $colPartidos=$this->getColPartidos();
            $cantGolesE1=0;
            $cantGolesE2=0;
            $idpartido="";
            $fechaCreada=date("y-m-d");
            $partidoEncontrado=false;
            $objPartidoNuevo=new Partido($idpartido, $fechaCreada ,null,$cantGolesE1,null,$cantGolesE2); //se crea la instancia partido
            foreach($colPartidos as $unPartido){
                if($unPartido->getFecha() == $fecha && ($unPartido instanceof PartidoBasquetBol == $tipoPartido || $unPartido instanceof PartidoFutbol ==$tipoPartido) ){
                    $partidoEncontrado=true;
                }
            }
            if($partidoEncontrado==false){
                if($objPartidoNuevo instanceof PartidoBasquetBol){
                    if($OBJEquipo1->getCantJugadores() == $OBJEquipo2->getCantJugadores()){
                        $partidoEncontrado=true;
                        $colPartidos[]=new PartidoBasquetBol("BasquetBol",$fecha, $OBJEquipo1, $cantGolesE1, $OBJEquipo2,$cantGolesE2);

                    }
                }
                else{
                    if($OBJEquipo1->getCantJugadores() == $OBJEquipo2->getCantJugadores()){
                        $partidoEncontrado=true;
                        $colPartidos[]=new PartidoFutbol("Futbol", $fecha, $OBJEquipo1, $cantGolesE1, $OBJEquipo2, $cantGolesE2);
                    }
                }
            }
            return $partidoEncontrado;
        }
        public function darGanadores($deporte){
            
        }
    }