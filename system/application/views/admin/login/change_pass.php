<form name="form1" method="post" action="<?=$base_url;?>admin/login/dochange_pass" onSubmit="return check();">
<?php echo $msg;?>

<table width="357" border="0">
  <tr>
    <td colspan="2"><div align="center">Đổi mật khẩu</div></td>
  </tr>
  <tr>
    <td width="128"><div align="right">Mật khẩu cũ:</div></td>
    <td width="219"><input type="password" name="txtOldpass" id="txtOldpass"></td>
  </tr>
  <tr>
    <td><div align="right">Mật khẩu mới:</div></td>
    <td><input type="password" name="txtNewpass" id="txtNewpass"></td>
  </tr>
  <tr>
   <td><div align="right">Nhập lại mật khẩu:</div></td>
    <td><input type="password" name="txtNewpass" id="txtConpass"></td>
    </tr>
  <tr>
    <td ><div align="right">
      <input type="submit" name="submit" id="submit" value="Ok">
    </div></td>
    <td><input type="reset" value="Hủy"></td>
  </tr>
</table>

<p>&nbsp;</p>
</form>
<script language="javascript" type="application/javascript">
function check()
{
	
	if(document.getElementById('txtOldpass').value=="")
	{
		alert("Bạn phải nhập mật khẩu hiện tại");
		return false;
	}
		if(document.getElementById('txtNewpass').value=="" ||document.GetElementById('txtConpass').value=="")
	{
		alert("Nhập mật khẩu mới");
		return false;
	}
	if(document.getElementById('txtNewpass').value!=document.GetElementById('txtConpass').value)
	{
		alert("Nhập mật khẩu mới trùng nhau");
		return false;
	}
	return true;
	
}
</script>
