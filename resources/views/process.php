<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image = $_FILES['image']['tmp_name'];
    $grams = $_POST['grams'];

    if (!file_exists($image)) {
        echo "Invalid file path. Please try again.";
        exit;
    }

    // Prepare data to send to Python script
    $data = array('image_path' => $image, 'grams' => $grams);
    $json_data = json_encode($data);

    // Run the Python script
    $command = 'python3 food_prediction.py';
    $process = proc_open($command, [
        0 => ["pipe", "r"], // stdin
        1 => ["pipe", "w"], // stdout
        2 => ["pipe", "w"], // stderr
    ], $pipes);

    if (is_resource($process)) {
        // Write input data to Python script
        fwrite($pipes[0], $json_data);
        fclose($pipes[0]);

        // Get output from Python script
        $output = stream_get_contents($pipes[1]);
        fclose($pipes[1]);

        // Get errors from Python script
        $errors = stream_get_contents($pipes[2]);
        fclose($pipes[2]);

        $return_value = proc_close($process);

        if ($return_value === 0) {
            $result = json_decode($output, true);
            if (isset($result['error'])) {
                echo "<p>Error: " . htmlspecialchars($result['error']) . "</p>";
            } else {
                echo "<p>Predicted Food: " . htmlspecialchars($result['predicted_food']) . "</p>";
                echo "<p>Calories: " . htmlspecialchars($result['calories']) . "</p>";
            }
        } else {
            echo "<p>Python script error: " . htmlspecialchars($errors) . "</p>";
        }
    } else {
        echo "<p>Failed to execute Python script.</p>";
    }
}
?>
