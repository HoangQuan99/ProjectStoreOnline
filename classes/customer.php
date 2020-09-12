<?php
	$filepath = realpath(dirname(__FILE__));  
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class customer
	{
		private $db;
		private $fm;
		public function __construct()
		{
			$this->db= new Database();
			$this->fm= new Format();
		}
		public function insert_customer($data)
		{
			$username= mysqli_real_escape_string($this->db->link, $data['username']);
			$address= mysqli_real_escape_string($this->db->link, $data['address']);
			$city= mysqli_real_escape_string($this->db->link, $data['city']);
			$country= mysqli_real_escape_string($this->db->link, $data['country']);
			$zipcode= mysqli_real_escape_string($this->db->link, $data['zipcode']);
			$phone= mysqli_real_escape_string($this->db->link, $data['phone']);
			$email= mysqli_real_escape_string($this->db->link, $data['email']);
			$password= mysqli_real_escape_string($this->db->link, $data['password']);

			// $password= mysqli_real_escape_string($this->db->link, md5($data['password']));
			$regex = "/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i"; 
			$pattern = '/^[a-z]{3,15}$/';
			$subject = '!#$@$@%#$%#%';



			// if($username == "" || $city == "" || $zipcode == "" || $email == "" || $address == "" || $country == "" || $phone == "" || $password == ""){
			// 	$alert = "<span class='error'>Giá trị không được để trống</span>";
			// 	return $alert;
			// }
			if($username=="")
			{
				$alert ="<span class='error'>Họ tên không được trống</span>";
				return $alert;
			}
			else if($address=="")
			{
				$alert ="<span class='error'>Địa chỉ không được trống</span>";
				return $alert;
			}
			else if($zipcode=="")
			{
				$alert ="<span class='error'>Zipcode không được trống</span>";
				return $alert;
			}
			else if($phone=="")
			{
				$alert ="<span class='error'>Số điện thoại không được trống</span>";
				return $alert;
			}
			else if($email=="")
			{
				$alert ="<span class='error'>Email không được trống</span>";
				return $alert;
			}
			else if($password=="")
			{
				$alert ="<span class='error'>Password không được trống</span>";
				return $alert;
			}

			else if (!preg_match($regex, $email)) {
				$alert = "<span class='error'>Email không đúng định dạng!!!</span>";
				 return $alert;
			}
			
			// else if (preg_match($subject, $password)) {
			// 	$alert = "<span class='error'>Password không được chứ kí tự đặc biệt!!!</span>";
			// 	 return $alert;
			// }
			else{
				$check_email = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
				$result_check = $this->db->select($check_email);
				if ($result_check) {
					$alert = "<span class='error'>Email này đã tồn tại </span>";
					return $alert;
				}else {
					$query = "INSERT INTO tbl_customer(username,city,zipcode,email,address,country,phone,password) VALUES('$username','$city','$zipcode','$email','$address','$country','$phone','$password') ";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='success'>Đăng ký thành công</span>";
						return $alert;
					}else {
						$alert = "<span class='error'>Đăng ký không thành công</span>";
						return $alert;
					}
				}
			}

			// if($username==""||$address==""||$city==""||$country==""||$zipcode==""||$phone==""||$email==""||$password=="")
			// {
			// 	$alert ="<span class='error'>Dữ liệu không được trống</span>";
			// 	return $alert;
			// }
			// else
			// {
			// 	$check_mail = "SELECT * FROM  tbl_customer where email='$email' LIMIT 1";
			// 	$result_check =$this->db->select($check_mail);
			// 	if($result_check)
			// 	{
			// 		$alert ="<span class='error'>Email này đã tồn tại</span>";
			// 	return $alert;
			// 	}
			// 	else
			// 	{
			// 		$query = "INSERT INTO tbl_customer(username,address,city,country,zipcode,phone,email,password)VALUES('$username','$address','$city','$country','$zipcode','$phone','$email','$password')";
			// 		$result = $this->db->insert($query);
			// 	if($result)
			// 	{
			// 		$alert ="<span class='success'>Đăng Ký Thành Công</span>";
			// 		return $alert;
			// 	}
			// 	else
			// 		{
			// 		$alert ="<span class='error'>Đăng Ký Không Thành Công</span>";
			// 		return $alert;
			// 		}
			// 	}
			// }
		}
		public function login_customer($data)
		{
			$email= mysqli_real_escape_string($this->db->link, $data['email']);
			$password= mysqli_real_escape_string($this->db->link, $data['password']);
			$regex = "/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i"; 
			if($email == '')
			{
				$alert = "<span class='error'>Tai Khoan Khong Duoc De Trong</span>";
				 return $alert;
			}
			if($password == '')
			{
				$alert = "<span class='error'>Mat Khau Khong Duoc De Trong</span>";
				 return $alert;
			}
			else if (!preg_match($regex, $email)) {
				$alert = "<span class='error'>Email khong dung dinh dang</span>";
				 return $alert;
			}
			else
			{
				$check_mail = "SELECT * FROM  tbl_customer where email='$email' AND password='$password'";
				$result_check =$this->db->select($check_mail);
				if($result_check)
				{
					$value= $result_check->fetch_assoc();
					Session::set('customer_login',true);
					Session::set('customer_id',$value['id']);
					Session::set('customer_name',$value['username']);
					header('Location:index.php');
				}
				else
				{
					$alert = "<span class='error'>Tai Khoan Hoac Mat Khau Khong Trung Khop</span>";
					return $alert;
				}
			}
		}
		public function show_customer($id)
		{	
			$query = "SELECT * FROM  tbl_customer where id='$id'";
			$result =$this->db->select($query);
			return $result;

		}
		public function update_customer($data,$id)
		{

			$regex = "/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i"; 
			$username= mysqli_real_escape_string($this->db->link, $data['username']);
			$address= mysqli_real_escape_string($this->db->link, $data['address']);
			$zipcode= mysqli_real_escape_string($this->db->link, $data['zipcode']);
			$phone= mysqli_real_escape_string($this->db->link, $data['phone']);
			$email= mysqli_real_escape_string($this->db->link, $data['email']);
			// $password= mysqli_real_escape_string($this->db->link, md5($data['password']));

			if($username=="")
			{
				$alert ="<span class='error'>Họ tên không được trống</span>";
				return $alert;
			}
			else if($address=="")
			{
				$alert ="<span class='error'>Địa chỉ không được trống</span>";
				return $alert;
			}
			else if($zipcode=="")
			{
				$alert ="<span class='error'>Zipcode không được trống</span>";
				return $alert;
			}
			else if($phone=="")
			{
				$alert ="<span class='error'>Số điện thoại không được trống</span>";
				return $alert;
			}
			else if($email=="")
			{
				$alert ="<span class='error'>Email không được trống</span>";
				return $alert;
			}
			// else if (!preg_match('/^0[0-9]{8}$/', $phone))
			// {
			// 	$alert ="<span class='error'>Sai định dạng số điện thoại</span>";
			// 	return $alert;
			// }
			// 
			else if (!preg_match($regex, $email)) {
				$alert = "<span class='error'>Email không đúng định dạng!!!</span>";
				 return $alert;
			}
			
			else
			{
				$query = "UPDATE tbl_customer SET username='$username',address='$address',zipcode='$zipcode',phone='$phone',email='$email' WHERE id='$id'";
				$result = $this->db->insert($query);
				if($result)
				{
					// $alert ="<span class='success'>Lưu Thông Tin Thành Công</span>";
					// return $alert;
					header('Location:offlinepay.php');
				}
				else{
					$alert ="<span class='error'>Lưu Thông Tin Không Thành Công</span>";
					return $alert;
				}
			}
			
		}
		
	
	}
?>
