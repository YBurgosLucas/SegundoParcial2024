<?php
    class Torneo{
        private $colPartidos;
        private $importe;
        
        public function __construct($colPartidos, $importe){
            $this->colPartidos=$colPartidos;
            $this->importe=$importe;
        }
        public function getColPartidos(){
            return $this->colPartidos;
        }

        public function getImporte(){
            return $this->importe;
        }
        public function setColPartidos($colPartidos){
            $this->colPartidos=$colPartidos;
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
                 "\nImporte: $".$this->getImporte();
            return $cad;
        }
        public function ingresarPartido($OBJEquipo1, $OBJEquipo2, $fecha, $tipoPartido){
            $colPartidos=$this->getColPartidos();
            $cantGolesE1=0;
            $cantGolesE2=0;
            $idpartido=0;
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
                        $colPartidos[]=new PartidoBasquetBol($idpartido,$fecha, $OBJEquipo1, $cantGolesE1, $OBJEquipo2,$cantGolesE2);

                    }
                }
                else{
                    if($OBJEquipo1->getCantJugadores() == $OBJEquipo2->getCantJugadores()){
                        $partidoEncontrado=true;
                        $colPartidos[]=new PartidoFutbol($idpartido, $fecha, $OBJEquipo1, $cantGolesE1, $OBJEquipo2, $cantGolesE2);
                    }
                }
            }
            return $partidoEncontrado;
        }
        public function darGanadores($deporte){

        }
    }
?>