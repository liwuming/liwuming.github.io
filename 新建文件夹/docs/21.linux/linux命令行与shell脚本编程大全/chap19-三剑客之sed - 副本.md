
sed是什么，
sed是流编辑器


命令使用


```bash

```



Device/Credential Guard 不兼容。在禁用 Device/Credential Guard 后，可以运行 VMware Workstation
禁用用于启用Credential Guard的组策略设置。
在主机操作系统上，右键单击“开始” > “运行”，键入gpedit.msc，然后单击“ 确定”。本地组策略编辑器打开。
转至本地计算机策略 > 计算机配置 > 管理模板>系统 >Device Guard（或者是： 设备防护） > 启用基于虚拟化的安全性。
选择已禁用。
 
转到“ 控制面板” >“ 卸载程序” >“ 打开或关闭Windows功能”以关闭Hyper-V。
选择不重启。
