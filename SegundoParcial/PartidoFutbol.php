<?php
include_once "Partido.php";
 class PartidoFutbol extends Partido{
    private $coef_Menores;
    private $coef_juveniles;
    private $coef_Mayores;

    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2){
        parent::__construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2);
        $this->coef_Menores=0.13;
        $this->coef_juveniles=0.19;
        $this->coef_Mayores=0.27;
    }
    public function getCoeFMenores(){
        return $this->coef_Menores;
    }

    public function getCoefJuveniles(){
        return $this->coef_juveniles;
    }
    public function getCoefMayores(){
        return $this->coef_Mayores;
    }
     public function setCoefMenores($coef_Menores){
        $this->coef_Menores=$coef_Menores;
    }
    public function setCoefJuveniles($coef_juveniles){
        $this->coef_juveniles;
    }
    public function setCoefMayores($coef_Mayores){
        $this->coef_Mayores=$coef_Mayores;
    }
    public function __toString(){
        $cad=parent::__toString();
        return $cad;
    }
    public function coeficientePartido(){
        $coef_base=parent::coeficientePartido();
        $categoria1=$this->getObjEquipo1()->getObjCategoria()->getDescripcion();
        $categoria2=$this->getObjEquipo2()->getObjCategoria()->getDescripcion();
        if($categoria1 == "Menores" && $categoria2== "Menores"){
            $coef_Menores=$this->getCoeFMenores();
            $this->setCoefBase($coef_Menores);
            $coef_base=parent::coeficientePartido();
        }
        elseif($categoria1 == "Juveniles" && $categoria2=="Juveniles"){
            $coef_juveniles=$this->getCoefJuveniles();
            $this->setCoefBase($coef_juveniles);
            $coef_base=parent::coeficientePartido();
        }
        elseif($categoria1 == "Mayores" && $categoria2=="Mayores"){
            $coef_Mayores=$this->getCoefMayores();
            $this->setCoefBase($coef_Mayores);
            $coef_base=parent::coeficientePartido();
        }
        else{
            $coef_base=parent::coeficientePartido();
        }
        return $coef_base;
    }
 }
 ?>