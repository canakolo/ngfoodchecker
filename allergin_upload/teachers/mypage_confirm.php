<?php
    require('../function.php');
    debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
    debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「献立登録確認ページ');
    debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');

    $postFoodName = array(
      '0' => '',
      '1' => '卵',
      '2' => '小麦',
      '3' => '乳',
      '4' => 'えび',
      '5' => 'いか',
      '6' => 'さけ',
      '7' => 'さば',
      '8' => '大豆',
      '9' => 'ごま',
      '10' => '鶏肉',
      '11' => '豚肉',
      '12' => '牛肉',
      '13' => 'りんご',
      '14' => 'その他',
    );

    if(!empty($_POST['register'])){
        debug('登録ボタンが押されました。');
        if(!empty($_POST)){
            $surve_date1 = $_POST['surve_date1'];
            $menu1 = $_POST['menu1'];
            $menu1_allergin1 = $_POST['menu1_allergin1'];
            $menu1_allergin2 = $_POST['menu1_allergin2'];
            $menu1_allergin3 = $_POST['menu1_allergin3'];
            $menu1_allergin4 = $_POST['menu1_allergin4'];
            $menu1_allergin5 = $_POST['menu1_allergin5'];

            if(empty($err_msg)){
             debug('バリデーションOKです');
             try{
                $dbh = dbConnect();
                $sql = 'INSERT into menu1 (surve_date1, menu1, menu1_allergin1, menu1_allergin2, menu1_allergin3, menu1_allergin4, menu1_allergin5) VALUES (:surve_date1, :menu1, :menu1_allergin1, :menu1_allergin2, :menu1_allergin3, :menu1_allergin4, :menu1_allergin5)';
                $data = array(':surve_date1' => $surve_date1, ':menu1' => $menu1, ':menu1_allergin1' => $menu1_allergin1, ':menu1_allergin2' => $menu1_allergin2, ':menu1_allergin3' => $menu1_allergin3, ':menu1_allergin4' => $menu1_allergin4, ':menu1_allergin5' => $menu1_allergin5);
                $stmt = queryPost($dbh, $sql, $data);
                debug('dbにコネクトしたよ');

                if($stmt){
                  debug('DBに登録できました');
                  debug('登録完了画面へ遷移します');
                  header("location: mypage_complete.php");
                }else{
                  debug('DBに登録できませんでした');
                }
            }catch (Exception $e){
                error_log('エラー発生：'.$e->getMessage());
                $err_msg['common'] = MSG07;
                }
            }else{
              debug("エラーがあります");
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset= utf-8>
        <title>献立登録確認</title>
        <link rel="stylesheet" type="text/css" href="../style.css">
        <link 'http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    </head>

    <body>
        <?php require('header.php'); ?>
        <section id="main">
            <div id="contents" class="site-width normal-background">
                <label class="">
                    入力した内容を確認し、登録してください。
                </label>
                <table class="menu1">
                    <tr>
                      <td><?php echo $_POST['surve_date1']; ?></td>
                    </tr>
                    <tr>
                        <td>献立１の名前：</td>
                        <td><?php echo $_POST['menu1']; ?></td>
                    </tr>
                    <tr>
                        <td>アレルギー成分１：</td>
                        <td><?php echo $postFoodName[$_POST['menu1_allergin1']]; ?></td>
                    </tr>
                    <tr>
                        <td>アレルギー成分２：</td>
                        <td><?php echo $postFoodName[$_POST['menu1_allergin2']]; ?></td>
                    </tr>
                    <tr>
                        <td>アレルギー成分３：</td>
                        <td><?php echo $postFoodName[$_POST['menu1_allergin3']]; ?></td>
                    </tr>
                    <tr>
                        <td>アレルギー成分４：</td>
                        <td><?php echo $postFoodName[$_POST['menu1_allergin4']]; ?></td>
                    </tr>
                    <tr>
                        <td>アレルギー成分５：</td>
                        <td><?php echo $postFoodName[$_POST['menu1_allergin5']]; ?></td>
                    </tr>
                </table>
                <div class="btn-container">
                    <input type="submit" name="register" class="btn btn-mid" value="登録する">
                </div>
                <div class="btn-container">
                    <input type="button" onclick="history.back()" value="戻る">
                </div>
            </div>
        </section>
    </body>
</html>
