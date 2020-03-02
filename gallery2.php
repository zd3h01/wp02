<?php

const IMG_PATH = "uploads/";

function imgId ()
{
    $fp = fopen("id.dat","r");
    $id = fgets($fp);
    fclose($fp);
    $id++;
    $fp = fopen("id.dat","w");
    fputs($fp,$id);
    fclose($fp);
    $id = sprintf("%03d",$id);
    return $id;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ($_FILES["userfile"]["error"] === UPLOAD_ERR_OK) {

        $name = mb_convert_encoding($_FILES["userfile"]["name"],"cp932","utf8");
        $tmpfile = $_FILES["userfile"]["tmp_name"];
        $result = move_uploaded_file($tmpfile, IMG_PATH . imgId()."_".$name);

        if ($result == false) {
            $errorMessage = "アップロードされたファイルはありません。";
        }

    } elseif ($_FILES["userfile"]["error"] === UPLOAD_ERR_NO_FILE) {
    } else {
        $errorMessage = "アップロードに失敗しました。";
    }

    $size = $_POST["size"];
    $num  = $_POST["num"];
} else {
    $size = 200;
    $num  = 5;
}

$files = glob("uploads/*.jpg");
$replace = ["uploads/", ".jpg"];
?>
<!doctype html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>画像ギャラリー</title>
	<style>
        table {
         border: 1px solid #666666;
         border-collapse: collapse;
         width: 600px;
        }
        th {
         border: 1px solid #aaa;
         background-color: #dddddd;
         padding: 4px;
        }
        td {
         border: 1px solid #eee;
         padding: 10px;
         text-align: center;
        }
        .error {
         color: #ff0000;
        }
        span {
         font-size: 12px;
        }
        img {
         padding: 3px;
         border: 1px solid #aaa;
         box-shadow: 0 0 5px #bbb;
         display: block;
        }
    </style>
</head>
<body>
	<h1>画像ギャラリー</h1>

	<form action="" method="post" enctype="multipart/form-data">
    	<p>ファイル：<input type="file" name="userfile"></p>
    	<p>サイズ：
    		<select name="size">
    			<?php for($s = 100; $s <= 200; $s+=50): ?>
    				<option <?= $size == $s ? "selected" : "" ?>>
    					<?= htmlspecialchars($s, ENT_QUOTES); ?>
    				</option>
    			<?php endfor; ?>
    		</select>
    	</p>
    	<p>横並び：
    		<?php for ($n = 3; $n <= 6; $n++ ): ?>
    		<input type="radio" name="num"
    		value="<?= htmlspecialchars($n, ENT_QUOTES); ?>"
    		<?= $num == $n ? "checked" : "" ?>>
    			<?= htmlspecialchars($n, ENT_QUOTES); ?>
    		<?php endfor; ?>
    	</p>
        <p><input type="submit" value="送信"></p>
    </form>

    <?php if (isset($errorMessage)): ?>
		<p class="error"><?= htmlspecialchars($errorMessage, ENT_QUOTES); ?></p>
	<?php endif; ?>

	<?php if (0 < count($files)): ?>
    	<table>
    		<tr>
    			<th colspan="<?= htmlspecialchars($num, ENT_QUOTES); ?>">画像一覧</th>
    		</tr>
    		<tr>
    		<?php for($i = 0; $i < count($files);$i++): ?>

    			<?php $file = mb_convert_encoding($files[$i], "utf8", "cp932"); ?>
    			<?php $file = str_replace($replace, "", $file); ?>

    			<?php if ($i % $num == $num - 1): ?>
	    			<td><img src="<?= IMG_PATH . htmlspecialchars($file, ENT_QUOTES); ?>.jpg" width="<?= htmlspecialchars($size, ENT_QUOTES); ?>">
	    				<span><?= htmlspecialchars($file, ENT_QUOTES); ?></span>
	    			</td></tr><tr>
	    		<?php else: ?>
	    			<td><img src="<?= IMG_PATH . htmlspecialchars($file, ENT_QUOTES); ?>.jpg" width="<?= htmlspecialchars($size, ENT_QUOTES); ?>">
	    			<span><?= htmlspecialchars($file, ENT_QUOTES); ?></span></td>
	    		<?php endif; ?>

    		<?php endfor; ?>
    		</tr>
    	</table>
    <?php else: ?>
        <table>
        	<tr>
        		<th>画像一覧</th>
        	</tr>
        	<tr>
        		<td>アップロードされたファイルはありません。</td>
        	</tr>
        </table>
    <?php endif; ?>
</body>
</html>