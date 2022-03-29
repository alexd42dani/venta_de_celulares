<?php

class connection
{

    function OpenCon()
    {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $db = "sistema_celular";
        $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);

        return $conn;
    }

    function get_data($sql)
    {
        $connection = new connection();
        $conn = $connection->OpenCon();

        $result = $conn->query($sql);
        $emparray = array();
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                //echo "id: " . $row["id_user"] . "<br>";
                $emparray[] = $row;
                //var_dump($emparray);
                // return $result->fetch_assoc();
            }
        } else {
            //echo "0 results";
            return null;
        }

        $conn->close();
        return $emparray;
    }

    function insert_data($sql)
    {
        $connection = new connection();
        $conn = $connection->OpenCon();

        if ($conn->query($sql) === TRUE) {
            $conn->close();
            return "New record created successfully";
        } else {
            $conn->close();
            return "Error: " . $sql . "<br>" . $conn->error;
        }

    }

    function insert_data1($sql, $array)
    {
        $connection = new connection();
        $conn = $connection->OpenCon();

        $s = str_pad("s",  count($array), "s");    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($s, ...$array);
        $stmt->execute();
        $conn->close();
        return "New record created successfully";
    }

    function insert_data2($sql)
    {
        $connection = new connection();
        $conn = $connection->OpenCon();

        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            $conn->close();
            return $last_id;
        } else {
            $conn->close();
            return "Error: " . $sql . "<br>" . $conn->error;
        }

    }

    function CloseCon($conn)
    {
        $conn->close();
    }
}
