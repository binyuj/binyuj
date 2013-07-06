#!/usr/bin/env python
# coding:utf-8
# Author:  binyuj

import urllib
import os

filelist = ['proxy.ini', 'proxy.py', 'goagent_gtk.py', 'cacert.pem','addto-startup.py', 'proxy.pac']

def main():
    try:
        import ConfigParser
        import re
        ConfigParser.RawConfigParser.OPTCRE = re.compile(r'(?P<option>[^=\s][^=]*)\s*(?P<vi>[=])\s*(?P<value>.*)$')
        config = ConfigParser.ConfigParser()
        config.read('proxy.ini')
        appids = config.has_option('gae', 'appid') and config.get('gae', 'appid')
        print('Found appids:%s\n') % appids
    except Exception:
        pass

    for filename in filelist:
        fileurl = 'https://github.com/goagent/goagent/raw/3.0/local/'+filename
        print('Updating "%s" ... \n...from "%s"') % (filename, fileurl)
        content = urllib.urlopen(fileurl).read()
        target = open(filename, 'wb')
        target.write(content)
        target.close()
        print('Successful updated "%s" !\n-----------------------------------') % filename
        if filename == 'goagent_gtk.py':
            os.chmod(filename, 0755)
    print('All file up to date. Done!')

    if appids:
        config.set('gae', 'appid', appids)
        with open('proxy.ini', 'wb') as fp:
            config.write(fp)
        print('Successful wrote appids !')

if __name__ == '__main__':
    try:
        main()
    except KeyboardInterrupt:
        print('\nAbort')
        pass
