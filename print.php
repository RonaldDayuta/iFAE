<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Collect form data
    $name = strtoupper(trim($_POST["name"]));
    $room = strtoupper(trim($_POST["room"]));
    $floor = strtoupper(trim($_POST["floor"]));
    $first_name = explode(' ', $name)[0]; // Get only the first name

    // 2. Connect to database
    $conn = new mysqli("localhost", "root", "", "visitor");
    if ($conn->connect_error) {
        die("❌ DB connection failed: " . $conn->connect_error);
    }

    // 3. Get current date
    $year = date("Y");
    $month = date("m");
    $day = date("d");

    // 4. Insert into DB
    $stmt = $conn->prepare("INSERT INTO visitor_logs (name, room, floor, visit_year, visit_month, visit_day) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiii", $name, $room, $floor, $year, $month, $day);
    $stmt->execute();
    $visitor_id = $stmt->insert_id;
    $stmt->close();
    $conn->close();

    // 5. Generate guest code
    $guestCode = "G" . date("Ymd") . "-" . str_pad($visitor_id, 5, "0", STR_PAD_LEFT);

    // 6. Mask the first name
    function maskName($n) {
        if (strlen($n) <= 3) return $n;
        $first = substr($n, 0, 2);
        $last = substr($n, -1);
        return $first . str_repeat('*', strlen($n) - 3) . $last;
    }
    $masked_name = maskName($first_name);

    // 7. Format room-floor
    $room_floor = "($room-{$floor}F)";

    // 8. Prepare QR content (raw first name for QR)
    $qrData = "$name|$room_floor|$guestCode";

    // 9. Final ZPL with layout
    $zpl = "^XA
^MMT
^PW812
^LL406
^LS0
^FO130,94^GFA,693,2220,12,:Z64:eJztlMGK2zAURZ/tEQQbNJt43+Uw0w8oHige6Ae4YP2P6KqfYWZVvJltiMvQT8nShMHeZiX6ZFvSTRtDsyh0UQXC5eT65unpyUT/1z+73gUZ1UG/DI3XSlVOJl2393al/APSGKMXnSulHH/suq4BXi56HMbh4OMD74I/stz9Mceb0+88sf7dBc7xYw+8XvEvPP41f83v6rH191C/41D/2b5eOd/tF/vwwH69aAF9S8dhcBr7TCHeBnlJ6VETrBvQG9Bb0Hcr/APoCvQpSJyUbBd0jhPUBw0bSLrgzz0/tr7/BP0n6P8Zt/1/u8IP5/tH52XnRwOn4PfzD/E2vwdegb8B7nfOx6sDx+P18XjtCOIpVGn9GriXFKbnrPkEzSeIJz+clod4gvgz/7iWv7/MjbnOz/Xf9oGLOvj9vDHPw/mSPF3wP4Kfzbnbwu1A0uUL8Gfg5yEXzh9DPoGfCpj/m5DPly79Rn9rrd3oIm3be4rbxnKhqpzfHSXrO2n6Vx3Phyw+8QmL2nJKuUNN0kwP50Sfy2jCJDUdD+mPSQvLxcwzoufFvxUUPVXRNHPfpfly6GNjH6iFispKTP9bZPuk2SWtXvxlNee/l1oOfTbl14JffPWcX2SUtXufL/irnPO11B/jo/2hzrnSrcvn/hfJdMW2TCmf97vZkP181de39idmrQHS:8870
^FT222,268^A0N,23,18^FH\\^CI28^FDNOTE: Please return this sticker badge upon checkout.^FS^CI27
^FT208,160^A0N,28,25^FH\\^CI28^FD$masked_name^FS^CI18
^FT319,159^A0N,28,35^FH\\^CI28^FD$room_floor^FS^CI18
^FT202,216^A0N,28,38^FH\\^CI28^FD$guestCode^FS^CI18
^FO123,86^GB507,204,4^FS
^FT520,230^BQN,1,3
^FH\\^FDLA,$qrData^FS
^PQ1,0,1,Y
^XZ";

    // 10. Send ZPL to printer
    $printerIp = "192.168.0.41"; // Replace with your printer's IP
    $fp = fsockopen($printerIp, 9100, $errno, $errstr, 10);
    if (!$fp) {
        echo "❌ Printer connection failed: $errstr ($errno)";
    } else {
        fwrite($fp, $zpl);
        fclose($fp);
        echo "✅ Label printed and saved!";
    }
}
?>
