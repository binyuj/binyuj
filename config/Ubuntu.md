解决[mentohust](https://code.google.com/p/mentohust/)出现"打开libnotify失败"

    sudo ln -s /usr/lib/i386-linux-gnu/libnotify.so.4.0.0 /usr/lib/libnotify.so.1
    sudo ln -s /usr/lib/x86_64-linux-gnu/libnotify.so.4.0.0 /usr/lib/libnotify.so.1
    
安装软件

    sudo apt-get install python-dev python-appindicator python-vte sublime-text conky git ruby
    
Ubuntu键盘大小写指示器:indicator-keylock

    sudo add-apt-repository ppa:tsbarnes/indicator-keylock
    sudo apt-get update && sudo apt-get install indicator-keylock
    

