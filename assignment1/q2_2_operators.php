<?php
function compare($num1,$num2){
    if($num1>$num2)
    echo "$num1 is greater than $num2";
    elseif($num1<$num2)
    echo "$num1 is smaller than $num2";
    else
    echo "$num1 is equal to $num2";

    
}
compare(5,6)
?>