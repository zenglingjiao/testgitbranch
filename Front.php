<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('vendor/kreait/firebasephp/src/Firebase/Factory.php');
use Kreait\Firebase\Factory;
/**
 * Class Store
 */
class Front extends Public_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code 請查看core/my_controller.php 配置
        $this->load->library("Uuid");
        $this->load->library("logs");
    }

    public function share($id = '')
    {
        $data['title'] = "物品分享";
        $goods = $this->Data_helper_model->get_model_in_id("goods", $id);
        // if ($activitie) {
        //     $data["preferential"] = $this->Data_helper_model->get_model_in_id("preferentials", $activitie->preferential_id);
        // }
        $data["goods"] = $goods;
        $this->load->view("Front/share", $data);
    }
    public function share_goods($id = '')
    {
        $data['title'] = "物品分享";
        $goods = $this->Data_helper_model->get_model_in_id("goods", $id);
        
        $data["goods"] = $goods;
        $this->load->view("Front/share_goods", $data);
    }
    public function test()
    {

    }

    public function test_img()
    {
        //echo rename('updata/image/2019-09/201909032149531.jpg','updata/image/2019-09/201909032149531111111111111111.jpg');
        //exit;


        //$img_info = getimagesize('updata/image/2019-09/201909032149531.jpg');
        // var_dump($img_info);
        // var_dump(filesize('updata/image/2019-09/201909032149531.jpg'));
        // exit;

        // $path_parts = pathinfo('updata/image/2019-09/201909032149531.jpg');
        //
        // $img = imagecreatefrompng('updata/image/2019-09/201909052152081.png');
        // var_dump(imagejpeg($img,"fsdf.jpg"));
        // exit;
        //echo compress_img('updata/image/2019-09/201909052152081.png', 1280);

        //exit;
        //echo file_exists('updata/image/2019-09/201909032149531.jpg');

        $path_parts = pathinfo('updata/image/2019-09/201909032149531.jpg');
        var_dump($path_parts);
        exit;

        $dir = 'updata/image/2019-09/201909032149531.jpg';
        $newDir = $path_parts['dirname'] . '/';
        //$this->load->library("Imgcompress", ["src" => $dir, "percent" => 0.2]);
        $this->load->library("Imgcompress", ["src" => $dir, "percent" => 1024 / $img_info[0]]);
        create_folders($newDir);
        $this->imgcompress->compressImg($newDir . $path_parts['filename'] . 'x1024');
        echo "完成";
    }

    //推播
    public function tui()
    {	
    	$this->load->library("PHPMailer");
    	$mail = $this->phpmailer;

		//設定使用SMTP發送
		$mail->IsSMTP();

		//指定SMTP的服務器位址
		$mail->Host = "msa.hinet.net";

		//設定SMTP服務的POST
		$mail->Port = 25;
    $mail->SMTPDebug = 4; //是否调试

		//設定為安全驗證方式
		$mail->SMTPAuth = false;   //我不知道這裡用 true or false 好
$mail->SMTPSecure = 'ssl';
		$mail->SetFrom('noreply@f5points.com.tw',"1111環保"); //发件人邮箱和名称

	    $mail->Subject = "驗證碼"; //标题


	    $mail->Body = '您的驗證碼為請勿將驗證碼透露給他人！（十分鐘有效，盡快完成驗證！）';

	    $mail->IsHTML(true); //是否启用html

	    $mail->AddAddress('1224312417@qq.com'); //收件用户

		if ($mail->Send()) {
		    echo '寄出';
		} else {
		    echo $mail->ErrorInfo;
		}
		exit();
    	$messaging = new Factory();
    	var_dump($messaging);exit();
//     	ini_set('display_errors',0);
// echo ini_get('display_errors');//0
    	// (new Factory())->withServiceAccount('firebase.json')->createMessaging();
     //    $message = CloudMessage::fromArray([
     //        'token' => '11',
     //        'notification' => ['title'=>'交車時間提醒','body'=>'車號預計交車時間為 ，請顧問確認車輛保養狀態。'],
     //        //'data' => ['scheme'=>$url], // optional
     //    ]);
     //    $messaging->send($message);
        exit();
    }
}
