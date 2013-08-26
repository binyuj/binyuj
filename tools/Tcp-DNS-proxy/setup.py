from distutils.core import setup
import py2exe

setup(
    console=[{
        "script":"tcpdns.py",
        "icon_resources": [(1, "tcpdns_32X32.ico")]
        }]
)