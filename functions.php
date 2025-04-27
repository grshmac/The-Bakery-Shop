<?php
//spage with functions for creating a selection list
//$getElements - tabela
//$name - nazwa listy wyboru
//$ID - nazwa klucza z tabeli

//creating a new selection list
function newList($getElements, $name, $ID){
    echo '<select name='.$name.'>';
    while($elemenets = mysqli_fetch_array($getElements)){
        echo "<option value='$elemenets[$ID]'>$elemenets[Name]</option>";
      }
        mysqli_free_result($getElements);
    echo'</select>';
  }

//creating a new select list with the already selected item specified in the $selectedID argument
function selectedList($getElements, $name, $ID, $selectedID){
    echo '<select name='.$name.'>';
    while($elemenets = mysqli_fetch_array($getElements)){
        if($selectedID == $elemenets['Name']){
            echo "<option selected='selected' value='$elemenets[$ID]'>$elemenets[Name]</option>";
        }
        else echo "<option value='$elemenets[$ID]'>$elemenets[Name]</option>";
      }
        mysqli_free_result($getElements);
    echo'</select>';
  }
?>