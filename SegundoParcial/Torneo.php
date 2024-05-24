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
            $objE1=null;
            $objE2=null;
            $objPartidoNuevo=new Partido($idpartido, $fechaCreada ,$objE1,$cantGolesE1,$objE2,$cantGolesE2); //se crea la instancia partido
            foreach($colPartidos as $unPartido){
                if($unPartido->getFecha() == $fecha ){
                    if ($tipoPartido == 'basquetbol' && $unPartido instanceof PartidoBasquetBol) {
                        $partidoEncontrado = true;
                    } elseif ($tipoPartido == 'futbol' && $unPartido instanceof PartidoFutbol) {
                        $partidoEncontrado = true;
                    }
                }
            }
                
            
            if($partidoEncontrado==false){
                if($tipoPartido =="BasquetBol"){
                    if($OBJEquipo1->getCantJugadores() == $OBJEquipo2->getCantJugadores()){
                        $partidoEncontrado=true;
                        $objPartidoNuevo=new PartidoBasquetBol($idpartido,$fecha, $OBJEquipo1, $cantGolesE1, $OBJEquipo2,$cantGolesE2);
                        $colPartidos[]=$objPartidoNuevo;
                        $this->setColPartidos($colPartidos);

                    }
                }
                else{
                    if($OBJEquipo1->getCantJugadores() == $OBJEquipo2->getCantJugadores()){
                        $partidoEncontrado=true;
                        $objPartidoNuevo=new PartidoFutbol($idpartido, $fecha, $OBJEquipo1, $cantGolesE1, $OBJEquipo2, $cantGolesE2);
                        $colPartidos[]=$objPartidoNuevo;
                        $this->setColPartidos($colPartidos);
                    }
                }
            }
            return $partidoEncontrado;
        }
        public function darGanadores($deporte){

        }
    }
?>