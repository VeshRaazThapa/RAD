import sys
import json
import requests
data = sys.argv[1]
# type = sys.argv[2]
image_path = data.split('///')[0]
type = data.split('///')[1]
# with open('types.json', encoding='utf-8') as data_file:
#     data = json.loads(data_file.read())

data= {'id' :image_path , 'type' :type}
# image = open('/Users/stuff/Sites/localhost/x_ray/dashboard/16_04_2022_15_55_36_chest_xray.jpg','rb')
# 
# files = {'image' : image}
response = requests.post('http://127.0.0.1:8000/model-prediction/',data = data).json()
print (json.dumps(response))
f = open("process.json", "w")
f.write(json.dumps(response))
