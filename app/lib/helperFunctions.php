<?php
if (!function_exists('if_seven'))
{

    /**
     * return the operator
     *
     * @param $number
     * @return string
     */
    function if_seven($operator_games)
    {
        $fact = 1;

        for($i = 1; $i <= $num ;$i++)
            $fact = $fact * $i;

        return $fact;

     }
}