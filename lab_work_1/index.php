<?php
include("./functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collatz Conjecture Calculator</title>
</head>
<body>
<h2>Collatz Conjecture Calculator</h2>
<form action="./" method="GET">
	Enter a number to start the sequence: <input type="number" name="start_number" required />
	<input type="submit" name="calculate" value="Calculate" />
</form>

<?php
	if(isset($_GET["calculate"])){
		$a = abs($_GET["start_number"]);
		
		$myArr = collatz($a);
		$iteration = count($myArr) - 1;
		$maxArrNum = max($myArr);
		
		echo "<p>The Iteration is $iteration and The Maximum Number is ".$maxArrNum."</p>";
		echo "<p>The Collatze Sequence for ".$a." is: ";
		foreach($myArr as $ar){
			echo $ar.", ";
		}
		echo "</p>";
	}
?>

<br><br>

<h2>Collatz Conjecture Calculator</h2>
<form action="./" method="GET">
	Enter a start number: <input type="number" name="num_1" required />
	Enter an end number: <input type="number" name="num_2" required />
	<input type="submit" name="calc_range" value="Calculate" />
</form>

<?php
	if(isset($_GET["calc_range"])){
		$num_1 = abs($_GET["num_1"]);
		$num_2 = abs($_GET["num_2"]);
		
		if($num_2 > $num_1){
			$mySeqRangeArr = collatzSequenceInRange($num_1, $num_2);
			
			$maxVal = 0;
			foreach($mySeqRangeArr as $ar1){
				$mxVal = $ar1["iteration"];
				if($mxVal > $maxVal){$maxVal = $mxVal;} //here we get the maximum iteration
				echo "<p>Number: ".$ar1["number"]." | Max. Number: ".$ar1["highest_number"]." | Iteration: ".$ar1["iteration"]."</p>";
			}
			
			$minVal = $maxVal;
			echo "<br><p>Maximun Iteration:</p>";
			foreach($mySeqRangeArr as $ar1){
				$mxVal = $ar1["iteration"];
				if($mxVal < $minVal){$minVal = $mxVal;} //here we get the minimum iteration
				if($mxVal == $maxVal){
					echo "<p>Number: ".$ar1["number"]." | Max. Number: ".$ar1["highest_number"]." | Iteration: ".$ar1["iteration"]."</p>";
				}
			}
			
			echo "<br><p>Minimum Iteration:</p>";
			foreach($mySeqRangeArr as $ar1){
				$mxVal = $ar1["iteration"];
				if($mxVal == $minVal){
					echo "<p>Number: ".$ar1["number"]." | Max. Number: ".$ar1["highest_number"]." | Iteration: ".$ar1["iteration"]."</p>";
				}
			}
		}else{
			echo "Please enter the correct number!";
		}
	}
?>
</body>
</html>