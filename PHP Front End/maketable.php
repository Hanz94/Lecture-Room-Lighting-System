<?php include 'header.php';
            require 'connect.php';
            $day = array("monday","tuesday","wednesday","thursday","friday");
            $tablelist = array();
            for ($x = 0; $x <= 4; $x++){
                $query = "SELECT * FROM `schedule` WHERE `day` = '$day[$x]'";
                    if($query_run = mysql_query($query)){
                        if(mysql_num_rows($query_run)==NULL){
                            echo "No results found";
                        }
                        else{
                            $dynamicList = "";
                            while($query_row = mysql_fetch_assoc($query_run)){
                                $start_time = $query_row['start_time'];
                                $end_time = $query_row['end_time'];
                                $module = $query_row['module_name'];
                                $lecturer = $query_row['lecturer_name'];
                                $id = $query_row['id'];
                                $booked = $query_row['booked'];
                                if($booked == 0){
                                    $colour = "#80FF80";
                                }
                                else{
                                    $colour = "#FF1919";
                                }
                                $dynamicList .= "<tr style='background-color:$colour' >
                            <td>$start_time</td>
                            <td>$end_time</td>
                            <td>$module </td>
                            <td>$lecturer</td>
                            <td>
                                <button type='submit' name='schedule' value='$id'/>Schedule</button>
                                <button type='submit' name='unschedule' value='$id'/>Unschedule</button>
                            </td>
                            </tr>";
                            }
                            array_push($tablelist, $dynamicList);
                        }
                    }
                }
        ?>