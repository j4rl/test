<!DOCTYPE html>
<?php 
    $units="";    
    if(isset($_POST['submit'])){

        $units=$_POST['units'].
        ' {"Unit":"'
        .$_POST['unit'].
        '", "Cost":"'
        .$_POST['cost'].
        '"},';
    }

    if(isset($_POST['btn'])){
        $temp=rtrim($_POST['hidden'], ',');
        $units= '{ "Army":"'.$_POST['army'].'", "Units":'.makeNice($temp).'}';
    }

    function makeNice($strString){
        return '['.ltrim(rtrim($strString, ','),' ').']';
    }

    

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="saga.css">
</head>
<body>
<div class="allforms">
    <form method="post" action="saga.php">
        <input type="text" name="unit" placeholder="Unit">
        <input type="text" name="cost" placeholder="Cost">
        <input type="hidden" name="units" value='<?=$units?>'>
        <input type="submit" name="submit" value="Add">

    </form><br>
   
    <br>
    <?php if(strlen($units)){ ?>
    <form method="post" action="saga.php">
        <input type="text" name="army" placeholder="Army name">
        <input type="hidden" name="hidden" value='<?=$units?>'>
        <input type="submit" name="btn" value="Save">
    </form>
</div>
    <div class="units">

    </div>    
<?php } ?>

</body>
</html>
<?php
if(isset($_POST['btn'])){  ?>
<script>
    const units=document.querySelector('.units');
    const forms=document.querySelector('.allforms');
    forms.style.display="none";
    var strJSON=<?=$units?>;
    var obj=strJSON;
    var unit=document.createElement('div');
    var totCost=0;
    var temp="";
    for(var i=0; i<obj.Units.length; i++){
    
        temp+=obj.Units[i].Unit+" "+obj.Units[i].Cost+"<br>";
        totCost+=parseInt(obj.Units[i].Cost);
       
    }
    unit.classList.add('unit');
    unit.innerHTML="<h1>"+obj.Army+"</h1>"+temp+"<br>Total Cost: "+totCost;
    units.appendChild(unit);   
</script>

    <?php } ?>
<?php if(isset($_POST['submit'])){ ?>
<script>
    const units=document.querySelector('.units');
    var strJSON=<?=makeNice($units)?>;
    //var obj=JSON.parse(strJSON);
    var obj=strJSON;
    console.log(obj);
    for(var i=0; i<obj.length; i++){
        var unit=document.createElement('div');
        unit.classList.add('unit');
        var unitName=document.createElement('div');
        unitName.classList.add('unit-name');
        unitName.innerHTML=obj[i].Unit;
        var unitCost=document.createElement('div');
        unitCost.classList.add('unit-cost');
        unitCost.innerHTML=obj[i].Cost;
        unit.appendChild(unitName);
        unit.appendChild(unitCost);
        units.appendChild(unit);
    }

</script>
<?php } ?>

