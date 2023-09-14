<?php

    $array_list = ['11', '12', 'cii', '001', '2', '1998', '7', '89', 'iia', 'fii'];
    $words      = [];
    $all_words  = [];

    foreach ($array_list as $key => $value) {
        if (strpos($value, 'i') !== FALSE) {
            $words[$value] = $value; 
        }
    }

    foreach ($words as $key => $value) {

        $word_length    = strlen($value);
        $output_array   = [];

        for ($i = 0; $i < $word_length; $i++) {

            $substring = '';

            for ($j = $i; $j < $word_length; $j++) {

                $substring .= $value[$j];
                $output_array[] = $substring;
            }
        }

        unset($output_array[3]);
        
        $string = "{";

        foreach ($output_array as $key_output => $value_output) {
            $string .= '"'. $value_output .'"';

            if ($key_output != count($output_array)) {
                $string .= ", ";
            }
        }

        $string .= "}";

        echo $key .' = '. $string .'<br>';

        $all_words = array_merge($all_words, $output_array);
    }

    $all_words = array_values(array_unique($all_words));

    $string = "{";

    foreach ($all_words as $key => $value) {
        $string .= '"'. $value .'"';

        if ($key != count($all_words) - 1) {
            $string .= ", ";
        }
    }

    $string .= "}";

    echo 'S = '.  $string;
?>