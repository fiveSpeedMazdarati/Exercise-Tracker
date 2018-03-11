<?php
    // write a function to return the calculated calorie burn based on
    // age in whole years, gender, weight in pounds, avg heart rate, and exercise time in minutes
    // returns the calories burned rounded to the nearest whole calorie
    
    function calculate_calorie_burn($age, $gender, $weight, $heart_rate, $time){
        
        $calorie_burn = 0;
        
        if ($gender == 'male')
        {
            // code to calculate male caloric burn
            $calorie_burn = ((-55.0969 + (0.6309 * $heart_rate) + (0.090174 * $weight) + (0.2017 * $age)) / 4.184) * $time;
        }
        if ($gender == 'female')
        {
            // code to calculate female caloric burn
            $calorie_burn = ((-20.4022 + (0.4472 * $heart_rate) - (0.057288 * $weight) + (0.074 * $age)) / 4.184) * $time;
        }
        
        return $calorie_burn;
    }
?>