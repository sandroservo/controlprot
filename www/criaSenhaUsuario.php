<?php
//AUTOR: Roberto Beraldo.
// constantes usadas no argumento RAND_TYPE da função code_rand()
define ("RAND_NUM", 2);
define ("RAND_ALPHA", 3);
define ("RAND_BOTH", 4);

function code_rand ($size = 6, $type = 4)
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


//gera um código com 6 caracteres, dentre letras e números
echo code_rand (8);

// gera um código com 20 algarismos inteiros
//echo code_rand (20, RAND_NUM);

// gera um código com 35 letras
//echo code_rand (35, RAND_ALPHA);

//gera um código com 50 caracteres, dentre letras e números
//echo code_rand (50, RAND_BOTH);
?>
