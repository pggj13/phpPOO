<?php

class ClassesObjetos {

    var $Classe;
    var $Funcao;
    
  public function getClass($Class,$Funcao){
      
      echo "<p>A Class {$Class} serve para {$Funcao}</p>";
  }
  public function verClass(){
      
      echo"<pre>";
      print_r($this);
      echo"</pre>";
      
  }
}

