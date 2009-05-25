<?php

//inicio formulario
function formulario(){

echo "
<form method=\"POST\" name=\"cabecalhoFormulario\" action=\"index.php?pagina=Alterar\">
<table border=\"0\" align=center>
<tr>
  <td class=\"descCampo\" ><label for=\"cpfCnpjCliente\">Cpf/Cnpj:</label></td>
  <td><input type=\"text\" maxlength=\"18\" size=\"23\" name=\"cpfCnpjCliente\" id=\"cpfCnpjCliente\"></td>
  <td class=\"descCampo\" ><label for=\"nome\">Nome:</label></td>
  <td><input type=\"text\" maxlength=\"40\" size=\"43\" name=\"nome\" id=\"nome\"></td>
</tr>
<tr>
  <td class=\"descCampo\" ><label for=\"obs\">Obs:</label></td>
  <td colspan=4><input type=\"text\" maxlength=\"300\" size=\"82\" name=\"obs\" id=\"obs\"></td>
</tr>
<tr>
   <td colspan=4 align=\"right\"><input type=\"submit\" value=\"Incluir\" name=\"incluir\" >
</tr>
</table>
</form>
<br>";
itemFormulario();

}
//fim formulario
function itemFormulario(){

    echo "<p align=\"center\">...................................................................................................................................</p>

<div>
<form method=\"POST\" name=\"itemFormulario\" action=\"index.php?pagina=Alterar\">
<table border=\"0\" width=\"650\" align=\"center\" class=\"tabItemProtocolo\">
<thead>
<tr>
    <th width=\"100\">Nome</th>
    <th width=\"100\">Cpf/Cnpj</th>
    <th width=\"10\">Tipo</th>
    <th >Obs</th>
    <th width=\"5\">D</th>
</tr>
</thead>
";
        $sql = "select * from itemProtocolo A
            join
            protocolo B
            on A.codProtocolo = B.codProtocolo
            where A.codProtocolo ='".$_SESSION['codProtocolo']."'";
        $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
        $total = mysql_num_rows($resultado);
        $_SESSION['total'] = $total;
        while ($linha = mysql_fetch_array($resultado)){
        echo "
        <tbody>
        <tr>
            <td class=\"resultCampo\">".$linha['nomeCliente']."</td>
            <td class=\"resultCampo\">".$linha['cpfCnpjCliente']."</td>
            <td class=\"resultCampo\" align=\"center\">".$linha['tipo']."</td>
            <td class=\"resultCampo\">".$linha['obs']."</td>
            <td><a href=\"index.php?pagina=Novo&item=".$linha['cpfCnpjCliente']."\" >X</a></td>
        </tr>";
        }

echo "
    <tr>
        <th colspan=5>Total Contratos: ".$total."</th>
    </tr>

</tbody>
</table>
</div>
<table border=\"0\" align=\"center\">
<thead>
    <tr>
        <td align=\"right\"><input type=\"submit\" value=\"Deletar\" name=\"deletar\" >
        <td align=\"right\"><input type=\"submit\" value=\"Gravar\" name=\"gravar\" >
        <td align=\"right\"><input type=\"submit\" value=\"Enviar\" name=\"enviar\" >
    </tr>
</thead>
<tbody>
</tbody>
</table>
</form>";
}
//inicio formulario
/*
function gravarCabecalho(){


    if (isset($_SESSION['codProtocolo']) && !$_SESSION['codProtocolo']=="" || array_key_exists('cod', $_GET)){

    }else{
        $sql2 = "select * from protocolo order by codProtocolo desc limit 1 ";//busca o ultimo cod que está no banco
        $resultado2 = mysql_query($sql2) or die ("erro sqlGravarCabecalho".mysql_error());
        $dado2 = mysql_fetch_assoc($resultado2);
        $codProtocolo = $dado2['codProtocolo']+1;//acrescenta + 1 no codigo que buscou do banco
        $_SESSION['codProtocolo'] = $codProtocolo;

$sql = "INSERT INTO protocolo (codProtocolo,dataCriacao,status,codUsuario,codEmpresa,quantidadeContratos) VALUES ('$codProtocolo',now(),'A','1','1','0')";
        $resultadosql = mysql_query($sql) or die ("erro sql GravarCabecalho 2".mysql_error());
}



};*/
//fim gravar

//inicio formulario
function gravarItemProtocolo(){
    $_SESSION['nome'] = $_POST['nome'];
    $_SESSION['cpfCnpjCliente'] = $_POST['cpfCnpjCliente'];
    $_SESSION['obs'] = $_POST['obs'];

if (($_SESSION['nome'])=="" || $_SESSION['nome']==" "){
 echo "<div class=\"msgY\">Digite um Nome</div>";
 }
  if($_SESSION['cpfCnpjCliente']=="" || $_SESSION['cpfCnpjCliente']==" "){
   echo "<div class=\"msgY\">Digite um CPF ou CNPJ</div>";
   }if(!($_SESSION['cpfCnpjCliente']=="" || $_SESSION['cpfCnpjCliente']==" " || $_SESSION['nome']=="" || $_SESSION['nome']==" ")){

    $sql_ver = "select * from itemProtocolo A
            join
            protocolo B
            on A.codProtocolo = B.codProtocolo
            where A.cpfCnpjCliente ='".$_SESSION['cpfCnpjCliente']."'";

    $resultado_ver = mysql_query($sql_ver);
    $linha_ver = mysql_num_rows($resultado_ver);

    if ($linha_ver>0){
        echo "<div class=msgY><b>CPF/Cnpj já possui protocolo</b><br>";
            while ($linha = mysql_fetch_array($resultado_ver)){
                echo"Protocolo Nº: ".$linha['codProtocolo']." | Enviado: ".$linha['dataEnvio']."<br>";
                }

        echo "<br>Deseja enviar como Novo ou Pendência?";
        echo "
        <form method=\"POST\" name=\"cadastro\" onSubmit=\"return verificar()\" action=\"index.php?pagina=Novo\">
        <table border=\"0\" align=\"center\">
         <thead>
         <tr>
            <td align=\"right\"><input type=\"submit\" value=\"Novo\" name=\"novo\" >
            <td align=\"right\"><input type=\"submit\" value=\"Pendência\" name=\"pendencia\" >
         </tr>
         </thead>
         <tbody>
         </tbody>
         </table>
         </form></div>";
                 }else{
                 $sql = "INSERT INTO itemProtocolo (cpfCnpjCliente,nomeCliente,tipo,codProtocolo,obs,dataPagamento,documento)
                 VALUES ('".$_SESSION['cpfCnpjCliente']."','".$_SESSION['nome']."','N','".$_SESSION['codProtocolo']."','".$_SESSION['obs']."','0000-00-00','nada')";
                 $resultadosql = mysql_query($sql) or die ("erro sql gravarItemProtocolo".mysql_error());
                 }
        }
    }
//fim formulario

function gravarItemProtocoloPendencia(){
    $sql =  $sql = "INSERT INTO itemProtocolo (cpfCnpjCliente,nomeCliente,tipo,codProtocolo,obs,dataPagamento,documento)
                 VALUES ('".$_SESSION['cpfCnpjCliente']."','".$_SESSION['nome']."','P','".$_SESSION['codProtocolo']."','".$_SESSION['obs']."','0000-00-00','nada')";
    $resultadosql = mysql_query($sql) or die ("erro sql gravarItemProtocoloPendencia ".mysql_error());
}
function gravarItemProtocoloNovo(){
    $sql =  $sql = "INSERT INTO itemProtocolo (cpfCnpjCliente,nomeCliente,tipo,codProtocolo,obs,dataPagamento,documento)
                 VALUES ('".$_SESSION['cpfCnpjCliente']."','".$_SESSION['nome']."','N','".$_SESSION['codProtocolo']."','".$_SESSION['obs']."','0000-00-00','nada')";
    $resultadosql = mysql_query($sql) or die ("erro sql gravarItemProtocoloNovo ".mysql_error());
}

function salvarProtocolo(){
    $sql = "Select codProtocolo from itemprotocolo where codProtocolo='".$_SESSION['codProtocolo']."';";
    $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
    $total = mysql_num_rows($resultado);

    if ($total<=0){
        echo "<div class=\"msgR\">Não existe itens para serem salvos</div>";

        }else{
            $sql = "UPDATE protocolo SET status='S',quantidadeContratos='".$_SESSION['total']."'
            WHERE codProtocolo = '".$_SESSION['codProtocolo']."' ;";
            $resultadosql = mysql_query($sql) or die ("erro sql salvarFormulario".mysql_error());
            echo "<div class=\"msgG\">Protocolo Salvo com sucesso <br> Protocolo Nº:".$_SESSION['codProtocolo']." </div>";
         }
unset ($_SESSION['codProtocolo']);
}

function enviarProtocolo(){

    $sql = "Select codProtocolo from itemprotocolo where codProtocolo='".$_SESSION['codProtocolo']."';";
    $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
        $total = mysql_num_rows($resultado);
    if ($total<=0){
        echo "<div class=\"msgR\">Não existe itens para serem enviados</div>";
        formulario();
         }else{
            $sql = "UPDATE protocolo SET status='E',quantidadeContratos='".$_SESSION['total']."', dataEnvio=now(),codUsuario='1',codEmpresa='1'
            WHERE codProtocolo = '".$_SESSION['codProtocolo']."' ;";
            $resultadosql = mysql_query($sql) or die ("erro sql salvarFormulario".mysql_error());
            echo "<div class=\"msgG\">Protocolo Enviado<br>
            <b>Protocolo: ".$_SESSION['codProtocolo']."</b>
            </div>";
    
                unset ($_SESSION['codProtocolo']);//zera sessa codprotocolo para não abrir o mesmo protocolo depois de enviado
            }

}


function deletarProtocolo(){
    $sql = "DELETE FROM itemProtocolo WHERE codProtocolo='".$_SESSION['codProtocolo']."';";
    $resultadosql = mysql_query($sql) or die ("erro sql deletarItemProtocolo".mysql_error());

    $sql = "DELETE FROM protocolo WHERE codProtocolo='".$_SESSION['codProtocolo']."';";
    $resultadosql = mysql_query($sql) or die ("erro sql deletarItemProtocolo".mysql_error());

    echo "<div class=\"msgR\">Protocolo Deletado</div>";

    $_SESSION['codProtocolo']="";
}

function excluirItemProtocolo(){
    $sql = "DELETE FROM itemProtocolo WHERE cpfCnpjCliente='".$_SESSION['item']."' and codProtocolo='".$_SESSION['codProtocolo']."';";
    $resultadosql = mysql_query($sql) or die ("erro sql deletarItemProtocolo".mysql_error());
}
$_SESSION['item'] = $_GET['item'];
$_SESSION['cod'] = $_GET['cod'];

if(array_key_exists("enviar", $_POST)){
    enviarProtocolo();
    }
    if(array_key_exists("gravar", $_POST)){
        salvarProtocolo();
        }
        if (array_key_exists("incluir",$_POST)){
            gravarItemProtocolo();
            formulario();

            }
            if(array_key_exists("pendencia", $_POST)){
              gravarItemProtocoloPendencia();
              formulario();
              }
              if(array_key_exists("novo", $_POST)){
                gravarItemProtocoloNovo();
                formulario();
                }
                if(array_key_exists("deletar", $_POST)){
                    deletarProtocolo();
                    }
                    if(array_key_exists("item", $_GET)){
                        excluirItemProtocolo();
                        formulario();
                        }
                        if ( !array_key_exists("enviar", $_POST) && !array_key_exists("gravar", $_POST)
                            && !array_key_exists("incluir",$_POST) && !array_key_exists("pendencia", $_POST)
                            && !array_key_exists("novo", $_POST) && !array_key_exists("deletar", $_POST) 
                            && !array_key_exists("item", $_GET)){
                            
                            formulario();

                           }

?>