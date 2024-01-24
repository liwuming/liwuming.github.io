

1、win+x，选择windows + powershell（管理员）
2、Enable-WindowsOptionalFeature -Online -FeatureName Microsoft-Windows-Subsystem-Linux（如下图所示）
3、




sudo apt-get install apt-transport-https ca-certificates curl gnupg-agent software-properties-common

sudo apt-get install apt-transport-https ca-certificates curl software-properties-common gnupg lsb-release
 

curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg

echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null


sudo apt-get update
sudo apt install docker-ce docker-ce-cli containerd.io docker-compose-plugin

docker run -d -p 10020:22  -p 8080:3000 --name=gogs --restart=always -v /opt/docker/gogs/:/data gogs/gogs‘




触发隐藏的file


启用

ubuntu1804.exe config --default-user root


ubuntu


win10与ubuntu共享数据



apt install docker.io
完成之后，在/etc/profile配置文件中新增如何配置
```bash
export DOCKER_HOST=tcp://127.0.0.1:2375
```


export DOCKER_HOST=tcp://127.0.0.1:2375


E: Package 'docker-ce' has no installation candidate

sudo apt install apt-transport-https ca-certificates curl gnupg2 software-properties-common
curl -fsSL https://mirrors.ustc.edu.cn/docker-ce/linux/ubuntu/gpg | sudo apt-key add -
sudo apt update



apt-get upgrade

sudo apt install docker-ce



System has not been booted with systemd as init system (PID 1). Can't operate.
Failed to connect to bus: Host is down



Docker Desktop requires a newer WSL kernel version.

wsl --update



wsl --set-default-version 




System has not been booted with systemd as init system (PID 1). Can't operate.
Failed to connect to bus: Host is down

说明并不支持systemd



docker hello world

docker run -it hello-world

--name=ubuntu_server -p 80:80 ubuntu:latest




docker gogs

mkdir -p /mnt/d/git-repositories


docker run --name=gogs -d  -p 1022:22 -p 9013:3000 -v /mnt/d/git-repositories:/data gogs/gogs



如果docker启动失败  
sudo yum update  


create user omninet@'192.168.%.%' indentified by 'admin123';

grant all privileges on gogs.* to omninet@'192.168.%.%'

CREATE USER dbadmin@192.168.1.100 
IDENTIFIED BY 'pwd123';
//更多请阅读：https://www.yiibai.com/mysql/create-user.html



ubuntu开放端口号



LxRunOffline install -n centos -d "D:\\system\\centos" -f "d:\\soft\\CentOS-7-20140625-x86_64-docker_01.img.tar.xz"



centos设置yum源

# CentOS-Base.repo
#
# The mirror system uses the connecting IP address of the client and the
# update status of each mirror to pick mirrors that are updated to and
# geographically close to the client.  You should use this for CentOS updates
# unless you are manually picking other mirrors.
#
# If the mirrorlist= does not work for you, as a fall back you can try the 
# remarked out baseurl= line instead.
#
#
 
[base]
name=CentOS-$releasever - Base - mirrors.aliyun.com
failovermethod=priority
baseurl=http://mirrors.aliyun.com/centos/$releasever/os/$basearch/
        http://mirrors.aliyuncs.com/centos/$releasever/os/$basearch/
        http://mirrors.cloud.aliyuncs.com/centos/$releasever/os/$basearch/
gpgcheck=1
gpgkey=http://mirrors.aliyun.com/centos/RPM-GPG-KEY-CentOS-7
 
#released updates 
[updates]
name=CentOS-$releasever - Updates - mirrors.aliyun.com
failovermethod=priority
baseurl=http://mirrors.aliyun.com/centos/$releasever/updates/$basearch/
        http://mirrors.aliyuncs.com/centos/$releasever/updates/$basearch/
        http://mirrors.cloud.aliyuncs.com/centos/$releasever/updates/$basearch/
gpgcheck=1
gpgkey=http://mirrors.aliyun.com/centos/RPM-GPG-KEY-CentOS-7
 
#additional packages that may be useful
[extras]
name=CentOS-$releasever - Extras - mirrors.aliyun.com
failovermethod=priority
baseurl=http://mirrors.aliyun.com/centos/$releasever/extras/$basearch/
        http://mirrors.aliyuncs.com/centos/$releasever/extras/$basearch/
        http://mirrors.cloud.aliyuncs.com/centos/$releasever/extras/$basearch/
gpgcheck=1
gpgkey=http://mirrors.aliyun.com/centos/RPM-GPG-KEY-CentOS-7
 
#additional packages that extend functionality of existing packages
[centosplus]
name=CentOS-$releasever - Plus - mirrors.aliyun.com
failovermethod=priority
baseurl=http://mirrors.aliyun.com/centos/$releasever/centosplus/$basearch/
        http://mirrors.aliyuncs.com/centos/$releasever/centosplus/$basearch/
        http://mirrors.cloud.aliyuncs.com/centos/$releasever/centosplus/$basearch/
gpgcheck=1
enabled=0
gpgkey=http://mirrors.aliyun.com/centos/RPM-GPG-KEY-CentOS-7
 
#contrib - packages by Centos Users
[contrib]
name=CentOS-$releasever - Contrib - mirrors.aliyun.com
failovermethod=priority
baseurl=http://mirrors.aliyun.com/centos/$releasever/contrib/$basearch/
        http://mirrors.aliyuncs.com/centos/$releasever/contrib/$basearch/
        http://mirrors.cloud.aliyuncs.com/centos/$releasever/contrib/$basearch/
gpgcheck=1
enabled=0
gpgkey=http://mirrors.aliyun.com/centos/RPM-GPG-KEY-CentOS-7

yum clean all
yum makecache


/gogs-repositories

/data/git/gogs-repositories
