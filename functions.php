<?php
    // write a function to return the calculated calorie burn based on
    // age in whole years, gender, weight in pounds, avg heart rate, and exercise time in minutes
    // returns the calories burned rounded to the nearest whole calorie
    
    function calculate_calorie_burn($age, $gender, $weight, $heart_rate, $time)
    {
        
        $calorie_burn = 0;
        
        // convert the entry to lower case once so it works for the rest of the function
        $gender = strtolower($gender);
        
        if ($gender == 'm' || $gender == 'male')
        {
            // code to calculate male caloric burn
            $calorie_burn = ((-55.0969 + (0.6309 * $heart_rate) + (0.090174 * $weight) + (0.2017 * $age)) / 4.184) * $time;
        }
        if ($gender == 'f' || $gender == 'female')
        {
            // code to calculate female caloric burn
            $calorie_burn = ((-20.4022 + (0.4472 * $heart_rate) - (0.057288 * $weight) + (0.074 * $age)) / 4.184) * $time;
        }
        
        return round($calorie_burn);
    }
    
    function calculate_age ($date)
    {
        // this is where I'll need to figure out how to calculate age based on birthdate
        
        // a little help thanks to a contributor on StackOverflow
        //https://stackoverflow.com/users/4346951/ramon-bakker
        // I'd have gotten to this on my own eventually, but this saved me a lot of time.
        $birthday = new DateTime($date);
        $now = new DateTime();
        $age = $now->diff($birthday);
        return $age -> y;
    }
?>