#!/usr/bin/env python
# -*- coding: utf-8 -*-

import os
import base64
from sys import argv

Image = open(argv[1],'rb')
ImageData = Image.read()
ImageData = base64.b64encode(ImageData)
LIMIT = 70
liImage = []
while 1:
        sLimit = ImageData[:LIMIT]
        ImageData = ImageData[LIMIT:]
        liImage.append('%s' % sLimit)
        if len(sLimit) < LIMIT:
                break
print os.linesep.join(liImage)