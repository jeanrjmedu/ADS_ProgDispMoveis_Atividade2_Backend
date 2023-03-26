    <?php
        function realizaCadastro(){
            try{
                $extensaoArquivo = strtolower(pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION));
                $diretorioArquivoDestino = "fotos/";
                $nomeArquivoDestino  = "foto". $_POST["nome"];
                $enderecoArquivoDestino = $diretorioArquivoDestino . $nomeArquivoDestino . "." . $extensaoArquivo;
        
                move_uploaded_file($_FILES["file"]["tmp_name"], $enderecoArquivoDestino);
        
                $conn= mysqli_connect("localhost","root", "");
                $sql = "use atividade2;";
                if (mysqli_query($conn, $sql)){
                    http_response_code(200);
                }else{
                    throw new Exception ("");
                }
        
                $nome = $_POST["nome"];
                $idade = isset($_POST["idade"]) ? $_POST["idade"] : 0;
                $profissao = isset($_POST["profissao"]) ? $_POST["profissao"] : '';
                $bio = isset($_POST["bio"]) ? $_POST["bio"] : '';
                $linkFoto = isset($enderecoArquivoDestino) ? $enderecoArquivoDestino : '';
        
                $sql = "INSERT INTO bio (nome, idade, profissao, bio, foto) 
                VALUES ('" . $nome . "', " . $idade . ", '" . $profissao . "' , '" . $bio . "', '" . $linkFoto . "')";
                if (mysqli_query($conn, $sql)){
                    http_response_code(200);
                }else{
                    throw new Exception ("");
                }
            
            }catch(Exception $EX){
                http_response_code(500);
            }
        }
		
		header('Access-Control-Allow-Origin: *');

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            realizaCadastro();
        }
    ?>