<?php
// Following program is a PHP 
// implementation of Rabin Karp
// Algorithm given in the CLRS book 
  
// d is the number of characters
// in the input alphabet
// $d = 256;
  
/* pat -> pattern
   txt -> text
   q -> A prime number
*/
function search($pat, $txt, $q)
{
    $M = strlen($pat);
    $N = strlen($txt);
    $i; $j;
    $p = 0; // hash value 
            // for pattern
    $t = 0; // hash value 
            // for txt
    $h = 1;
    $d = 256;
  
    
    for ($i = 0; $i < $M - 1; $i++)
        $h = ($h * $d) % $q;
 
    for ($i = 0; $i < $M; $i++)
    {
        $p = ($d * $p + ord($pat[$i])) % $q;
        $t = ($d * $t + ord($txt[$i])) % $q;
    }
  
    
    for ($i = 0; $i <= $N - $M; $i++)
    {
  
       
        if ($p == $t)
        {
            
            for ($j = 0; $j < $M; $j++)
            {
                if ($txt[$i + $j] != $pat[$j])
                    break;
            }
  
            
            if ($j == $M)
                echo "Pattern found at index ".$i. "\n";
        }
  
       
        if ($i < $N - $M)
        {
            $t = ($d * ($t - ord($txt[$i]) * $h) + ord($txt[$i + $M])) % $q;
  
            if ($t < 0)
            $t = ($t + $q);
        }
    }
}
  
// Driver Code
$txt = "cbaa";
$pat = "aa";
  
// A prime number
$q = 101;
  
// Function Call
search($pat, $txt, $q);
  
?>