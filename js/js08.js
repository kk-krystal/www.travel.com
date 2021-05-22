//焦点图轮播
window.onload=function(){	
	//顶部的焦点图切换
	function hotChange(){
		var current_index=0;
		//3s自动切换
		var timer=window.setInterval(autoChange, 3000);

		for(var i=0;i<$('#button li').length;i++){
			//焦点在鼠标下
			$('#button li').eq(i).mouseover=function(){
				//不要自动切换
				if(timer){
					clearInterval(timer);
				}
				//通过判断classname来判断当前的图片
				for(var j=0;j<$('#banner_pic li').length;j++){
					if($('#button li').eq(j)==this){
						current_index=j;
						$('#button li').eq(j).attr('class','current');
						$('#banner_pic li').eq(j).attr('class','current');
					}else{
						$('#banner_pic li').eq(j).attr('class','li');
						$('#button li').eq(j).attr('class','but');
					}
				}
			}
			//失去鼠标焦点，继续自动播放
			$('#button li').eq(i).mouseout=function(){
				timer=setInterval(autoChange,3000);			
			}
		}
		//自动切换
		function autoChange(){
			++current_index;
			//如果到了最后一张图，回到第一张
			if (current_index==$('#button li').length) {
				current_index=0;
			}
			//通过判断classname来判断当前的图片
			for(var i=0;i<$('#button li').length;i++){
				if(i==current_index){
					$('#button li').eq(i).attr('class','current');
					$('#banner_pic li').eq(i).attr('class','current');
				}else{
					$('#button li').eq(i).attr('class','but');
					$('#banner_pic li').eq(i).attr('class','li');
				}
			}
		}
	}
	hotChange();
	
	
	//创意展示
	function school(){
		//定义滚动速度
		var speed = 50;
		
		//复制一个<span>，用于无缝滚动
		imgbox.innerHTML += imgbox.innerHTML;
	
		//启动定时器，调用滚动函数
		var timer1 = window.setInterval(marquee,speed);
		//鼠标移入时暂停滚动，移出时继续滚动
		$('#imgbox').onmouseover = function(){
			clearInterval(timer1);
		}
		$('#imgbox').onmouseout = function(){
			timer1=setInterval(marquee,speed);
		};
		//滚动函数
		function marquee(){
			//当第1个<span>被完全卷出时
			if($('#imgbox').scrollLeft() >= 40){
				//将被卷起的内容归0
				$('#imgbox').scrollLeft(0);
			}else{
				//否则向左滚动
				$('#imgbox').scrollLeft($('#imgbox').scrollLeft()+1);
			}
		}
	}
	school();
		
	
}