解决[mentohust](https://code.google.com/p/mentohust/)出现"打开libnotify失败",两种方法

1. 用十六进制编辑器编辑```mentohust```将原二进制文件中libnotify.so.1改为libnotify.so.4
    * ```sudo sed -i 's/libnotify.so.1/libnotify.so.4/' /usr/bin/mentohust```
2. 做链接
    * ```sudo ln -s /usr/lib/i386-linux-gnu/libnotify.so.4.0.0 /usr/lib/libnotify.so.1```
    * ```sudo ln -s /usr/lib/x86_64-linux-gnu/libnotify.so.4.0.0 /usr/lib/libnotify.so.1```


安装软件

    sudo apt-get install python-dev python-vte python-openssl python3-openssl python-pip python3-pip python-m2crypto sublime-text conky git ruby expect dconf-tools icedtea-6-plugin
    sudo pip install shadowsocks rhc cctrl
    
Ubuntu键盘大小写指示器:indicator-keylock, 双显卡切换Bumblebee

    sudo add-apt-repository ppa:tsbarnes/indicator-keylock
    sudo add-apt-repository ppa:bumblebee/stable
    sudo apt-get update && sudo apt-get install indicator-keylock bumblebee virtualgl linux-headers-generic
    
userscripts
* [OpenGG.Clean.Player(Bae](http://userscripts.org/scripts/show/162286)
* [YouTube Center](http://userscripts.org/scripts/show/114002)
* [贴吧小尾巴](http://userscripts.org/scripts/show/150519)
* [图片化for chrome](http://userscripts.org/scripts/show/145774)
* [TiebaUsualSmilier](http://userscripts.org/scripts/show/142404)
* [贴吧坟贴提醒（脚本版）](http://userscripts.org/scripts/show/155177)
* [Auto_checkin_xiami.com](http://userscripts.org/scripts/show/137123)
* [Crack Url Wait Code Login For Chrome](http://userscripts.org/scripts/show/157621)
* [Music liker for Beauty](http://userscripts.org/scripts/show/161719)
* [Tieba Advanced](http://userscripts.org/scripts/show/152918)
* [Tieba.OpenTail](http://userscripts.org/scripts/show/180361)
* [Tieba.OpenTail.ManagerDetector](http://userscripts.org/scripts/show/180487)
* [Tieba Client](http://userscripts.org/scripts/show/177032)
* [XuanFengEx](http://userscripts.org/scripts/show/160258 "QQ旋风网页版离线下载增强")
* [youku-html5-player](http://userscripts.org/scripts/show/162490)

[妈妈再也不用担心我的macbook发烫了计划2.0Beta](http://zythum.sinaapp.com/youkuhtml5playerbookmark "在优酷等在线视频网站切换html5方式播放视频。解决Linux下看视频发热大的问题，顺便把广告也屏蔽掉了，Windows也可以用。")
