#!/usr/bin/env python
# -*- coding: utf-8 -*-
# Author:  binyuj
# Description： 使用多线程更新goagent

import urllib
import os
import re
import threading
try:
    import configparser
except ImportError:
    import ConfigParser as configparser
try:
    import urllib.request
except ImportError:
    import urllib
    urllib.request = __import__('urllib2')

filelist = ['proxy.ini', 'proxy.py', 'goagent-gtk.py', 'cacert.pem','addto-startup.py', 'proxy.pac']


class Update(threading.Thread):
    def __init__(self, filename):
        threading.Thread.__init__(self)
        self.filename = filename

    def run(self):
        self.updatefile(self.filename)

    def updatefile(self, filename):
        fileurl = 'https://github.com/goagent/goagent/raw/3.0/local/'+filename
        print('Updating "%s" ... \n...from "%s"' % (filename, fileurl))
        content = urllib.request.urlopen(fileurl).read()
        target = open(filename, 'wb')
        target.write(content)
        target.close()
        print('Successful updated "%s" !' % filename)

        if filename == 'goagent-gtk.py':
            os.chmod(filename, 0o775)
            print('chmod '+filename)
        if filename == 'proxy.ini' and appids:
            try:
                config.read('proxy.ini')
                config.set('gae', 'appid', appids)
                config.set('gae', 'password', gae_password)
                config.set('paas', 'fetchserver', fetchserver)
                config.set('paas', 'password', paas_password)
                config.write(open('proxy.ini', 'wb'))
                print('Successful wrote appids !')
            except Exception,e:
                print('wrote appids failed (T＿T)\n%s' % e)

def main():
    global config
    global appids
    global gae_password
    global fetchserver
    gloabl paas_password
    configparser.RawConfigParser.OPTCRE = re.compile(r'(?P<option>[^=\s][^=]*)\s*(?P<vi>[=])\s*(?P<value>.*)$')
    config = configparser.ConfigParser()
    config.read('proxy.ini')
    appids = config.has_option('gae', 'appid') and config.get('gae', 'appid')
    gae_password = config.has_option('gae', 'password') and config.get('gae', 'password')
    print('Found appids:%s\n' % appids)
    fetchserver = config.has_option('paas', 'fetchserver') and config.get('paas', 'fetchserver')
    paas_password = config.has_option('paas', 'password') and config.get('paas', 'password')
    print('Found fetchserver:%s\n' % fetchserver)

    for filename in filelist:
        thread = Update(filename)
        thread.start()

if __name__ == '__main__':
    try:
        main()
    except KeyboardInterrupt:
        print('\nAbort')
        pass
