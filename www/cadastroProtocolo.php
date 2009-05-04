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
<form method=\"POST\" name=\"cadastro\" onSubmit=\"return verificar()\" action=\"cadastroEmpresa.php\">
<table border=\"0\" align=center>
<tr>
  <td class=\"descCampo\" ><label for=\"cpfCnpj\">Cpf/Cnpj:</label></td>
  <td><input type=\"text\" maxlength=\"18\" size=\"18\" name=\"cpfCnpj\" id=\"cpfCnpj\"></td>
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
<tbody>";

    $sql = "select * from itemprotocolo A
            join
            protocolo B
            on A.codProtocolo = B.codProtocolo
            where A.codProtocolo = '0001/09'";
    $resultado = mysql_query($sql) or die ("erro sql".mysql_error());

while ($linha = mysql_fetch_array($resultado)){
echo "<tr>
    <td>asdf</td>
    <td>asdf</td>
    <td>asdf</td>
    <td>asdf</td>
</tr>";

echo "</tbody>
</table>
</div>
</form>";

}
}
//fim formulario

//insere campos por sql no banco de dados
function gravar(){


$empresa = $_POST['empresa'];
$cidade = $_POST['cidade'];
$status = $_POST['status'];
$estado = $_POST['estado'];
$sql = "INSERT INTO empresa (codEmpresa,nome,cidade,estado,status) VALUES (' ','$empresa','$cidade','$estado','$status')";
$resultadosql = mysql_query($sql) or die ("erro sql".mysql_error());
echo "<div class=msg>Registro gravado com sucesso</div>";

};
//fim gravar

if (!array_key_exists("salvar",$_POST)){
formulario();
   }
   else{
   gravar();
   formulario();

     }


?>