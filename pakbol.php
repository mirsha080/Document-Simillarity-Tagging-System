<?php 

// function black_or_white($string){

//     if ($string[0] == 'a' || $string[0] == 'c' || $string[0] == 'e' || $string[0] == 'g') {
//         if ($string[1] == '1' || $string[1] == '3' || $string[1] == '5' || $string[1] == '7')
//             echo 'Black';
//         else
//             echo 'White';
//     }
//     else {
//         if ($string[1] == '1' || $string[1] == '3' || $string[1] == '5' || $string[1] == '7')
//            echo 'White';
//         else
//            echo 'Black';
//     }

//  }
// black_or_white("e3");





// -------------------------------------------- //
$x = [[5,9,7,17,13,0],[8,10,16,35,7,5],[10,17,5]];
print_r($x);

$arr = [];
$sizes = [];

foreach($x as $inner_array){
   $sizes[] = count($inner_array);
   foreach($inner_array as $val){
	   $arr[] = $val;
   }
}
sort($arr);


$k = 0;
for($i = 0; $i < count($x); $i++){
	
	for($j = 0; $j < $sizes[$i]; $j++){
		$x[$i][$j] = $arr[$k];
		$k++;
	}
}

echo "<br>"; 
print_r($x);


?>