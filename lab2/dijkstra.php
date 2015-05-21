 
<?php
function dijkstra($graph_array, $source, $target, $type) {
    $vertices = array();
    $neighbours = array();
    foreach ($graph_array as $edge) {
        array_push($vertices, $edge[0], $edge[1]);
        $neighbours[$edge[0]][] = array("end" => $edge[1], "cost" => $edge[$type]);
        $neighbours[$edge[1]][] = array("end" => $edge[0], "cost" => $edge[$type]);
    }
    $vertices = array_unique($vertices);
 
    foreach ($vertices as $vertex) {
        $dist[$vertex] = INF;
        $previous[$vertex] = NULL;
    }
 
    $dist[$source] = 0;
    $Q = $vertices;
    while (count($Q) > 0) {
 
        $min = INF;
        foreach ($Q as $vertex){
            if ($dist[$vertex] < $min) {
                $min = $dist[$vertex];
                $u = $vertex;
            }
        }
 
        $Q = array_diff($Q, array($u));
        if ($dist[$u] == INF or $u == $target) {
            break;
        }
 
        if (isset($neighbours[$u])) {
            foreach ($neighbours[$u] as $arr) {
                $alt = $dist[$u] + $arr["cost"];
                if ($alt < $dist[$arr["end"]]) {
                    $dist[$arr["end"]] = $alt;
                    $previous[$arr["end"]] = $u;
                }
            }
        }
    }
    $path = array();
    $u = $target;
    while (isset($previous[$u])) {
        array_unshift($path, $u);
        $u = $previous[$u];
    }
    array_unshift($path, $u);
    return $path;
}
  
function sum($graph_array, $path, $type) {
    $sum = 0;
    for ($i = 1; $i < count($path); $i++) {
        foreach ($graph_array as $link) {
            if (in_array($path[$i-1], $link) && in_array($path[$i], $link)) {
                $sum += $link[$type];
                break;
            }
        }
    }
    return $sum;
} 
 
 
 
   
$file = fopen("schedule.txt", "r") or die("Unable to open file!");
$graph_array = array();
$cities = array();
while (!feof($file)) {
    $link = explode(" ", fgets($file));
    
    if (count($link) < 4)
        continue;
    
    if (!in_array($link[0], $cities))
        array_push($cities, $link[0]);
    if (!in_array($link[1], $cities))
        array_push($cities, $link[1]);
        
    array_push($graph_array, array($link[0], $link[1], $link[2], $link[3]));
}

fclose($file);
?>
