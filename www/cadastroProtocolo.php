<?php
session_start();
?>

<style>


input{
border-style:solid;
border-color:black;
border-width:1px;
font-family:verdana;
font-size:12px;
}
label, select, table{
font-family:verdana;
font-size:12px;
}

 .descCampo{
    background-color:silver;
    font-weight:bold;

}

.resultCampo{
    padding-bottom:5;
}

.tabItemProtocolo{
    border:1px;
    border-style:solid;
    border-color:black;
    
}
.msg{
    position:relative;
    width:500px;
    text-align:center;
    border-width:1;
    border-style:solid;
    border-color:black;
    background-color:silver;
    font-family:verdana;
    font-size:12;
    font-weight:bold;
}
</style>

<?php
require "conectar.php";

//inicio formulario
function formulario(){

echo "
<form method=\"POST\" name=\"cadastro\" onSubmit=\"return verificar()\" action=\"cadastroProtocolo.php\">
<table border=\"0\" align=center>
<tr>
  <td class=\"descCampo\" ><label for=\"cpfCnpjCliente\">Cpf/Cnpj:</label></td>
  <td><input type=\"text\" maxlength=\"18\" size=\"23\" name=\"cpfCnpjCliente\" id=\"cpfCnpjCliente\"></td>
  <td class=\"descCampo\" ><label for=\"nome\">Nome:</label></td>
  <td><input type=\"text\" maxlength=\"40\" size=\"43\" name=\"nome\" id=\"nome\"></td>
</tr>
<tr>
  <td class=\"descCampo\" ><label for=\"obs\">Obs:</label></td>
  <td colspan=4><input type=\"text\" maxlength=\"300\" size=\"78\" name=\"obs\" id=\"obs\"></td>
</tr>
<tr>
   <td colspan=4 align=\"right\"><input type=\"submit\" value=\"Incluir\" name=\"incluir\" >
</tr>
</table>
<br>

<p align=\"center\">..........................................................................................................................................................</p>

<div>
<table border=\"0\" width=\"600\" align=\"center\" class=\"tabItemProtocolo\">
<thead>
<tr>
    <th class=\"descCampo\" >Nome</th>
    <th class=\"descCampo\" >Cpf/Cnpj</th>
    <th class=\"descCampo\" width=\"10\">Tipo</th>
    <th class=\"descCampo\" >Obs</th>
</tr>
</thead>
";
        $sql = "select * from itemprotocolo A
            join
            protocolo B
            on A.codProtocolo = B.codProtocolo
            where A.codProtocolo ='".$_SESSION['codProtocolo']."'";
        $resultado = mysql_query($sql) or die ("erro sql".mysql_error());

        while ($linha = mysql_fetch_array($resultado)){
        echo "
        <tbody>
        <tr>
            <td class=\"resultCampo\">".$linha['nomeCliente']."</td>
            <td class=\"resultCampo\">".$linha['cpfCnpjCliente']."</td>
            <td class=\"resultCampo\" align=\"center\">".$linha['tipo']."</td>
            <td class=\"resultCampo\">".$linha['obs']."</td>
        </tr>";
        }

echo "
</tbody>
</table>
</div>
<br>
<table border=\"0\"align=\"center\">
<thead>
    <tr>
        <td align=\"right\"><input type=\"submit\" alt=\"teste\" value=\"voltar\" name=\"voltar\" >
        <td align=\"right\"><input type=\"submit\" value=\"gravar\" name=\"gravar\" >
        <td align=\"right\"><input type=\"submit\" value=\"enviar\" name=\"enviar\" >
    </tr>
</thead>
<tbody>
</tbody>
</table>


</form>";
}
//fim formulario

//inicio formulario
function gravarCabecalho(){


if (isset($_SESSION['codProtocolo'])){
    
    }else{
        $sql2 = "select * from protocolo order by codProtocolo desc limit 1 ";//busca o ultimo cod que está no banco
        $resultado2 = mysql_query($sql2) or die ("erro sqlGravarCabecalho".mysql_error());
        $dado2 = mysql_fetch_assoc($resultado2);
        $codProtocolo = $dado2['codProtocolo']+1;//acrescenta + 1 no codigo que buscou do banco

        $_SESSION['codProtocolo'] = $codProtocolo;

        $sql = "INSERT INTO protocolo (codProtocolo,dataCriacao,status,codUsuario,codEmpresa,quantidadeContratos) VALUES ('$codProtocolo',now(),'A','1','1','0')";
        $resultadosql = mysql_query($sql) or die ("erro sql GravarCabecalho 2".mysql_error());
}



};
//fim gravar

//inicio formulario
function gravarItemProtocolo(){
    $nome = $_POST['nome'];
    $cpfCnpjCliente = $_POST['cpfCnpjCliente'];
    $obs = $_POST['obs'];
echo $_SESSION['codProtocolo'];
    $sql = "INSERT INTO itemprotocolo (cpfCnpjCliente,nomeCliente,tipo,codProtocolo,obs,dataPagamento,documento)
            VALUES ('$cpfCnpjCliente','$nome','N','".$_SESSION['codProtocolo']."','$obs','0000-00-00','nada')";

    $resultadosql = mysql_query($sql) or die ("erro sql gravarItemProtocolo".mysql_error());

    formulario();
}
//fim formulario






if (!array_key_exists("incluir",$_POST)){
    formulario();
    gravarCabecalho();
    }
    else{
        gravarItemProtocolo();
        }


?>