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
            $cad="\nCOLECCION  PARTIDOS:\n".$this->retornarColPartidos().
                 "\nImporte: $".$this->getImporte();
            return $cad;
        }
/*Implementar el método ingresarPartido($OBJEquipo1, $OBJEquipo2, $fecha, $tipoPartido) en la  clase Torneo el cual recibe por parámetro 2 equipos, la
 fecha en la que se realizará el partido y si se trata de un partido de futbol o basquetbol . El método debe crear y retornar la instancia de la clase
  Partido que corresponda y almacenarla en la colección de partidos del Torneo. Se debe chequear que los 2 equipos tengan la misma categoría e igual 
  cantidad de jugadores, caso contrario no podrá ser registrado ese partido en el torneo.  */ 
        public function ingresarPartido($OBJEquipo1, $OBJEquipo2, $fecha, $tipoPartido){
            $colPartidos=$this->getColPartidos();
            $cantGolesE1=0;
            $cantGolesE2=0;
            $idpartido=0;
            $fechaCreada=date("y-m-d");
            $partidoEncontrado=false;
            $objE1=null;
            $objE2=null;
            $i=0; 
            $objPartidoNuevo=new Partido($idpartido, $fechaCreada ,$objE1,$cantGolesE1,$objE2,$cantGolesE2); //se crea la instancia partido
            while($i<count($colPartidos) && $partidoEncontrado==false){
                if($colPartidos[$i]->getFecha() == $fecha ){
                    if ($colPartidos[$i] instanceof PartidoBasquetBol) {
                        $partidoEncontrado = true;
                    } else {
                        $partidoEncontrado = true;
                    }
                }
                $i++;
            }
            if($partidoEncontrado==false){
                if($tipoPartido =="BasquetBol"){
                    if($OBJEquipo1->getCantJugadores() == $OBJEquipo2->getCantJugadores()){
                        $partidoEncontrado=true;
                        $cantInfracciones=0;
                        $objPartidoNuevo=new PartidoBasquetBol(($idpartido+1),$fecha, $OBJEquipo1, $cantGolesE1, $OBJEquipo2,$cantGolesE2,$cantInfracciones);
                        $colPartidos[]=$objPartidoNuevo;
                        $this->setColPartidos($colPartidos);

                    }
                }
                else{
                    if($OBJEquipo1->getCantJugadores() == $OBJEquipo2->getCantJugadores()){
                        $partidoEncontrado=true;
                        $objPartidoNuevo=new PartidoFutbol(($idpartido+1), $fecha, $OBJEquipo1, $cantGolesE1, $OBJEquipo2, $cantGolesE2);
                        $colPartidos[]=$objPartidoNuevo;
                        $this->setColPartidos($colPartidos);
                    }
                }
            }
            return $partidoEncontrado;
        }
    /*Implementar el método darGanadores($deporte) en la clase Torneo que recibe por parámetro si se trata 
de un partido de fútbol o de básquetbol y en  base  al parámetro busca entre esos partidos los equipos
 ganadores ( equipo con mayor cantidad de goles). El método retorna una colección con los objetos de los
  equipos encontrados. */
    public function darGanadores($deporte){
        $colEquipoGanadores=[];
        $colPartidos=$this->getColPartidos();
        foreach($colPartidos as $unPartido){
            if($unPartido instanceof BasquetBol){
                $ganador=$unPartido->darEquipoGanador();
                $colEquipoGanadores[]=$ganador;
            }
            else{
                $ganador=$unPartido->darEquipoGanador();
                $colEquipoGanadores[]=$ganador;
            }
        }
        return $colEquipoGanadores;
        }
    }
?>