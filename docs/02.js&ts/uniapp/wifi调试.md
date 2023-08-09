

1、 wifi调试uniapp

前提：电脑已经安装 adb
1. 手机打开usb调试，通过usb连接电脑，手机选择传输文件模式
2. 打开命令行输入：adb tcpip 5555
3. 链接到手机： adb connect 192.168.124.106:5555

192.168.1.100 为手机IP地址
执行以上三步就可以WIFI进行调试了

adb devices 查看设备
adb disconnct 断开链接