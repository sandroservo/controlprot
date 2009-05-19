<?php
function formulario(){
    echo "<form name=\"consulta\" action=\"index.php?pagina=Consulta\" method=\"POST\">
    <table border=\"0\" align=\"center\">
    <thead>
    <tr>
        <td height=\"30\" class=\"descCampoConsulta\"><input type=\"radio\" name=\"dado\" value=\"codProtocolo\" CHECKED/>Numero Protocolo</td>
        <td height=\"30\" class=\"descCampoConsulta\"><input type=\"radio\" name=\"dado\" value=\"nomeCliente\">Nome</td>
        <!--<td height=\"30\" class=\"descCampoConsulta\"><input type=\"radio\" name=\"dado\" value=\"dataEnvio\">Data Envio</td>-->
        <td height=\"30\" class=\"descCampoConsulta\"><input type=\"radio\" name=\"dado\" value=\"cpfCnpjCliente\">CPF/CNPJ</td>
        <td height=\"30\" class=\"descCampoConsulta\"><input type=\"radio\" name=\"dado\" value=\"todos\">Todos</td>

</tr>
    </thead>
    <tbody>
    <tr>

        <td colspan=\"4\">
            Consulta:
            <input type=\"text\" name=\"campo\" value=\"\" size=\"53\" id=\"campo\">
            <input type=\"submit\" value=\"Consultar\" name=\"consultar\" />
        </td>
    </tr>
    </tbody>
    </table></form>";

}



function consultar($dado,$campo){

    if ($dado=='todos'){
        $sql = "select * from itemProtocolo A
                join
                protocolo B
                on A.codProtocolo = B.codProtocolo
                group by A.codProtocolo;";
        $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
        }
    if ($dado=='nome'){
        $sql = "select * from itemProtocolo A
                join
                protocolo B
                on A.codProtocolo = B.codProtocolo
                where A.nomeCliente like '%$campo%'"; 
        $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
        }
        if ($dado=='codProtocolo'){
        $sql = "select * from itemProtocolo A
                join
                protocolo B
                on A.codProtocolo = B.codProtocolo
                where A.$dado ='$campo'
                group by A.codProtocolo;";
        $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
        }
        if (!($dado=='todos' || $dado=='nome' || $dado=='codProtocolo')){
            $sql = "select * from itemProtocolo A
                join
                protocolo B
                on A.codProtocolo = B.codProtocolo
                where A.$dado = '$campo'";
            $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
            }

echo "<div><table width=\"650\" border=\"1\" cellspacing=\"0\" bordercolor=\"black\" align=\"center\" class=\"tabItemProtocolo\">
<thead>
<tr >
<th >Numero Protocolo:</td>";
if($dado=='nomeCliente' || $dado=='cpfCnpjCliente'){echo "<th >CPF/CNPJ:</td>";}
echo "<th >Data Envio:</td>
<th >Status</td>
<th >Qtd Contratos</td>
<th colspan=\"2\">Opções</td>
</tr>";

//inicio do while para mostrar resultado da consulta
 
    while ($linha = mysql_fetch_array($resultado)){
        echo "<tr>
        <td class=\"resultCampo\">".$linha['codProtocolo']."</td>";
        if($dado=='nomeCliente' || $dado=='cpfCnpjCliente'){
            echo "<td class=\"resultCampo\">".$linha['cpfCnpjCliente']."</td>";}
       
        if(!$linha['dataEnvio']==""){
            echo "<td class=\"resultCampo\">".$linha['dataEnvio'];
                }else{
                    echo"<td class=\"resultCampo\">Não Enviado</td>";
                    }

        echo "</td>
        <td class=\"resultCampo\">".$linha['status']."</td>
        <td class=\"resultCampo\">".$linha['quantidadeContratos']."</td>
        <td><a href=\"index.php?pagina=Consulta&tipo=alterar&cod=".$linha['codProtocolo']."\">Alterar</td>
        <td><a href=\"index.php?pagina=Consulta&tipo=excluir&cod=".$linha['codProtocolo']."\">Excluir</td>
        </tr>";
        }

$total = mysql_num_rows($resultado);

echo"<tr>
<th colspan=\"7\">Total de Registros:$total</th>
</tr>
</table>
</div>";
        
}



function deletarProtocolo($codProtocolo){
    $sql = "DELETE FROM itemProtocolo WHERE codProtocolo='$codProtocolo';";
    $resultadosql = mysql_query($sql) or die ("erro sql deletarItemProtocolo".mysql_error());

    $sql = "DELETE FROM protocolo WHERE codProtocolo='$codProtocolo';";
    $resultadosql = mysql_query($sql) or die ("erro sql deletarItemProtocolo".mysql_error());

    echo "<div class=\"msgR\">Protocolo Deletado</div>";
}


$dado = $_POST['dado'];
$campo = $_POST['campo'];

$tipo = $_GET['tipo'];
$codProtocolo = $_GET['cod'];


if (array_key_exists("consultar",$_POST)){
    formulario();
    consultar($dado,$campo);
    }
    if ($tipo=="excluir"){
        deletarProtocolo($codProtocolo);
        formulario();
        }
        if ($tipo=="alterar"){
            ;
            require("cadastroProtocolo.php?cod=$codProtocolo");
            }
            if(!$tipo =='excluir' && !array_key_exists("consultar",$_POST)){
                formulario();
                }

?>

