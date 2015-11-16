// JavaScript Document
function add_dot(number)
{
	number = remove_dot(number);
	l = number.indexOf('.') == -1?number.length:number.indexOf('.');
	str= "";
	sub = Array();
	h=0;
	phanle =  number.substring(number.length , l);
	for(c = l; c>0;c=c-3)
	{
		sub[h] = number.substring(c - 3,c);
		h++;
	}
	lengsub = sub.length;
	str = sub[0]
	for (chay = 1 ; chay < lengsub ; chay ++)
	{
		str = sub[chay] + "," + str;
	}
	if(phanle != "" )
		str += phanle;
	return str;
}
function remove_dot(str)
{
	str = String(str);
	while(str.indexOf(',') != -1)
		str = str.replace(",","");
	
	return str;
}
function chuyennhuong()
{
	total = remove_dot($(":input[name='tongthunhap']").val());
	tax = 0.0;
	tax = (total *25 )/100;
	$('.tax_result span').html(add_dot(String(tax))+ " (VND)");
	$('.chuthich').hide();
}
function quatangbds()
{
	total = remove_dot($(":input[name='tongthunhap']").val());
	tax = 0.0;
	tax = (total *10 )/100;
	$('.tax_result span').html(add_dot(String(tax))+ " (VND)");
	$('.chuthich').hide();
}
function single()
{
	var luytien =  new Array(new Array(0,5,10,18,32,52,80,0),new Array(0,5,10,15,20,25,30,35));
	total = remove_dot($(":input[name='tongthunhap']").val());
	bhyt = remove_dot($(":input[name='bhyt']").val());
	bhxh = remove_dot($(":input[name='bhxh']").val());
	tuthien = remove_dot($(":input[name='tuthien']").val());
	phuthuoc = remove_dot($(":input[name='nguoiphuthuoc']").val());
	m_bhyt="0.0";
	m_bhxh = "0.0";
	m_bhyt = (total * bhyt)/100;
	m_bhxh = (total * bhxh)/100;
	m_phuthuoc = phuthuoc * 1600000; // moi nguoi phu thuoc 1,6 trieu
	m_banthan = 4000000; //mien giam cho ban than 4 trieu
	tax_money = total - m_bhyt - m_bhxh - m_phuthuoc - tuthien - m_banthan;
	//tinh luy tien
	subtract = Array();
	tax_level = Array();
	for(i=1;i<=7;i++)
	{
		if( tax_money > ( luytien[0][i-1]) * 1000000)
		{
			if( luytien[0][i] != 0  && tax_money > luytien[0][i] * 1000000 )
			{
				
				subtract[i] = (luytien[0][i] - luytien[0][i-1])*1000000;
				tax_level[i] = (subtract[i] * luytien[1][i] ) /100;
			}
			else
			{
				subtract[i] = tax_money - luytien[0][i-1]*1000000;
				tax_level[i] = (subtract[i] * luytien[1][i] ) /100;	
			}
		}
		else
		{
			break;
		}
	}
	tax = 0 ;
	for(k=1;k<i;k++)
	{
			tax += tax_level[k];
	}
	dem = i;
	$('.tax_result span').html(add_dot(String(tax))+ " (VND)");
	str = "";
	str += "Bạn được giảm trừ theo các khoản sau : ";
	str += "<br>- Cho bản thân : 4.000.000 (VND)";
	str += "<br>- "+phuthuoc + " người phụ thuộc : " + phuthuoc +"x 1.600.000 = " + add_dot(String(m_phuthuoc)) + " (VND)"; 
	str += "<br>- Bảo hiểm y tế : " + bhyt +"% x " + add_dot(total) + " = " + add_dot(String(m_bhyt)) + " (VND)";
	str += "<br>- Bảo hiểm xã hội : " + bhxh +"% x " + add_dot(total) + " = " + add_dot(String(m_bhxh)) + " (VND)";; 
	str += "<br>- Các khoản từ thiện : " + add_dot(tuthien);
	str += "<br>Tổng số tiền chịu thuế : "+ add_dot(String(total)) + " - " + "4.000.000" + " - " + add_dot(String(m_phuthuoc)) + " - "  +   add_dot(String(m_bhyt));
	str += " - " + add_dot(String(m_bhxh)) + " - " + add_dot(String(tuthien)) + " = " + add_dot(String(tax_money)) + "(VND)";
	str += "<br><br>(*)Thu nhập tính thuế thu nhập cá nhân áp vào biểu thuế luỹ tiến từng phần để tính số thuế phải nộp là:";
	for(k=1;k<dem;k++)
	{
		
		if( luytien[0][k] != 0 && tax_money > luytien[0][k] * 1000000 )
		{
			str += "<br>Bậc " + k + ":Thu nhập tính thuế thu nhập cá nhân (tính thuế TNCN) đến " + luytien[0][k] +" triệu đồng, thuế suất "+ luytien[1][k]+"%:";
			str += "<br>(" + add_dot(luytien[0][k]*1000000) + " - " + add_dot(luytien[0][k-1]*1000000) + ") x " + luytien[1][k] + "% = " + add_dot(String(tax_level[k])) + " (VND) <span style='color:red'>("+k+")</span>";
		}
		else
		{
			str += "<br>Bậc " + k + ":Thu nhập tính thuế thu nhập cá nhân (tính thuế TNCN) trên " + luytien[0][k-1] +" triệu đồng, thuế suất "+ luytien[1][k]+"%:";
			str += "<br>(" + add_dot(tax_money) + " - " + add_dot(luytien[0][k-1]*1000000) + ") x " + luytien[1][k] + "% = " + add_dot(String(tax_level[k])) + " (VND)<span style='color:red'>("+k+")</span>";
		}
	
	}
	
	str += "<br><br><strong><span style='color:red'>Vậy tổng số thuế phải nộp là:";
	for(k=1;k<dem;k++)
	{
		str +="("+k+")";
		if(k<dem-1)
		{
			str +=" + ";
		}
	}
	str += " = " + add_dot(String(tax)) + "(VND)";
	
	if(tax  > 0)
	{
		$('.chuthich').html(str);
	}
	else
	{
		$('.chuthich').html("Bạn chưa phải đóng thuế");
	}
	
}
$().ready(function(){

	$('.dot_input').each(function(){
		
		$(this).keyup(function (){
			this.value = this.value.replace(/[^0-9\,]/g,'');
			$(this).val(add_dot($(this).val()));
			
		});
		$(this).focus(function (){
			if($(this).val() == "0")
				$(this).val("");
		});
		$(this).blur(function(){
					if($(this).val()=="")
						$(this).val("0");
					this.value = this.value.replace(/[^0-9\,]/g,'');
			});
	});
	$("#frm :input").tooltip({

		// place tooltip on the right edge
		position: "center right",
	
		// a little tweaking of the position
		offset: [-2, 10],
	
		// use the built-in fadeIn/fadeOut effect
		effect: "fade",
	
		// custom opacity setting
		opacity: 0.7

	});
	
});