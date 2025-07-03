<?php
header('Content-Type: application/json');
require_once 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strtoupper(trim($_POST["name"]));
    $room = strtoupper(trim($_POST["room"]));
    $floor = strtoupper(trim($_POST["floor"]));
    $first_name = explode(' ', $name)[0];

    $conn = getDBConnection();
    if (!$conn) {
        echo json_encode(["status" => "error", "message" => "DB connection failed."]);
        exit;
    }

    $year = date("Y");
    $month = date("m");
    $day = date("d");

    $stmt = $conn->prepare("INSERT INTO visitor_logs (name, room, floor, visit_year, visit_month, visit_day) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiii", $name, $room, $floor, $year, $month, $day);
    $stmt->execute();
    $visitor_id = $stmt->insert_id;
    $stmt->close();
    $conn->close();

    $guestCode = "G" . date("Ymd") . "-" . str_pad($visitor_id, 5, "0", STR_PAD_LEFT);

    function maskName($n) {
        if (strlen($n) <= 3) return $n;
        $first = substr($n, 0, 2);
        $last = substr($n, -1);
        return $first . str_repeat('*', strlen($n) - 3) . $last;
    }

    $masked_name = maskName($first_name);
    $room_floor = "($room-{$floor}F)";
    $qrData = "$name|$room_floor|$guestCode";

    $zpl = "^XA
^MMT
^PW609
^LL203
^LS0
^FO36,8^GFA,693,2220,12,:Z64:eJztlMGK2zAURZ/tEQQbNJt43+Uw0w8oHige6Ae4YP2P6KqfYWZVvJltiMvQT8nShMHeZiX6ZFvSTRtDsyh0UQXC5eT65unpyUT/1z+73gUZ1UG/DI3XSlVOJl2393al/APSGKMXnSulHH/suq4BXi56HMbh4OMD74I/stz9Mceb0+88sf7dBc7xYw+8XvEvPP41f83v6rH191C/41D/2b5eOd/tF/vwwH69aAF9S8dhcBr7TCHeBnlJ6VETrBvQG9Bb0Hcr/APoCvQpSJyUbBd0jhPUBw0bSLrgzz0/tr7/BP0n6P8Zt/1/u8IP5/tH52XnRwOn4PfzD/E2vwdegb8B7nfOx6sDx+P18XjtCOIpVGn9GriXFKbnrPkEzSeIJz+clod4gvgz/7iWv7/MjbnOz/Xf9oGLOvj9vDHPw/mSPF3wP4Kfzbnbwu1A0uUL8Gfg5yEXzh9DPoGfCpj/m5DPly79Rn9rrd3oIm3be4rbxnKhqpzfHSXrO2n6Vx3Phyw+8QmL2nJKuUNN0kwP50Sfy2jCJDUdD+mPSQvLxcwzoufFvxUUPVXRNHPfpfly6GNjH6iFispKTP9bZPuk2SWtXvxlNee/l1oOfTbl14JffPWcX2SUtXufL/irnPO11B/jo/2hzrnSrcvn/hfJdMW2TCmf97vZkP181de39idmrQHS:8870
^FT128,182^A0N,23,18^FH\^CI28^FDNOTE: Please return this sticker badge upon checkout.^FS^CI27
^FT134,74^A0N,28,25^FH\\^CI28^FD$masked_name^FS^CI27
^FT235,73^A0N,28,35^FH\\^CI28^FD$room_floor^FS^CI27
^FT129,130^A0N,28,38^FH\\^CI28^FD$guestCode^FS^CI27
^FT446,149^BQN,1,3
^FH\\^FDLA,$qrData^FS
^PQ1,0,1,Y
^XZ";

    $printerIp = "10.183.142.16";
    $fp = fsockopen($printerIp, 9100, $errno, $errstr, 10);
    if (!$fp) {
        echo json_encode(["status" => "error", "message" => "Printer connection failed."]);
        exit;
    }

    fwrite($fp, $zpl);
    fclose($fp);

    echo json_encode(["status" => "success", "message" => "Label printed successfully. Code: $guestCode"]);
}
?>
