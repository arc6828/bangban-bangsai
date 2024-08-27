import json,codecs
import urllib.request
import urllib.parse

def getDataWaterLevelNow(province_name="นครศรีธรรมราช", amphoe_name="ทุ่งสง"):
    url = "https://api-v3.thaiwater.net/api/v1/thaiwater30/public/waterlevel_load"
    with urllib.request.urlopen(url) as response:
        data = json.loads(response.read())
    data = data["waterlevel_data"]["data"]
    # data
    len(data)
    def thungsongFilter(item):
        # print(item)
        return (item["geocode"]["amphoe_name"]["th"] == "ทุ่งสง") and (item["geocode"]["province_name"]["th"] == "นครศรีธรรมราช" )
        # return (item["geocode"]["province_name"]["th"] == "นครศรีธรรมราช" )

    thungsongData = filter(thungsongFilter,data)
    thungsongData = list(thungsongData)
    return thungsongData

def getDataRainNow(province_name="นครศรีธรรมราช", amphoe_name="ทุ่งสง"):
    url = "https://api-v3.thaiwater.net/api/v1/thaiwater30/public/rain_24h"
    with urllib.request.urlopen(url) as response:
        data = json.loads(response.read())
    data = data["data"]
    # data
    len(data)
    def thungsongFilter(item):
        # print(item)
        return (item["geocode"]["amphoe_name"]["th"] == "ทุ่งสง") and (item["geocode"]["province_name"]["th"] == "นครศรีธรรมราช" )
        # return (item["geocode"]["province_name"]["th"] == "นครศรีธรรมราช" )

    thungsongData = filter(thungsongFilter,data)
    thungsongData = list(thungsongData)
    return thungsongData

wl = getDataWaterLevelNow(province_name="นครศรีธรรมราช", amphoe_name="ทุ่งสง")
with codecs.open('data/now-wl.json', 'w', encoding='utf-8') as f:
    json.dump(wl, f, ensure_ascii=False)
    print("Write file data/now-wl.json")

# rain = getDataRainNow(province_name="นครศรีธรรมราช", amphoe_name="ทุ่งสง")
# with codecs.open('data/now-rain.json', 'w', encoding='utf-8') as f:
#     json.dump(rain, f, ensure_ascii=False)    
#     print("Write file data/now-rain.json")