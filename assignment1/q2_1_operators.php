<?php
function operations($num1,$op,$num2)
{
    switch($op){
        case'+':
            echo $num1+$num2;
        break;
        case'-':
            echo $num1-$num2;
        break;
        case'*':
            echo $num1*$num2;
        break;
        case'/':
            echo $num1/$num2;
        break;
        default:
        echo "invalid operator";

    }
}
operations(10,'+',5)
?>