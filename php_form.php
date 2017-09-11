<!DOCTYPE html>
<html>
<head lang="en">

    <meta charset="UTF-8">
    <title></title>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>
<body>

<!--/**-->
<!-- * Created by PhpStorm.-->
<!-- * User: xiaoyu-->
<!-- * Date: 2017/9/6-->
<!-- * Time: 22:32-->
<!-- */-->

<?php
// 定义变量并设置为空值
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            // 检查名字是否包含字母和空格
            if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            // 检查电邮地址语法是否有效
            if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
                $emailErr = "Invalid email format";
            }
        }

        if (empty($_POST["website"])) {
            $website = "";
        } else {
            $website = test_input($_POST["website"]);
            // 检查 URL 地址语言是否有效（此正则表达式同样允许 URL 中的下划线）
            if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%
    =~_|]/i",$website)) {
                $websiteErr = "Invalid URL";
            }
        }

        if (empty($_POST["comment"])) {
            $comment = "";
        } else {
            $comment = test_input($_POST["comment"]);
        }

        if (empty($_POST["gender"])) {
            $genderErr = "Gender is required";
        } else {
            $gender = test_input($_POST["gender"]);
        }
    }

}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>PHP 验证实例</h2>
<p><span class="error">* 必需的字段</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    姓名：<input type="text" name="name" value="<?php echo $name;?>">
    <span class="error">* <?php echo $nameErr;?></span>
    <br><br>
    电邮：<input type="text" name="email" value="<?php echo $email;?>">
    <span class="error">* <?php echo $emailErr;?></span>
    <br><br>
    网址：<input type="text" name="website" value="<?php echo $website;?>">
    <span class="error"><?php echo $websiteErr;?></span>
    <br><br>
    评论：<textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
    <br><br>
    性别：
    <input type="radio" name="gender"
        <?php if (isset($gender) && $gender=="female") echo "checked";?>
           value="female">女性
    <input type="radio" name="gender"
        <?php if (isset($gender) && $gender=="male") echo "checked";?>
           value="male">男性
    <span class="error">* <?php echo $genderErr;?></span>
    <br><br>
    <input type="submit" name="submit" value="提交">
</form>
<?php
echo "<h2>您的输入：</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>
</body>
</html>