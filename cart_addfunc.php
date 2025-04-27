<?php
//the function is responsible for adding a product to the cart
function addToCart($element, $quantity){
    global $serwer;
    $zapytanie = "select ImageID, Name, Price, Hashtag, ProductID, AmountOnStock from product where ProductID=$element";
    $wynik = mysqli_query($serwer, $zapytanie);
    $wiersz = mysqli_fetch_row($wynik);

    //checking whether the ordered quantity is not greater than the quantity of available products
    if($wiersz[5] < $quantity){

        echo '<script>alert("There are not that many products in stock, the maximum possible quantity at the moment is: '.$wiersz[5].'")</script>';

    }

    else{

        //checking if the cart exists, otherwise creating it
        if(isset($_SESSION['cart'])) {
            $itemArrayID = array_column($_SESSION['cart'],"ProductID");
            //schecking whether the added product is already in the basket by searching
            //ProductID column from the cart to find whether the product ID being added is already there
            if(!in_array($wiersz[4],$itemArrayID)){
                $count = count($_SESSION['cart']);
                $item = array("ImageID"=>$wiersz[0],"Name"=>$wiersz[1],"Price"=>$wiersz[2],"Hashtag"=>$wiersz[3],"ProductID"=>$wiersz[4],"Quantity"=>$quantity,"AmountOnStock"=>$wiersz[5]);
                $_SESSION['cart'][$count] = $item;
                echo '<script>window.location="menu.php?msg=1"</script>';
            }
            else{
                echo '<script>window.location="menu.php?msg=2"</script>';
            }
        }
        else{
            $_SESSION['cart'][0] = array("ImageID"=>$wiersz[0],"Name"=>$wiersz[1],"Price"=>$wiersz[2],"Hashtag"=>$wiersz[3],"ProductID"=>$wiersz[4],"Quantity"=>$quantity, "AmountOnStock"=>$wiersz[5]);
            echo '<script>window.location="menu.php?msg=1"</script>';
        }
    }
}
?>
