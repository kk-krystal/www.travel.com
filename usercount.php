<?php
if (!session_id()) session_start();
$num = 0;
$dirpt = 'online';
$reftime = 1;
// 判断$dirpt是否是个目录并且将打开文件的句柄放入到变量$dir中
if (is_dir($dirpt) && $dir = opendir($dirpt)) {
    // 读取文件中的内容
    while (($file = readdir($dir)) !== false) {
        if (strcmp($file, '..') == 0 || strcmp($file, '.') == 0) {
            continue;
        }
        // filemtime()文件修改时间
        $D_[date('Y-m-d H:i:s', filemtime($dirpt . '/' . $file))] = $file;
        ++$num;
        unset($cum);
    }
    // 关闭文件
    closedir($dir);
    // 将session_id赋值给$filename文件名字
    $filename = session_id();
    // 打开文件
    $fp = fopen($dirpt . '/' . $filename, 'w');
    // 写入文件
    fputs($fp, '');
    // 关闭已打开的文件指针
    fclose($fp);
    // 取得当前日期的时间戳并将其格式化
    $ntime = date('Y-m-d H:i:s', mktime(date('H'), date('i') - 1, 0, date('m'), date('d'), date('Y')));
    $D_[$ntime] = '-';
    // 对数组键名逆向排序
    krsort($D_);
    // 对在线人数初始化
    $onlinenumber = 0;
    while (1) {
        // 从关联数组中取得键名
        $vkey = key($D_);
        // 将在线人数加1
        ++$onlinenumber;
        // 字符串比较（二进制数）
        if (strcmp($ntime, $vkey) == 0) {
            break;
        } else {
            // 将数组开头的单元移出数组
            array_shift($D_);
        }
    }
    // 将数组开头的单元移出数组
    array_shift($D_);
    // 将数组的内部指针指向第一个单元
    reset($D_);
    // 判断数组中元素的个数
    while (count($D_) > 0) {
        //从关联数组中取得键名
        $ckey = key($D_);
        // 删除文件
        unlink($dirpt . '/' . $D_[$ckey]);
        // 判断数组中的内部指针向前移动一位是否存在
        if (!next($D_)) {
            break;
        }
    }
} else {
    mkdir($dirpt, 0777);
}
$online = $onlinenumber - 1;
$retime = 60 * $reftime;
echo "当前在线<strong>$online</font></strong>人<meta http-equiv=refresh content=\"{$retime},url=\">";
