import bs4
import pandas
import requests
import lxml.html as lh
import json
import matplotlib.pyplot as plt
import numpy as np
import sys
import pathlib
import datetime
'''
python3 crawler_vietstock.py VCB year CDKT 1 4
python3 crawler_vietstock.py VCB year KQKD 1 4
python3 crawler_vietstock.py VCB year LC 1 4
'''

'''
[1] Companycode.
[2] ReportTermType.
[3] ReportType.
[4] Page.
[5] PageSize.
'''
if (len(sys.argv) != 6):
   exit()
CompanyCode = sys.argv[1]
ReportTermType = sys.argv[2]
ReportType = sys.argv[3]
Page = sys.argv[4]
PageSize = sys.argv[5]

if(ReportTermType == 'year'):
    ReportTermType = 1
else:
    ReportTermType = 2

API_ENDPOINT = "https://finance.vietstock.vn/data/financeinfo"
datarequest = {
    "Code":CompanyCode,
    "Page":int(Page),
    "PageSize":int(PageSize),
    "ReportTermType":ReportTermType,
    "ReportType":ReportType,
    "Unit": 1000000,
    "__RequestVerificationToken": "0wezrUlQXghg1SvU0QwihOn1ybUPD_vkrUJKMQO9ucRzDVgLuI80J7HmLrV9mE8BKQXY-vs5hD4wPWgrdO_oi3auGu7Qr3Puyukyr7LJZXI1"
}

headerRequest = {
    "Cookie":"_ga=GA1.2.1298521008.1597904113; _ga=GA1.3.1298521008.1597904113; language=vi-VN; Theme=Light; AnonymousNotification=; ASP.NET_SessionId=xz0i3tzbabldqgbp4ybwbqui; __RequestVerificationToken=Vp-QETdSSfXlco-lnxXwmZKtrD161X-7UFtHF-3DUsnhhkndnmABqVCIfO9dJdVtBgMWhVnmmwzq-ZOcphU-h5EcVRwu5bf6-zI8daSLQg41; _gid=GA1.2.1167094169.1644739154; _gid=GA1.3.1167094169.1644739154; finance_viewedstock=ACB,VPB,",
    "User-Agent": "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.3"
}

now = datetime.datetime.now()
toYear = now.year-1-(int(Page)-1)*int(PageSize)
fromYear = now.year-int(Page)*int(PageSize)
FileName = CompanyCode + '_' + ReportType + '_' + sys.argv[2] + '_' + str(fromYear) + '-' + str(toYear) +'.txt'
FidePath = "storage/data/stock/" + CompanyCode

pathlib.Path(FidePath).mkdir(parents=True, exist_ok=True)
f = open(FidePath + '/' + FileName, "w")

# Crawling data.
respond = requests.post(API_ENDPOINT,data=datarequest,headers = headerRequest)
jsonload = json.loads(respond.content)
f.write(json.dumps(jsonload, ensure_ascii=False))
f.close()

