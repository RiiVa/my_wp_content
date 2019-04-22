<?php 

$sex = $_POST["sex"];
$year_birthday = $_POST["year_birthday"];
$weight = $_POST["weight"];
$height =$_POST["height"];

$height_100 = $height / 100;
$result = $weight /( $height_100 * $height_100 );

$age = date("Y") - $year_birthday;

$mas_female = array(
                    148 => array (48.4, 52.3, 54.7, 53.2, 52.2),
                    150 => array (48.9, 53.9, 56.5, 55.7, 54.8),
                    152 => array (51.0, 55.0, 59.5, 57.8, 55.9),
                    154 => array (53.0, 59.1, 62.4, 60.2, 59.0),
                    156 => array (55.8, 61.5, 66.0, 62.4, 60.9),
                    158 => array (58.1, 64.1, 67.9, 64.5, 62.4),
                    160 => array (59.8, 65.8, 69.9, 65.8, 64.6),
                    162 => array (61.6, 68.5, 72.2, 68.7, 66.5),
                    164 => array (63.6, 70.8, 74.0, 72.0, 70.0),
                    166 => array (65.2, 71.8, 76.5, 73.8, 71.5),
                    168 => array (68.5, 73.7, 78.2, 74.8, 73.3),
                    170 => array (69.2, 75.8, 79.8, 76.8, 75.0),
                    172 => array (72.8, 77.0, 81.7, 77.7, 76.3),
                    174 => array (74.3, 79.0, 83.7, 79.4, 78.0),
                    176 => array (76.8, 79.9, 84.6, 80.5, 79.1),
                    178 => array (78.2, 82.4, 86.1, 82.4, 80.9),
                    180 => array (80.9, 83.9, 88.1, 84.1, 81.6),
                    182 => array (83.3, 87.7, 89.3, 86.5, 82.9),
                    184 => array (85.5, 89.4, 90.9, 87.4, 85.8),
                    186 => array (89.2, 91.0, 92.9, 89.6, 87.3),
                    188 => array (91.8, 94.4, 95.8, 91.5, 88.8),
                    190 => array (92.3, 95.6, 97.4, 95.6, 91.9)
);

$mas_man = array(
                    148 => array (50.8, 55.0, 56.6, 56.0, 53.9),
                    150 => array (51.3, 56.7, 58.1, 58.0, 57.3),
                    152 => array (51.3, 58.7, 61.5, 61.1, 68.3),
                    154 => array (55.3, 61.6, 64.5, 63.8, 61.9),
                    156 => array (58.5, 64.4, 67.3, 65.8, 63.7),
                    158 => array (61.2, 67.3, 70.4, 68.0, 67.0),
                    160 => array (62.9, 69.2, 72.3, 69.7, 68.2),
                    162 => array (64.6, 71.0, 74.4, 72.7, 69.1),
                    164 => array (67.3, 73.9, 77.2, 75.6, 72.2),
                    166 => array (68.8, 74.5, 78.0, 76.3, 74.3),
                    168 => array (70.8, 76.3, 79.6, 77.9, 76.0),
                    170 => array (72.7, 77.7, 81.0, 79.6, 76.9),
                    172 => array (74.1, 79.3, 82.8, 81.1, 78.3),
                    174 => array (77.5, 80.8, 84.4, 83.0, 79.3),
                    176 => array (80.8, 83.3, 86.0, 84.1, 81.9),
                    178 => array (83.0, 85.6, 88.0, 86.5, 82.8),
                    180 => array (85.1, 88.0, 89.9, 87.5, 84.4),
                    182 => array (87.2, 90.6, 91.4, 89.5, 85.4),
                    184 => array (89.1, 92.0, 92.9, 91.6, 88.0),
                    186 => array (93.1, 95.0, 96.6, 92.8, 89.0),
                    188 => array (95.8, 97.0, 98.0, 95.0, 91.5),
                    190 => array (97.1, 99.5, 100.7, 99.4, 94.8)
);

    
    $data = array();
    
    
        
        $text = "Your weight is exceeded";
        $text2 = "Normal weight";
        $text3 = "The data table is not designed for your age.";

$result_round = round($result, 2);
$result_round_4 = round($result, 4);
$data["result"] = "$result_round";

switch ($result_round_4){
    case ($result_round_4>=17 and $result_round_4<=20) :  $data["result_text"]="Underweignt BMI"; break;
    case ($result_round_4>=20 and $result_round_4<=25) :  $data["result_text"]="Normal weight BMI"; break;
    case ($result_round_4>=26 and $result_round_4<=29) :  $data["result_text"]="Slighty overweight BMI"; break;
    case ($result_round_4>=30 and $result_round_4<=37) :  $data["result_text"]="Overweight BMI"; break;
    case ($result_round_4>=40) :  $data["result_text"]="Extremely Overweight BMI"; break;
    case ($result_round_4>=40 or $result_round_4<17) :  $data["result_text"]="No classification BMI"; break;
    default : echo "Error 1"; break;
}
        


    if ($sex == "1" and $height < "190"  and $weight >= "48"){
        foreach ($mas_female as $key => $value ) {
           if($key == $height){ 
            
                        if ($age>=20 and $age<=29){
                            $result_weight = $value[0] - $weight;
                            if($result_weight <= "1"){
                                $data['message']= $text; 
                            }else{
                                $data['message']= $text2; 
                            } 
                        } elseif($age>=30 and $age<=39){
                            $result_weight = $value[1] - $weight;
                            if($result_weight <= "1"){
                                $data['message']= $text; 
                            }else{
                                $data['message']= $text2;  
                            } 
                        } elseif($age>=40 and $age<=49){
                            $result_weight = $value[2] - $weight;
                            if($result_weight <= "1"){
                                $data['message']= $text; 
                            }else{
                                $data['message']= $text2;  
                            }  
                        } elseif($age>=50 and $age<=59){
                            $result_weight = $value[3] - $weight;
                            if($result_weight <= "1"){
                                $data['message']= $text; 
                            }else{
                                $data['message']= $text2; 
                            } 
                        } elseif($age>=60 and $age<=69){
                            $result_weight = $value[4] - $weight;
                            if($result_weight <= "1"){
                                $data['message']= $text;
                                
                            }else{
                              $data['message']= $text2; 
                            } 
                           
                        }else{
                            $data['message']= $text3;
                           
                        }    
                }  
            }
     }else{ $data['message']= $text3; }

if ($sex == "2" and $height < "190"  and $weight >= "48"){
        foreach ($mas_man as $key => $value ) {
           if($key == $height){ 
            
                        if ($age>=20 and $age<=29){
                            $result_weight = $value[0] - $weight;
                            if($result_weight <= "1"){
                                $data['message']= $text; 
                            }else{
                                 $data['message']= $text2; 
                            } 
                        } elseif($age>=30 and $age<=39){
                            $result_weight = $value[1] - $weight;
                            if($result_weight <= "1"){
                                $data['message']= $text; 
                            }else{
                                $data['message']= $text2;  
                            } 
                        } elseif($age>=40 and $age<=49){
                            $result_weight = $value[2] - $weight;
                            if($result_weight <= "1"){
                                $data['message']= $text; 
                            }else{
                                $data['message']= $text2;  
                            }  
                        } elseif($age>=50 and $age<=59){
                            $result_weight = $value[3] - $weight;
                            if($result_weight <= "1"){
                                $data['message']= $text; 
                            }else{
                                $data['message']= $text2; 
                            } 
                        } elseif($age>=60 and $age<=69){
                            $result_weight = $value[4] - $weight;
                            if($result_weight <= "1"){
                                $data['message']= $text;
                                
                            }else{
                              $data['message']= $text2; 
                            } 
                           
                        }     
                } 
            }
     }else{ $data['message']= $text3; }



echo json_encode($data);

?>