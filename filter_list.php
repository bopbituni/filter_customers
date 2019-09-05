<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    input[type="text"] {
        width: 200px;
        padding: 12px 10px 12px 10px;
        border-radius: 20px;
        font-size: 16px;
    }

    #submit {
        padding: 12px 32px;
        border-radius: 15px;
        font-size: 16px;
        margin: auto;
    }
    table{
        border: 1px solid black;
        border-radius: 10px;

    }
    th, td{
        border: 1px solid black;
        border-radius: 10px;
        padding: 8px;
        text-align: left;
    }
    .profile {
        height: 60px;
        width: 80px;
        overflow: hidden;
    }
    .profile img {
        width: 100%
    }
</style>
<body>
<form method="post">
    From: <input type="text" name="from" placeholder="yyyy/mm/dd">
    To: <input type="text" name="to" placeholder="yyyy/mm/dd">
    <input type="submit" id="submit" value="Change">
</form>
<?php
$customer_list = array(
    "0" => array("name" => "Mai Văn Hoàn", "day_of_birth" => "1983/08/20", "address" => "Hà Nội", "image" => "image/ducnguyen.jpeg"),
    "1" => array("name" => "Nguyễn Văn Nam", "day_of_birth" => "1983/08/21", "address" => "Bắc Giang", "image" => "image/huongtran.jpeg"),
    "2" => array("name" => "Nguyễn Thái Hòa", "day_of_birth" => "1983/08/22", "address" => "Nam Định", "image" => "image/longnguyen.jpeg"),
    "3" => array("name" => "Trần Đăng Khoa", "day_of_birth" => "1983/08/17", "address" => "Hà Tây", "image" => "image/thanhdo.jpeg"),
    "4" => array("name" => "Nguyễn Đình Thi", "day_of_birth" => "1983/08/19", "address" => "Hà Nội", "image" => "image/img5.jpg")
);
function searchByDate($customers, $from_date, $to_date)
{
    if (empty($from_date) && empty($to_date)) {
        return $customers;
    }
    $filtered_customers = [];
    foreach ($customers as $customer) {
        if (!empty($from_date) && (strtotime($customer["day_of_birth"]) < strtotime($from_date))) {
            continue;
        }
        if (!empty($to_date) && (strtotime($customer["day_of_birth"]) > strtotime($to_date))) {
            continue;
        }
        $filtered_customers[] = $customer;

    }
    return $filtered_customers;
}

$from_date = null;
$to_date = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $from_date = $_POST["from"];
    $to_date = $_POST["to"];
}
$filtered_customers = searchByDate($customer_list, $from_date, $to_date);
?>
<table>
    <caption><h2>Danh sách khách hàng</h2></caption>
    <tr>
        <th>STT</th>
        <th>Tên</th>
        <th>Ngày sinh</th>
        <th>Địa chỉ</th>
        <th>Ảnh</th>
    </tr>
        <?php if (count($filtered_customers) === 0): ?>
    <tr>
        <td colspan="5" class="message">Không tìm thấy khách hàng nào!</td>
    </tr>
    <?php endif; ?>

    <?php foreach($filtered_customers as $index => $customer):  ?>
    <tr>
        <td><?php echo $index + 1; ?></td>
        <td><?php echo $customer["name"]; ?></td>
        <td><?php echo $customer["day_of_birth"]; ?></td>
        <td><?php echo $customer["address"]; ?></td>
        <td><div class="profile"><img src="<?php echo $customer["profile"]; ?>"></div></td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
