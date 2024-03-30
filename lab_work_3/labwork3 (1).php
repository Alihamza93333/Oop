<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collatz Sequence Statistics</title>
    <style>
        .histogram {
            display: flex;
            flex-direction:column;
            justify-content: space-between;
            padding: 10px;
            margin-bottom: 5px;
        }
        .bar {
            background-color: #007bff;
            height: 20px;
            border-radius: 3px;
            margin-right: 5px;
        }
        .my_form{
            display:grid;
            grid-template-columns:repeat(5,1fr);
        }
    </style>
</head>
<body>
    <h2>Collatz Sequence Statistics</h2>
    <form method="post" action="">
        <label for="start">Start Number:</label>
        <input type="number" id="start" name="start" required>
        <br>
        <label for="end">End Number:</label>
        <input type="number" id="end" name="end" required>
        <br>
        <input type="submit" value="Calculate">
    </form>

    <?php
    // PHP code starts here
    class myCollatzProgram {
        public function collatz($a) {
            $seq = array($a); // Start the sequence with the initial value of $a

            while ($a != 1) {
                if ($a % 2 == 0) {
                    $a = $a / 2;
                } else {
                    $a = 3 * $a + 1;
                }
                $seq[] = $a; // Add the new value of $a to the sequence
            }

            return $seq;
        }

        public function collatzSequenceInRange($start, $end) {
            $sequences = array();

            for ($i = $start; $i <= $end; $i++) {
                $seq = $this->collatz($i);
                $sequences[] = array(
                    'number' => $i,
                    'sequence' => $seq
                );
            }

            return $sequences;
        }
    }

    class CollatzStatistics extends myCollatzProgram {
        public function calculateHistogram($start, $end) {
            $histogram = array();
            $sequences = $this->collatzSequenceInRange($start, $end);

            foreach ($sequences as $sequenceData) {
                $sequence = $sequenceData['sequence'];
                foreach ($sequence as $iteration => $value) {
                    if (isset($histogram[$iteration])) {
                        $histogram[$iteration][] = $value;
                    } else {
                        $histogram[$iteration] = array($value);
                    }
                }
            }

            return $histogram;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
             // Create an instance of the CollatzStatistics class
        $collatzStats = new CollatzStatistics();

        // Get start and end numbers from the form
        $start = $_POST['start'];
        $end = $_POST['end'];

        // Calculate histogram
        $histogram = $collatzStats->calculateHistogram($start, $end);

        // Display histogram
        echo "<h3>Collatz Histogram</h3>";
        echo "<div class='my_form'>";
        foreach ($histogram as $iteration => $sequence) {
            echo "<div class='histogram'>";
            echo "<span>Iteration $iteration:</span>";
            $barWidth = count($sequence) * 10; // Adjust the width of the bar
            echo "<div class='bar' style='width: {$barWidth}px;'></div>";
            echo "</div>";
        }
        echo"</div>";
    }
    ?>
</body>
</html>