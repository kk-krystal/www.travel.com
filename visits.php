<?php
  //数字输出网页计数器
  $max_len = 9;
  $CounterFile = "counter.dat";
  if(!file_exists($CounterFile)){  //如果计数器文件不存在
   $counter = 0;    
   $cf = fopen($CounterFile,"w"); //打开文件
   fputs($cf,'0');     //初始化计数器
   fclose($cf);     //关闭文件
  }
  else{          //取回当前计数器的值
   $cf = fopen($CounterFile,"r");
   $counter = trim(fgets($cf,$max_len));
   fclose($cf);
  }
  $counter++;         //计数器加一
  $cf = fopen($CounterFile,"w");    //写入新的数据
  fputs($cf,$counter);
  fclose($cf);
?>