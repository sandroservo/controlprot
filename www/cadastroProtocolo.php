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
label, select{
font-family:verdana;
font-size:12px;
}

 .descCampo{
    background-color:silver;
    font-weight:bold;

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

function formulario(){



echo "
<form method=\"POST\" name=\"cadastro\" onSubmit=\"return verificar()\" action=\"cadastroProtocolo.php\">
<table border=\"0\" align=center>
<tr>
  <td class=\"descCampo\" ><label for=\"cpfCnpjCliente\">Cpf/Cnpj:</label></td>
  <td><input type=\"text\" maxlength=\"18\" size=\"18\" name=\"cpfCnpjCliente\" id=\"cpfCnpjCliente\"></td>
  <td class=\"descCampo\" ><label for=\"nome\">Nome:</label></td>
  <td><input type=\"text\" maxlength=\"40\" size=\"30\" name=\"nome\" id=\"nome\"></td>
  <td rowspan=2 align=\"center\"><input type=\"submit\" value=\"Incluir\" name=\"incluir\" >
</tr>
<tr>
    <td class=\"descCampo\" ><label for=\"obs\">Obs:</label></td>
    <td colspan=4><input type=\"text\" maxlength=\"300\" size=\"59\" name=\"obs\" id=\"obs\"></td>
</tr>
</table>
<br>
<p align=\"center\">............................................................................................................................................</p>
<div>
<table border=\"1\" width=\"600\" align=\"center\">
<thead>
<tr>
    <th>Nome</th>
    <th>Cpf/Cnpj</th>
    <th>Tipo</th>
    <th>Obs</th>
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
        <td>".$linha['nomeCliente']."</td>
        <td>".$linha['cpfCnpjCliente']."</td>
        <td>".$linha['tipo']."</td>
        <td>".$linha['obs']."</td>
    </tr>";
        }
        echo "</tbody>
    </table>
    </div>
    </form>";
}
//fim formulario

//insere campos por sql no banco de dados
function gravarCabecalho(){


if (isset($_SESSION['codProtocolo'])){
    gravarItemProtocolo();
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

function gravarItemProtocolo(){
    $nome = $_POST['nome'];
    $cpfCnpjCliente = $_POST['cpfCnpjCliente'];
    $obs = $_POST['obs'];
echo $_SESSION['codProtocolo'];
    $sql = "INSERT INTO itemprotocolo (cpfCnpjCliente,nomeCliente,tipo,codProtocolo,obs,dataPagamento,documento)
            VALUES ('$cpfCnpjCliente','$nome','N','".$_SESSION['codProtocolo']."','$obs','0000-00-00','nada')";
    $resultadosql = mysql_query($sql) or die ("erro sql gravarItemProtocolo".mysql_error());
}






if (!array_key_exists("incluir",$_POST)){
echo "entro no primeiro;";
formulario();
   }
   else{
gravarCabecalho();
   formulario();
   echo "entro no segundo;";

    }


?>