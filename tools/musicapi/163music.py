#!/usr/bin/env python
# coding:utf-8

# "网易云音乐外链解析" http://www.iippcc.com/php-jie-xi-wang-yi-yun-yin-yue-yuan-ma.html

# http://music.163.com/#/m/song?id=19851815
import urllib2, re

song_id = 19851815
url = "http://music.163.com/m/song/%s" % song_id

headers = {"User-Agent": "Mozilla/5.0 (Linux; U; Android 2.3.6; en-us; Nexus S Build/GRK39F) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1"
           }

req = urllib2.Request(url, data=None, headers=headers)
res = urllib2.urlopen(req)
content = res.read()
m = re.search('g_songs=."(.*)"', content)
song_url = m.group(1)
print song_url
