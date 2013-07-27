#!/usr/bin/env python
# -*- coding: utf-8 -*-
# Author:  binyuj
# Description： 使用多线程更新goagent

import urllib
import os
import thread

filelist = ['proxy.ini', 'proxy.py', 'goagent-gtk.py', 'cacert.pem','addto-startup.py', 'proxy.pac']

def main():
    try:
        import ConfigParser
        import re
        ConfigParser.RawConfigParser.OPTCRE = re.compile(r'(?P<option>[^=\s][^=]*)\s*(?P<vi>[=])\s*(?P<value>.*)$')
        config = ConfigParser.ConfigParser()
        config.read('proxy.ini')
        appids = config.has_option('gae', 'appid') and config.get('gae', 'appid')
        print('Found appids:%s\n' % appids)
    except Exception:
        pass
    
    # 多线程处理
    def updatefile(filename):
        fileurl = 'https://github.com/goagent/goagent/raw/3.0/local/'+filename
        print('Updating "%s" ... \n...from "%s"' % (filename, fileurl))
        content = urllib.urlopen(fileurl).read()
        target = open(filename, 'wb')
        target.write(content)
        target.close()
        print('Successful updated "%s" !' % filename)
        if filename == 'goagent_gtk.py':
            os.chmod(filename, 0755)
        if filename == 'proxy.ini' and appids:
            config.set('gae', 'appid', appids)
            with open('proxy.ini', 'wb') as fp:
                config.write(fp)
            print('Successful wrote appids !')

    for filename in filelist:
        thread.start_new_thread(updatefile, (filename,))

    '''
    
    for filename in filelist:
        fileurl = 'https://github.com/goagent/goagent/raw/3.0/local/'+filename
        print('Updating "%s" ... \n...from "%s"' % (filename, fileurl))
        content = urllib.urlopen(fileurl).read()
        target = open(filename, 'wb')
        target.write(content)
        target.close()
        print('Successful updated "%s" !\n-----------------------------------' % filename)
        if filename == 'goagent_gtk.py':
            os.chmod(filename, 0755)
    print('All file up to date. Done!')

    if appids:
        config.set('gae', 'appid', appids)
        with open('proxy.ini', 'wb') as fp:
            config.write(fp)
        print('Successful wrote appids !')
    '''

if __name__ == '__main__':
    try:
        main()
    except KeyboardInterrupt:
        print('\nAbort')
        pass
