import requests
import json
import sys
from bs4 import BeautifulSoup
import pathlib
import datetime

if (len(sys.argv) != 3):
   exit()
CompanyCode = sys.argv[1]
yearInput = int(sys.argv[2])
now = datetime.datetime.now()

datarequest = {
    "symbol": CompanyCode,
    "type": 1,
    "quarter": 2,
    "year": yearInput,
    "qtype": 0,
    "donvi": 1000
}
API_ENDPOINT = "https://s.cafef.vn/Ajax/Bank/NoteIndicator.aspx?"
headerRequest = {
    "User-Agent": "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.3"
}
respond = requests.get(API_ENDPOINT, datarequest);
soup = BeautifulSoup(respond.text, 'html.parser')
listData = soup.find_all('tr');
listYear = listData.pop(0)
listYear = listYear.find_all(class_='tright')
dataSave = {"years":[],"info":[]}
for year in listYear:
    dataSave['years'].append(year.text)
for item in listData:
    item = item.find_all('td')
    title = item.pop(0)
    info = {"title":"","values":[]}
    info['title'] = title.text
    for value in item:
        if (value.text == '--'):
            info['values'].append(0)
        else:
            info['values'].append(int(value.text.replace(",", "")))
    dataSave["info"].append(info)
From = yearInput-3
To = yearInput
FileName = CompanyCode + '_debit_' + str(From) + '-' + str(To) + '.txt'
FidePath = "storage/data/stock/" + CompanyCode
pathlib.Path(FidePath).mkdir(parents=True, exist_ok=True)
f = open(FidePath + '/' + FileName, "w")
f.write(json.dumps(dataSave, ensure_ascii=False))
f.close()
