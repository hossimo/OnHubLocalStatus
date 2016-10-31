<!doctype html>
<?php
    $serverStatusUrl = "http://192.168.86.1/api/v1/status"; //OnHub address
    // $serverStatusUrl = "status.json";                    //testing without OnHub
?>
<html>
<head>
    <!-- load css resources -->
    <link rel="stylesheet" type="text/css" href="main.css">

    <!-- load material design light resources -->
    <link rel="stylesheet" type="text/css" href="./mdl/material.min.css">
    <script src="./mdl/material.min.js"></script>

    <!-- load fonts if we can -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <?php
    $json = file_get_contents($serverStatusUrl);
    $onHubStatus = json_decode($json);

    $softwave = $onHubStatus->software;
    $system = $onHubStatus->system;
    $wan = $onHubStatus->wan;

    $version = $onHubStatus->software->softwareVersion;
    $wanLink = $onHubStatus->wan->etherLink;
    $wanOnline = $onHubStatus->wan->online;
    $systemUptime = $onHubStatus->system->uptime;
    function format($test, $true, $ifTrue, $ifFalse) {
        $retVal = ($test == $true) ? '[<span class="green">' . $ifTrue .'</span>]' : '[<span class="red">' . $ifTrue .'</span>]' ;
        return $retVal;
    }

    function ss2dhm ($s){
        $days = floor($s / (60*60*24));
        $hours = floor(($s - ($days*60*60*24)) / (60*60));
        $mins = floor(($s - ($days*60*60*24) - ($hours*60*60)) / 60);
        $secs = ($s -($days*60*60*24) - ($hours*60*60) - ($mins*60));
        return $days . " days " .$hours. " hours " .$mins. " minutes ".$secs. " seconds ";
    }
    ?>
    <meta charset="UTF-8">
    <?php $titleStat = ($wanOnline == "1") ? 'Online' : 'Offline' ;?>
    <title>onHub Status - <?php echo $titleStat ?></title>
</head>

<body>

    <!-- Display Cards -->
    <?php foreach ($onHubStatus as $oKey => $oValue) { ?>
        <div class="mdl-card card-wide mdl-shadow--16dp">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text"><?php echo $oKey ?></h2>
            </div>
            <div class="mdl-card__supporting-text">
                <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                    <tbody>
                        <?php
                        foreach ($oValue as $key => $value) {
                            switch ($key){
                                case "uptime":
                                $v = ss2dhm($value);
                                break;
                                case "ethernetLink":
                                $v = format($value, "1", "Up", "Down");
                                break;
                                case "online":
                                $v = format($value, "1", "Online", "Offline");
                                break;
                                case "ipAddress":
                                $v = format($value, "1", "Set", "Not Set");
                                break;
                                default:
                                $v = $value;
                            }

                            echo '<tr>';
                            echo '<td class="mdl-data-table__cell--non-numeric">'. $key .'</td>';
                            if(!is_array($v)){
                            	echo '<td >'. $v .'</td>';
                            }else{
                            	echo '<td >'. implode(',', $v) .'</td>';
                            }
                            echo '</tr>';
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php } ?>
    </body>
    </html>
