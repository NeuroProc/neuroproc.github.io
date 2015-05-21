<?php
    include("dijkstra.php")
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Ж/Д ВИДЖЕТ</title>
    </head>
    <body>
        <form style="text-align: center; " method="POST" action="index.php">
            отправка&nbsp;
            <select style="margin: 5px; font: 20px courier, sans-serif;" name="source">
                <?php
                    foreach ($cities as $city)
                        echo "<option>" . $city . "</option>";
                ?>
            </select>
            <br>
            прибытие
            <select style="margin: 5px; font: 20px courier, sans-serif;" name="target">
                <?php
                    foreach ($cities as $city)
                        echo "<option>" . $city . "</option>";
                ?>
            </select>
            <br>
            <input style="background: #ff0000; font-size: 50px; margin: 10px; width: 500px; height: 100px;" name="calc" type="submit" value="считать" />
        </form>
        <hr>
        <?php
            if (isset($_POST['calc'])) {
                $path = dijkstra($graph_array, $_POST['source'], $_POST['target'], 2);
                echo "<p style=\"text-align:center; font: 50px courier, sans-serif;\">быстрее<br>" . implode(" → ", $path) . "</p>";
                echo "<p style=\"margin-top: 0px; text-align:center;\">расстояние: " . sum($graph_array, $path, 2) . " стоимость: " . sum($graph_array, $path, 3). "</p>";
                
                $path = dijkstra($graph_array, $_POST['source'], $_POST['target'], 3);
                echo "<p style=\"text-align:center; font: 50px courier, sans-serif;\">дешевле<br>" . implode(" → ", $path) . "</p>";    
                echo "<p style=\"text-align:center;\">расстояние: " . sum($graph_array, $path, 2) . " стоимость: " . sum($graph_array, $path, 3) . "</p>";       
            }
        ?>
    </body>
</html>


