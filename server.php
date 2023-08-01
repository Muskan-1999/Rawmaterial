<?php
// Connect to the database (replace these details with your actual database credentials)
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'rawproduct';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["action"]) && $_POST["action"] === "login") {
      $username = $_POST["username"];
      $password = $_POST["password"];
      echo json_encode(["username" => $username]);
    }
  }

  
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === "subtract_raw_material") {
            subtractRawMaterial($_POST['id'], $_POST['count']);
        } elseif ($_POST['action'] === "add_raw_material") {
            addRawMaterial($_POST['id'], $_POST['count']);
        } elseif ($_POST['action'] === "subtract_finished_product") {
            subtractFinishedProduct($_POST['id'], $_POST['count']);
        } elseif ($_POST['action'] === "add_finished_product") {
            addFinishedProduct($_POST['id'], $_POST['count']);
        }
    }
}

function subtractRawMaterial($id, $count) {
    global $conn;
    $sql = "UPDATE raw_material SET count = count - $count WHERE id = $id";
    $result = $conn->query($sql);
    if ($result === TRUE) {
        echo "Raw material count updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function addRawMaterial($id, $count) {
    global $conn;
    $sql = "UPDATE raw_material SET count = count + $count WHERE id = $id";
    $result = $conn->query($sql);
    if ($result === TRUE) {
        echo "Raw material count updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function subtractFinishedProduct($id, $count) {
    global $conn;
    $sql = "SELECT * FROM finished_product WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['count'] >= $count) {
            $sql = "UPDATE finished_product SET count = count - $count WHERE id = $id";
            $result = $conn->query($sql);
            if ($result === TRUE) {
                // Update the raw material count used by this finished product
                $sql = "UPDATE raw_material SET count = count + ($count * " . $row['raw_material_required'] . ") WHERE raw_material_name = '" . $row['raw_material_name'] . "'";
                $result = $conn->query($sql);
                if ($result === TRUE) {
                    echo "Finished product count updated successfully!";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Insufficient finished product count!";
        }
    } else {
        echo "Invalid finished product ID!";
    }
}

function addFinishedProduct($id, $count) {
    global $conn;
    $sql = "SELECT * FROM finished_product WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['raw_material_required'] > 0) {
            $sql = "SELECT * FROM raw_material WHERE raw_material_name = '" . $row['raw_material_name'] . "'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($row['count'] >= ($count * $row['raw_material_required'])) {
                    $sql = "UPDATE finished_product SET count = count + $count WHERE id = $id";
                    $result = $conn->query($sql);
                    if ($result === TRUE) {
                        // Update the raw material count used by this finished product
                        $sql = "UPDATE raw_material SET count = count - ($count * " . $row['raw_material_required'] . ") WHERE raw_material_name = '" . $row['raw_material_name'] . "'";
                        $result = $conn->query($sql);
                        if ($result === TRUE) {
                            echo "Finished product count updated successfully!";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    echo "Insufficient raw material count!";
                }
            } else {
                echo "Raw material not found!";
            }
        } else {
            $sql = "UPDATE finished_product SET count = count + $count WHERE id = $id";
            $result = $conn->query($sql);
            if ($result === TRUE) {
                echo "Finished product count updated successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        echo "Invalid finished product ID!";
    }
}

// Fetch all raw materials from the database
if ($_GET["action"] === "get_raw_materials") {
    $sql = "SELECT * FROM raw_material";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row as a JSON object
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        echo json_encode($rows);
    } else {
        echo "0 results";
    }
}

// Fetch all finished products from the database
if ($_GET["action"] === "get_finished_products") {
    $sql = "SELECT * FROM finished_product";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row as a JSON object
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        echo json_encode($rows);
    } else {
        echo "0 results";
    }
}

$conn->close();