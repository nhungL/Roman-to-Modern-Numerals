<?php
    //Check if input contains valif letters for Roman numerals.
    function validLetter($string){
        //Array of valid letters in Roman numeral
        $validRo = array ("I","V","X","L","C","D","M");
        if (empty($string))
            return 0;
        else{
            $string = strtoupper($string);                //Change to uppercase
            $letters = str_split($string);               //Array of letters splitted from string input
            foreach($letters as $letter){
                if (!in_array($letter, $validRo)){      //Check if it's a valid letter 
                    return 0;
                }
            }
            return 1;
        }
    }

    //Check Roman numeral rules using regex
    function roRule($input){
        //Regex
        $roValid = '/^M{0,3}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/';

        if (empty($input))
            return 0;
        else
            return (preg_match($roValid, $input));      // return 1 if pass
    }

    //check if input is a valid Roman numeral
    function checker($input){
        //Check if input is empty
        if (empty($input))
            return 0;
        else{
            if(validLetter($input))
                return roRule($input);
            return 0; 
        }
    }

    //convert_function
    function romanToModern($roman){
        //list of roman numerals
        $list = array ('I'=> 1, 'IV'=> 4,
                        'V'=> 5, 'IX'=> 9,
                        'X'=> 10, 'XL'=>40,
                        'L'=> 50, 'XC'=> 90,
                        'C'=> 100, 'CD'=> 400,
                        'D'=> 500, 'CM'=> 900,
                        'M'=> 1000);
        $modern = 0;
        $length = strlen($roman);

        // if input passes checker()
        if (checker($roman) == 1){
            for ($i = 0; $i < $length; $i++) {
                if (($i !== $length - 1) && ($list[$roman[$i]] < $list[$roman[$i + 1]])) {
                    $modern += $list[$roman[$i + 1]] - $list[$roman[$i]];
                    $i++;
                }
                else{
                    $modern += $list[$roman[$i]];   
                }
            }
            return $modern;  
        }
        else{
            echo "Invalid input.";
        }
    } 

    //tester_function
    function tester($roman, $number){
        $output = romanToModern($roman);
        if ($output === $number)
            echo "Pass.";
        else
            echo "Not Pass.";
    }

    echo "Test Cases:"."<br>";
    $romanNum = array("MMMM", "MCMXCVIII", -1, "", "MMXXI");
    $modernNum = array(4000, 1998, -1, 0, 2021);

    for ($i = 0; $i < count($romanNum); $i++){
        echo $i."<br>";
        echo $romanNum[$i]." vs ".$modernNum[$i]."<br>";
        tester($romanNum[$i],$modernNum[$i]);
        echo "<br>";
    }
    
?>