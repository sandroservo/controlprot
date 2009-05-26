<?php
session_start();
?>
<body onload="document.cadastro.nome.focus()">

<link href="adm.css" rel="stylesheet" type="text/css" />


<script type="text/javascript">

function verificar(){
if (document.cadastro.nome.value==""){
document.cadastro.nome.focus()
alert("Digite um Nome")
return false
}
if (document.cadastro.email.value==""){
document.cadastro.email.focus()
alert("Digite um Email")
return false
}
if (document.cadastro.codEmpresa.value==""){
document.cadastro.email.focus()
alert("Digite uma Empresa")
return false
    }
}
</script>




<?
require "conectar.php";

//inicio formulario
function formulario(){


echo "<body onLoad=\"aa()\"><form method=\"POST\" name=\"cadastro\" onSubmit=\"return verificar()\" action=\"cadastroUsuario.php\">
<table border=\"0\" align=\"center\" >
<tr>
  <td class=\"descCampo\"><label for=\"nome\">Nome e Sobrenome:</label></td>
  <td><input type=\"text\" size=\"50\" name=\"nome\" id=\"nome\"></td>
</tr>
<tr>
  <td class=\"descCampo\" ><label for=\"email\" >Email: </label></td>
  <td><input type=\"text\" size=\"50\" name=\"email\" id=\"email\"></td>
</tr>
<tr>
  <td class=\"descCampo\" ><label for=\"cpf\">CPF: </cpf></td>
  <td><input type=\"text\" maxlength=\"11\" size=\"50\" name=\"cpf\" id=\"cpf\"></td>
</tr>
<tr>
  <td class=\"descCampo\"><label for=\"produto\" >Produto:</label></td>
  <td>
    <input type=\"checkbox\" name=\"produto1\" value=\"Consignado Publico\"><label>Consignado Publico<BR></label>
    <input type=\"checkbox\" name=\"produto2\" value=\"Consignado Privado\"><label>Consignado Privado<BR></label>
    <input type=\"checkbox\" name=\"produto3\" value=\"CDC Veiculos\"><label>CDC VeÌculos</label>
  </td>
</tr>
<tr>
  <td class=\"descCampo\" ><label for=\"nivel\">Nivel: </label></td>
  <td><select size=\"1\" name=\"nivel\" id=\"nivel\" style=\"width: 320px;\">
   <option>Administrador</option>
   <option>Receptor</option>
   <option>Usu√°rio</option>
   </select>
</tr>
<tr>
  <td class=\"descCampo\"><label for=\"status\" >Status: </label></td>
  <td><select size=\"1\" name=\"status\" id=\"status\" style=\"width: 320px;\" onChange=\"aa()\">
   <option value=\"A\">Ativado</option>
   <option value=\"D\">Desativado</option>
   </select>
</tr>
<tr>
  <td  class=\"descCampo\"><label for=\"empresa\">Empresa: </label></td>
  <td><select name=\"empresa\" style=\"width: 320px;\">";

    //codigo para listar os nomes das empresas cadastradas na tabela empresa
    $sql = "select codEmpresa,nome from empresa ";
    $resultado = mysql_query($sql) or die ("erro sql".mysql_error());


while( $dados = mysql_fetch_assoc($resultado) ){
            echo '<option value="'.$dados['codEmpresa'].'">'.$dados['nome'].'</option>'."\n";
            }
     //fim codigo para listar

echo "</select>
</td>
</tr>
<tr>
    <td colspan=2 align=\"center\"><input type=\"submit\" value=\"salvar\" name=\"salvar\" >
</tr>
</table>
</form></body>";
}
//fim formulario

//inicio gravar - insere campos por sql no banco de dados
function gravar(){

    $numeroAleatorio = rand();
    $senha = md5($numeroAleatorio.dificilsenha2009);

$nome = ucwords($_POST['nome']);
$email = strtolower($_POST['email']);
$dataCriacao = $_POST['datacriacao'];
$nivel = $_POST['nivel'];
$status = $_POST['status'];
$codEmpresa = $_POST['empresa'];
$produto1 = $_POST['produto1'];
$produto2 = $_POST['produto2'];
$produto3 = $_POST['produto3'];

//buscar se existir caracteres n„o autorizados, se existir ele retira.
$cpf = str_replace(".","",$_POST['cpf']);
$cpf = str_replace("-","",$cpf);
$cpf = str_replace("/","",$cpf);
$cpf = str_replace("_","",$cpf);

$login = substr($cpf,0,5);

//inicio if - faz a verifica√ßao de qual varial recebeu conteudo da checkbox
if ($produto1 == ""){
$todas = $produto2." / ".$produto3;
}
if ($produto2 == ""){
    $todas = $produto1." / ".$produto3;
}
if ($produto3 == ""){
    $todas = $produto1." / ".$produto2;
}
if ($produto1 =="" && $produto2 == ""){
    $todas = $produto3;
}

if ($produto1 =="" && $produto3 == ""){
    $todas = $produto2;
}

if ($produto2 =="" && $produto3 == ""){
    $todas = $produto1;
}
if ($produto2 <>"" && $produto3 <> "" && $produto1 <>""){
    $todas = $produto1." / ".$produto2." / ".$produto3;
}
//fim if


$sql = "INSERT INTO usuarios (codUsuario,nome,email,produto,senha,dataCriacao,nivel,status,codEmpresa) VALUES (' ','$nome','$email','$todas','$senha',now(),'$nivel','$status','$codEmpresa')";
$resultadosql = mysql_query($sql) or die ("erro sql".mysql_error());

echo "<font aling=center><div class=msg>Usu√°rio gravado com sucesso<br>
Senha para Acesso: $numeroAleatorio
</div></font>";

};
//fim gravar

//inicio gerasenha

if (!array_key_exists("salvar",$_POST)){
formulario();
   }
   else{
     gravar();
    formulario();

     }


?>

