#!/usr/bin/env python
# coding:utf-8

# "虾米音乐地址解析",方法来自 http://www.iippcc.com/phpxia-mi-yin-le-di-zhi-jie-xi.html

import urllib2, json


song_id = 1770627218
api_url = "http://www.xiami.com/app/iphone/song/id/%s" % song_id

headers = {"User-Agent": "Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_0 like Mac OS X; en-us) AppleWebKit/532.9 (KHTML, like Gecko) Version/4.0.5 Mobile/8A293 Safari/6531.22.7"
           }

req = urllib2.Request(api_url, data=None, headers=headers)
res = urllib2.urlopen(req)
content =  res.read()
content = json.loads(content)
print content['location']
