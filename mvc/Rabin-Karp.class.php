<?php
// d is the number of characters
// in the input alphabet

  
/* pat -> pattern
   string -> text
   mod -> A prime number
*/

  
// This code is contributed
// by ajit


Class RabinKarp{
    function getHash($string  , $mod)
    {

       
        $string = strtolower($string);
        $len =  strlen($string);
        $i; $j;
        $hash = 0; // hash value 
                // for string
        $h = 1;
        $d =256;
 
     
    
        // The value of h would
        // be "pow(d, M-1)%mod"
        for ($i = 0; $i <  $len - 1; $i++)
            $h = ($h * $d) % $mod;
    
        // Calculate the hash value
        for ($i = 0; $i <  $len; $i++)
        {
            $hash = ($d * $hash + ord($string[$i])) % $mod;
           

        }

      


        





        return  $hash;

    
        
    }
}
    
?>