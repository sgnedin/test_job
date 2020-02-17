<?php
//Сортировка массива array_swap
$array = [4, 5, 8, 9, 1, 7, 2]; //Входной массив

$length = count($array);
for ($i=0; $i <= count($array)-1 ; $i++) { 
    $key = max_key($array, $length);
    if($key == 0) {
        array_swap($array, $length - 1);
    } else {
        array_swap($array, $key);
        array_swap($array, $length - 1);
    }
    $length --;
}

pr($array);

function max_key(array $array, int $length): int
{
    array_splice($array, $length);

    return array_keys($array, max($array))[0];
}

function array_swap(array &$array, int $index)
{
    $null = $array[0];
    $flip = $array[$index];
    $array[$index] = $null;
    $array[0] = $flip;
}

function pr(array $array): void
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
