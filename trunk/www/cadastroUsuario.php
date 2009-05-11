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
  <td class=\"descCampo\"><label for=\"produto\" >Produto:</label></td>
  <td>
    <input type=\"checkbox\" name=\"produto1\" value=\"Consignado Publico\"><label>Consignado Publico<BR></label>
    <input type=\"checkbox\" name=\"produto2\" value=\"Consignado Privado\"><label>Consignado Privado<BR></label>
    <input type=\"checkbox\" name=\"produto3\" value=\"CDC Veiculos\"><label>CDC Ve�culos</label>
  </td>
</tr>
<tr>
  <td class=\"descCampo\" ><label for=\"nivel\">Nivel: </label></td>
  <td><select size=\"1\" name=\"nivel\" id=\"nivel\" style=\"width: 320px;\">
   <option>Administrador</option>
   <option>Receptor</option>
   <option>Usuário</option>
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

$nome = $_POST['nome'];
$email = $_POST['email'];
$dataCriacao = $_POST['datacriacao'];
$nivel = $_POST['nivel'];
$status = $_POST['status'];
$codEmpresa = $_POST['empresa'];
$produto1 = $_POST['produto1'];
$produto2 = $_POST['produto2'];
$produto3 = $_POST['produto3'];

//inicio if - faz a verificaçao de qual varial recebeu conteudo da checkbox
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

echo "<font aling=center><div class=msg>Usuário gravado com sucesso<br>
Senha para Acesso: $numeroAleatorio
</div></font>";

};
//fim gravar

//inicio gerasenha
function geraSenha($size = 6, $type = 4)
{
    if ($size < 6)
    {
        echo "<strong>Erro:</strong> O parâmetro <em>size</em> da função <strong>".__FUNCTION__."()</strong> deve ser maior do que 6";
        return false;
    }
    if ($size > 50)
    {
        echo "<strong>Erro:</strong> O parâmetro <em>size</em> da função <strong>".__FUNCTION__."()</strong> deve ser menor do que 50";
        return false;
    }

    /*
    A variável $ok fará a verificação do argumento RAND_TYPE. Se o valor do argumento for válido, o valor da variável passaa de "false" para "true".
    */
    $ok = false;
    if ($type == 2)
        $ok = true;
    if ($type == 3)
        $ok = true;
    if ($type == 4)
        $ok = true;

    if ($ok === false)
    {
        echo "<strong>Erro:</strong> Valor inválido para o parâmetro <em>RAND_TYPE</em> da função <strong>".__FUNCTION__."()</strong>";
        return false;
    }

    $up_letters = range ("A", "Z");// letras em caixa alta (upper case)
    $low_letters = range ("a", "z");// letras em caixa baixa (lower case)
    $letras = array_merge ($low_letters, $up_letters);// letras maiúsculas e minúsculas
    $numeros = range (0, 9);// números de 0 a 9

    if ($type == 2)// se RAND_TYPE for RAND_NUM
    {
        $elementos = $numeros;

        //gera um array com, pelo menos, 50 elementos
        $m = count($numeros);
        while ($m < 50)
        {
            $elementos = array_merge ($elementos, $numeros);
            $m += count ($numeros);
        }
    }
    if ($type == 3)// se RAND_TYPE for RAND_ALPHA
        $elementos = $letras;
    if ($type == 4)// se RAND_TYPE for RAND_BOTH
        $elementos = array_merge ($letras, $numeros);

    $x = array_rand ($elementos, $size);// gera um array com $size elementos contendo as chaves do array $elementos
    sort ($x);
    reset ($x);

    for ($c = 0; $c < $size; $c++)
    {
        $cod[$c] = $elementos[$x[$c]];
    }


    //Se RAND_TYPE for RAND_BOTH, no mínimo um terço dos elemntos do código deverá ser números.
    if ($type === 4)
    {
        $num_count = 0;// variável que armazenará o total de números do código
        for ($z = 0; $z < 10; $z++)
        {
            if (in_array ($z, $cod, TRUE))
                $num_count++;
        }
        $um_terco = (int)($size / 3);// um terço de $size
        if ($num_count < $um_terco)//se o total de números for menor que um terço de $size
        {
            $num_que_faltam = $um_terco - $num_count;// quantos números faltam para chegar a $um_terco
            for ($w = 1; $w <= $num_que_faltam; $w++)
            {
                array_shift ($cod);// retira o primeiro elemento do array (sempre uma letra)
                $key_num = array_rand ($numeros, 1);// sorteia uma chave do array $numeros
                array_push ($cod, $numeros[$key_num]);// adiciona um número no final do array $cod
            }
        }
    }
    shuffle ($cod);// embaralha os elemntos do array, para que não fiquem letras minúsculas seguidas de maiúsculas seguidas de números.
    $code = implode ("", $cod);

    return $code;

}
//fim gerasenha
if (!array_key_exists("salvar",$_POST)){
formulario();
   }
   else{
     gravar();
    formulario();

     }


?>

