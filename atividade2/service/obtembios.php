<?php
    function obtemBiosAsJson(){	
        $conexaoSql= mysqli_connect("localhost","root", "", "atividade2");
        $resultadoSql = mysqli_query($conexaoSql, "SELECT nome, idade, profissao, bio, foto from BIO");
        $resultadosArray = array();

        if(mysqli_num_rows($resultadoSql)>0){
            while ($linha = $resultadoSql->fetch_assoc()){
                $resultadosArray[] = $linha;
            }
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($resultadosArray);
        }else{
            echo "null";
        }
    }
    
	header('Access-Control-Allow-Origin: *');
	
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        obtemBiosAsJson();
    }
    
?>

